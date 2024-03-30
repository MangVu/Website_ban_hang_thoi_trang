<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\AdminUserController;
use Illuminate\Http\Request;
use App\Http\Requests\UserAddRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\DeleteModelTrait; 
class AdminUserController extends Controller
{   
    use deleteModelTrait;
    private $user;
    private $role;
    public function __construct(User $user,Role $role){
        $this->user = $user;
        $this->role = $role;
    }
    public function index(){
         $users=$this->user->paginate(5);
         return view('admin.user.index', compact('users'));
    }
    public function create(){
        $roles= $this->role->all();
        return view('admin.user.add', compact('roles'));
    }
    public function store(UserAddRequest $request){
        try {
            DB::beginTransaction();
            $user= $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $roleIds= $request->role_id;
            $user->roles()->attach($roleIds);
            //insert vào bảng trung gian
            // foreach ($roleIds as $roleItem){
            //     \DB::table('role_user')->insert([
            //         'user_id' => $user->id,
            //         'role_id' => $roleItem,
            //     ]);
            // }
            // thay vì dùng cách trên thì dùng laravel Relationship N-N-> tạo function trong model User
            DB::commit();
            return redirect()->route('users.index');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' line: ' . $exception->getLine());
            throw $exception; // Ném ngoại lệ sau khi ghi log
        }
    }
    public function edit($id){
        $roles= $this->role->all();
        $user=$this->user->find($id);
        $roleOfUser= $user->roles;// roles là phương thức trung gian 
        return view('admin.user.edit', compact('roles','user','roleOfUser'));
    }
    public function update(UserAddRequest $request, $id){
        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user= $this->user->find($id);
            $roleIds= $request->role_id;
            $user->roles()->sync($roleIds);//kiểm tra xem vai trò nào đã tòn tại thì giữ mà mới thì thêm vào
            //insert vào bảng trung gian
            // foreach ($roleIds as $roleItem){
            //     \DB::table('role_user')->insert([
            //         'user_id' => $user->id,
            //         'role_id' => $roleItem,
            //     ]);
            // }
            // thay vì dùng cách trên thì dùng laravel Relationship N-N-> tạo function trong model User
            DB::commit();
            return redirect()->route('users.index');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' line: ' . $exception->getLine());
            throw $exception; // Ném ngoại lệ sau khi ghi log
        }
    }
    public function delete($id){
        return $this->deleteModelTrait($id,$this->user);
    }
}
