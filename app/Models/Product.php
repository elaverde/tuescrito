<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['id','category_id','name','price','description','updated_at','created_at'];
    public function texts()
    {
        return $this->hasMany(Texts::class);
    }
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}