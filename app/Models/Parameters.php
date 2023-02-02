<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameters extends Model
{
    protected $table = 'parameters';
    protected $fillable = ['id','id_texts','label','simbol_remplace','updated_at','created_at'];
}