<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'equipment_cost'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
