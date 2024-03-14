<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use App\Components\Recusive;
class CategoryController extends Controller
{
    
    private $category;
    public function __construct(Category $category){
        
        $this->category = $category;
    }
    
    public function create(){
        $htmlOption= $this->getCategory($parentId ='');
        return view('admin.category.add', compact('htmlOption'));
    }
    
    
    public function index(){
        $categories = $this->category->latest()->paginate(5); // Lấy ra 5 bản ghi mới nhất trên mỗi trang
        return view('admin.category.index', compact('categories')); // Truyền biến categories vào view
    }
    
    public function store(Request $request){
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()-> route('categories.index');
    }
    public function getCategory($parentId){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecursive($parentId);
        return $htmlOption;
    }
    public function edit($id){
        $category = $this->category->find($id);
        // Kiểm tra xem bản ghi có tồn tại không
        if (!$category) {
            // Nếu không tồn tại, có thể xử lý thông báo lỗi hoặc chuyển hướng đến trang khác
            return redirect()->route('categories.index')->with('error', 'Không tìm thấy bản ghi danh mục.');
        }
        // Nếu bản ghi tồn tại, tiếp tục lấy thông tin
        // Gọi phương thức getCategory với giá trị $parentId từ $category
        $htmlOption = $this->getCategory($category->parent_id);//video10
        return view('admin.category.edit', compact('category', 'htmlOption'));
    }

    public function update($id,Request $request){
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()-> route('categories.index');
    }
    
    
    public function delete($id){
        $this->category->find($id)->delete();
        return redirect()-> route('categories.index');
    }
}
