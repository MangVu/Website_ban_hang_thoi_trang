<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Products;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Components\Recusive;

use App\Traits\StorageImageTrait; 
use App\Traits\DeleteModelTrait; 

use Illuminate\Http\Request;
use App\Http\Requests\ProductAddRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminProductController extends Controller
{
    use StorageImageTrait; //trong app mục đích tái sử dụng code
    use DeleteModelTrait;
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
        $products= $this->product->latest()->paginate(5);
        return view('admin.product.index', compact('products'));
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

    public function store(ProductAddRequest $request){
        try{
            DB::beginTransaction();
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
            //sử dụng laravel 8 eloqument relationship 1-n
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
            //sử dụng laravel 8 eloqument relationship n-n
            if(!empty($request->tags)){
                foreach ($request->tags as $tagItem) {
                    //Insert to tags
                    // firstOrCreate định vị một bản ghi trong cơ sở dữ liệu khớp với các thuộc tính đã cho nếu ko có thì 1 bản ghi mới sẽ trả về
                    $tagInstance= $this->tag->firstOrCreate([
                        'name' => $tagItem
                    ]);
                    // 1 sản phẩm thì có nhiều tag
                    $tagIds[]= $tagInstance->id;
                }
            }
            //tags() là hàm tạo mỗi liên kết giữ các bảng liên quan tại bảng trung gian product_tag giữa bảng tag và bảng sản phảm 
            // 1 tag có nhiều sản phẩm, 1 sản phẩm có nhiều tag->attach gắn vai trò sản phẩm bằng cách chèn bản ghi vào bảng trung gian của mối quan hệ
            $product->tags()->attach($tagIds);
            //khi nào đoạn code trên chạy đến db conmmit() thì mới insert vào cơ sở dữ liệu
            //không thì sẽ db rollback() lại dữ liệu và ko có j được insert 
            DB::commit();
            return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công');

        }catch(Exception $exception){
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' line: ' . $exception->getLine());
            throw $exception; // Ném ngoại lệ sau khi ghi log
        }
        
    }
    public function edit($id){
        $product= $this->product->find($id);
        $htmlOption= $this->getCategory($product->category_id);
        return view('admin.product.edit',compact('htmlOption','product'));
    }
    public function update($id,Request $request){
        try{
            DB::beginTransaction();
            $dataProductUpdate=[
                'name'=> $request->name,
                'price'=> $request->price,
                'content'=> $request->contents,
                'user_id'=> auth()->id(),
                'category_id' => $request->category_id,
    
            ];
            $dataUploadfeatureImage= $this->storeTraitUpload($request,'feature_image_path','product');
            if(!empty($dataUploadfeatureImage)){
                $dataProductUpdate['feature_image_name']=$dataUploadfeatureImage['file_name'];
                $dataProductUpdate['feature_image_path']=$dataUploadfeatureImage['file_path'];
            }
             $this->product->find($id)->update($dataProductUpdate);
             $product= $this->product->find($id);
            //Insert data to product_images
            //sử dụng laravel 8 eloqument relationship 1-n
            if($request->hasFile('image_path')){
                $this->productImage->where('product_id',$id)->delete();
                foreach ($request->image_path as $fileItem ){
                    $dataProductImageDetail=$this->storeTraitUploadnutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);
                }
            }
    
            //Insert tags for product
            //sử dụng laravel 8 eloqument relationship n-n
            

            if(!empty($request->tags)){
                foreach ($request->tags as $tagItem) {
                    //Insert to tags
                    // firstOrCreate định vị một bản ghi trong cơ sở dữ liệu khớp với các thuộc tính đã cho nếu ko có thì 1 bản ghi mới sẽ trả về
                    $tagInstance= $this->tag->firstOrCreate([
                        'name' => $tagItem
                    ]);
                    // 1 sản phẩm thì có nhiều tag
                    $tagIds[]= $tagInstance->id;
                }
            }
            //tags() là hàm tạo mỗi liên kết giữ các bảng liên quan tại bảng trung gian product_tag giữa bảng tag và bảng sản phảm 
            // 1 tag có nhiều sản phẩm, 1 sản phẩm có nhiều tag->attach gắn vai trò sản phẩm bằng cách chèn bản ghi vào bảng trung gian của mối quan hệ
            $product->tags()->sync($tagIds);
            //khi nào đoạn code trên chạy đến db conmmit() thì mới insert vào cơ sở dữ liệu
            //không thì sẽ db rollback() lại dữ liệu và ko có j được insert 
            DB::commit();
            return redirect()->route('product.index');

        }catch(Exception $exception){
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' line: ' . $exception->getLine());
            throw $exception; // Ném ngoại lệ sau khi ghi log
        }
    }
    public function delete($id){
        return $this->deleteModelTrait($id,$this->product);
    }
    
}
