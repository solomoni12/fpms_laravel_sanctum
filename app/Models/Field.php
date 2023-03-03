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
}
