<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['id','name','last_name','email','phone', 'country_code' ,'password','photo','updated_at','created_at'];
    public function Shopping() {
        return $this->hasMany(Shopping::class);
    }
    
}