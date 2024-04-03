<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\RoleAddRequest;
use App\Traits\DeleteModelTrait; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class AdminRoleController extends Controller
{
    use deleteModelTrait;
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission){
        $this->role = $role;
        $this->permission = $permission;
    }
    public function index(){
         $roles=$this->role->paginate(5);
         return view('admin.role.index', compact('roles'));
    }
    public function create(){
        $permissionsParent= $this->permission->where('parent_id',0)->get();
        return view('admin.role.add', compact('permissionsParent'));
    }
    public function store(RoleAddRequest $request){
        try {
            DB::beginTransaction();
            $role = $this->role->create([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);
            $role->permissions()->attach($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' line: ' . $exception->getLine());
            throw $exception; // Ném ngoại lệ sau khi ghi log
        }
        
    }
    public function edit($id){
        $permissionsParent= $this->permission->where('parent_id',0)->get();
        $role=$this->role->find($id);
        $permissionChecked=$role->permissions;
        return view('admin.role.edit', compact('permissionsParent','role','permissionChecked'));
    }
    public function update($id,RoleAddRequest $request){
        try {
            DB::beginTransaction();
            $this->role->find($id)->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);
            $role= $this->role->find($id);
            $role->permissions()->sync($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' line: ' . $exception->getLine());
            throw $exception; // Ném ngoại lệ sau khi ghi log
        }
    }
    public function delete($id){
        return $this->deleteModelTrait($id,$this->role);
    }
}

