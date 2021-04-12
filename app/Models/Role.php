<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;
    public $timestamps = false;
    // public $table = "roles";  // this is required for mappiing to table if it does not have plural naming convention
    // protected $primaryKey = 'role_id';

    public function getUser(){
        
        // echo json_encode($this->hasMany('App\Models\User'));
        // echo $this->getForeignKey();
        // echo $this->$primaryKey;

        // var_dump(response()->$this->hasMany(User::class));
        return $this->hasMany(User::class, 'roles_id')->get();
    }
}
