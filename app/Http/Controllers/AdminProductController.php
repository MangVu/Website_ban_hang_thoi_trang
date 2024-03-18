<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Products;
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

    public function __construct(Category $category, Products $product){
        $this->category = $category;
        $this->product = $product;
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
        dd($product);
    }
}
