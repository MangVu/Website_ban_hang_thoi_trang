<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function roles(){
        return $this->belongsToMany(Role::class, 'role_user','user_id','role_id');
    }
    public function checkPermissionAcess($permissionCheck){
        //user đang login hệ thống có quyên thêm suwarvaf quyền xem menu
        //Lay duoc tat cac cac quyen cuar user dang login vao he thong
        //so sanh gia tri duwa vao cua router hien tai xem cos ton tai trong cac quyen lay duoc hay ko
        $roles=auth()->user()->roles;
        foreach ($roles as $role) {
           $permissions= $role->permissions;
           if($permissions->contains('key_code',$permissionCheck)){
                return true;
           }
           return false;
        }
        // đang sai được cấp qyền vào mà ko vào xem đượ danh sách menu và categories
    }
}
