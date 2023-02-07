<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['id','id_category','name','description','updated_at','created_at'];
}