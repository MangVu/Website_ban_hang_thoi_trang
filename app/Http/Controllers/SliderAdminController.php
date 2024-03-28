<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Requests\SliderAddRequest;
use App\Traits\StorageImageTrait; 
use App\Traits\DeleteModelTrait; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class SliderAdminController extends Controller
{
    use DeleteModelTrait;
    use StorageImageTrait; //trong app mục đích tái sử dụng code
    private $slider;//biến của class này để giữ cái biến Slider $slider
    //Slider $slider-> đây là biến của model Slider
    public function __construct( Slider $slider){
        $this->slider=$slider;
    }
    public function index(){
        $sliders =$this->slider->latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }
    public function create(){
        return view('admin.slider.add');
    }
    //khi mà bắt đầu chạy thì sẽ qua request đầu tiên để kiểm tra xem tên có trống hay ko,...
    public function store(SliderAddRequest $request){
        try{
            $dataInsert=[
                'name'=>$request->name,
                'description'=>$request->description, 
            ];
            $dataImageSlider= $this->storeTraitUpload($request,'image_path','slider');
            if(!empty($dataImageSlider)){
                $dataInsert['image_name']=$dataImageSlider['file_name'];
                $dataInsert['image_path']=$dataImageSlider['file_path'];
            }
            $this->slider->create($dataInsert);
            return redirect()-> route('slider.index');
        }catch(Exception $exception){
            Log::error('Message: ' . $exception->getMessage() . ' line: ' . $exception->getLine());
            throw $exception; // Ném ngoại lệ sau khi ghi log
        }
        
    }
    public function edit($id){
        $slider = $this->slider->find($id);
        return view('admin.slider.edit',compact('slider'));
    }
    public function update($id,Request $request){
        try{
            $dataUpdate=[
                'name'=>$request->name,
                'description'=>$request->description, 
            ];
            $dataImageSlider= $this->storeTraitUpload($request,'image_path','slider');
            if(!empty($dataImageSlider)){
                $dataUpdate['image_name']=$dataImageSlider['file_name'];
                $dataUpdate['image_path']=$dataImageSlider['file_path'];
            }
            $this->slider->find($id)->update($dataUpdate);
            return redirect()-> route('slider.index');
        }catch(Exception $exception){
            Log::error('Message: ' . $exception->getMessage() . ' line: ' . $exception->getLine());
            throw $exception; // Ném ngoại lệ sau khi ghi log
        }
    }
    public function delete($id){
        return $this->deleteModelTrait($id,$this->slider);
    }

}
