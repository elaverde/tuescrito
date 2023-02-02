<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    protected $table = 'purchasedetail';
    protected $fillable = ['id','id_shopping','id_product','quantity','price','description','updated_at','created_at'];
}