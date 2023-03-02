<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Texts extends Model
{
    protected $table = 'texts';
    protected $fillable = ['id','product_id','admin_id','title','template','description','updated_at','created_at'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function parameters()
    {
        return $this->hasMany(Parameters::class);
    }
}