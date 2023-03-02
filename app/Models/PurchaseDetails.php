<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    protected $table = 'purchasedetail';
    protected $fillable = ['id','shopping_id','product_id','quantity','price','updated_at','created_at'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}