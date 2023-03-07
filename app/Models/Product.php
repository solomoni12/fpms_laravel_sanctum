<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'crop_id', 'field_id', 'name', 'price', 'unit'
    ];

    public function crop(){
        return $this->belongsTo(Crop::class);
    }

    public function field(){
        return $this->belongsTo(Field::class);
    }
}
