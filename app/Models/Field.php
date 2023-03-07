<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'location', 'size'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function labor(){
        return $this->hasMany(Labor::class);
    }

    public function crop(){
        return $this->hasMany(Crop::class);
    }

    public function cost(){
        return $this->hasMany(Cost::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}
