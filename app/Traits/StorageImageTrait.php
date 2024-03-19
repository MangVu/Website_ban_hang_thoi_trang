<?php
namespace App\Traits;
use Storage;
use Illuminate\Support\Str;
//tối ưu code tránh việc lặp đi lặp lại
trait StorageImageTrait {
    public function storeTraitUpload($request, $fieldname, $folderName) {
        if ($request->hasFile($fieldname)) { // Kiểm tra nếu trường hasFile tồn tại
            $file = $request->file($fieldname);
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filepath = $request->file($fieldname)->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash); // Sử dụng $folderName thay vì foldername
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                //lưu một tệp bằng cách sử dụng Storage, nó sẽ được lưu trữ trong một vị trí được cấu hình trước đó, ví dụ như public, local, hoặc s3. Storage::url() sẽ trả về URL của tệp dựa trên vị trí lưu trữ này
                //dùng nó để truy cập trực tiếp vào tệp từ trình duyệt 
                'file_path' => Storage::url($filepath)
            ];
            return $dataUploadTrait;
        }
        return null;
    }
    public function storeTraitUploadnutiple($file, $folderName) {
            //$file = $request->file($fieldname);tuong dduowwng với $fileItem của hàm foreach bên ham store
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filepath = $file->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash); // Sử dụng $folderName thay vì foldername
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                //lưu một tệp bằng cách sử dụng Storage, nó sẽ được lưu trữ trong một vị trí được cấu hình trước đó, ví dụ như public, local, hoặc s3. Storage::url() sẽ trả về URL của tệp dựa trên vị trí lưu trữ này
                //dùng nó để truy cập trực tiếp vào tệp từ trình duyệt 
                'file_path' => Storage::url($filepath)
            ];
            return $dataUploadTrait;
       
    }
}
