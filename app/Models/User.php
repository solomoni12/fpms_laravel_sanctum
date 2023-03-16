<?php

namespace App\Models;

use App\Models\Crop;
use App\Models\Field;
use App\Models\Labor;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function field(){
        return $this->hasMany(Field::class);
    }

    public function labor(){
        return $this->hasMany(Labor::class);
    }

    public function equipment(){
        return $this->hasMany(Equipment::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function crop(){
        return $this->hasManyThrough(Crop::class, Field::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
