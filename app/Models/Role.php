<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends Model
{
  use SoftDeletes;
  protected $guarded=[];
  public function permissions(){

    return $this->belongsToMany(Permission::class,'permission_role','role_id','permission_id');
  }
}
