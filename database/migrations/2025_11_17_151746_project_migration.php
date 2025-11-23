<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); 
            $table->string('judul_project');
            $table->text('deskripsi_project');
            $table->string('image_project')->nullable();
            $table->decimal('project_price', 12, 2)->default(1000000000);      
            $table->string('download_link')->nullable();      
            $table->timestamps();
            $table->softDeletes();                      
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
