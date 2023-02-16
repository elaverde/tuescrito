<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    protected $table = 'purchasedetail';
    protected $fillable = ['id','shopping_id','product_id','quantity','price','description','updated_at','created_at'];
}