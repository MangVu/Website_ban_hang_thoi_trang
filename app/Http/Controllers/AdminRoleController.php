<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\RoleAddRequest;

class AdminRoleController extends Controller
{
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
        dd($request->permission_id);
        $role = $this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('roles.index');
    }
}
