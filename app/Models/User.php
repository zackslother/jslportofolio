<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'session_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Relationship with Payment
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Relationship with Purchases
    public function purchases()
    {
        return $this->hasMany(UserPurchase::class);
    }
}