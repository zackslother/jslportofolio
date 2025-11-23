<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projects extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectsFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'judul_project',
        'deskripsi_project',
        'image_project',
        'project_price',
        'download_link'
    ];
}