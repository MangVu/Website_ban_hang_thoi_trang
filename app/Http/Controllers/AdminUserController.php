<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\AdminUserController;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
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
}
