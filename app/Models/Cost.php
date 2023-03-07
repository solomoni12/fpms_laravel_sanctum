<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_id', 'description', 'amount'
    ];

    public function field(){
        return $this->belongsTo(Field::class);
    }
}
