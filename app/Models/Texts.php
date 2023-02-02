<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Texts extends Model
{
    protected $table = 'texts';
    protected $fillable = ['id','id_product','id_admin','title','template','description','updated_at','created_at'];
}