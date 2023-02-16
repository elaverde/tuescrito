<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    protected $table = 'shopping';
    protected $fillable = ['id','user_id','price','updated_at','created_at'];
}