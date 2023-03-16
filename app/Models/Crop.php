<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_id', 'crop_type', 'planting_date', 'harvest_date'
    ];

    public function field(){
        return $this->belongsTo(Field::class);
    }

   /* 
    public function product(){
        return $this->hasMany(Product::class);
    }
    */
}
