<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Products;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Components\Recusive;

use App\Traits\StorageImageTrait; 

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    use StorageImageTrait; //trong app mục đích tái sử dụng code

    private $category;
    private $product;
    private $productImage;
    private $productTag;
    private $tag;

    public function __construct(Category $category, Products $product, ProductImage $productImage, ProductTag $productTag, Tag $tag){
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
        
    }

    public function index(){
        return view('admin.product.index');
    }

    public function create(){
        $htmlOption= $this->getCategory($parentId='');
        return view('admin.product.add', compact('htmlOption'));
    }

    public function getCategory($parentId){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecursive($parentId);
        return $htmlOption;
    }

    public function store(Request $request){
        $dataProductCreate=[
            'name'=> $request->name,
            'price'=> $request->price,
            'content'=> $request->contents,
            'user_id'=> auth()->id(),
            'category_id' => $request->category_id,

        ];
        $dataUploadfeatureImage= $this->storeTraitUpload($request,'feature_image_path','product');
        if(!empty($dataUploadfeatureImage)){
            $dataProductCreate['feature_image_name']=$dataUploadfeatureImage['file_name'];
            $dataProductCreate['feature_image_path']=$dataUploadfeatureImage['file_path'];
        }
        $product= $this->product->create($dataProductCreate);

        //Insert data to product_images
        //sử dụng laravel 8 eloqument relationship
        if($request->hasFile('image_path')){
            foreach ($request->image_path as $fileItem ){
                $dataProductImageDetail=$this->storeTraitUploadnutiple($fileItem, 'product');
                $product->images()->create([
                    'image_path' => $dataProductImageDetail['file_path'],
                    'image_name' => $dataProductImageDetail['file_name'],
                ]);
            }
        }

        //Insert tags for product
        foreach ($request->tags as $tagItem) {
            //Insert to tags
            // firstOrCreate định vị một bản ghi trong cơ sở dữ liệu khớp với các thuộc tính đã cho nếu ko có thì 1 bản ghi mới sẽ trả về
            $tagInstance= $this->tag->firstOrCreate([
                'name' => $tagItem
            ]);
            // 1 sản phẩm thì có nhiều tag
            $tagIds[]= $tagInstance->id;
        }
        //tags() là hàm tạo mỗi liên kết giữ các bảng liên quan tại bảng trung gian product_tag giữa bảng tag và bảng sản phảm 
        // 1 tag có nhiều sản phẩm, 1 sản phẩm có nhiều tag->attach gắn vai trò sản phẩm bằng cách chèn bản ghi vào bảng trung gian của mối quan hệ
        $product->tags()->attach($tagIds);
    }
}
