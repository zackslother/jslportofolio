<?php

namespace App\Models;

use App\Models\Projects;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'user_id',
        'project_id',
        'session_id',
        'customer_name',
        'customer_email',
        'amount',
        'status',
    ];

    // Relationship with Project
    public function project()
    {
        return $this->belongsTo(Projects::class);
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}