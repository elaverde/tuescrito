<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    protected $table = 'shopping';
    protected $fillable = ['id','user_id','price','view','send','updated_at','created_at'];
    // Definir la relación "hasManyThrough" con el modelo Product
    public function products() {
        return $this->hasManyThrough(Product::class, PurchaseDetails::class);
    }

    // Definir la relación "hasMany" con el modelo PurchaseDetail
    public function purchaseDetails() {
        return $this->hasMany(PurchaseDetails::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}