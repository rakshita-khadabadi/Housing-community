<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class User extends Model
{
    use HasFactory;
    public $timestamps = false;
    // protected $primaryKey = 'user_id';

    public function getRole(){
        return $this->belongsTo(Role::class, 'id')->get();
    }
}
