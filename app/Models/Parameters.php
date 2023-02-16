<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameters extends Model
{
    protected $table = 'parameters';
    protected $fillable = ['id','texts_id','label','key','updated_at','created_at'];
    public function text()
    {
        return $this->belongsTo(Texts::class);
    }
}