<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'field_id', 'name', 'quantity'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function field(){
        return $this->belongsTo(Field::class);
    }
}
