<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->unsignedBigInteger('adminId');
            $table->string('description')->nullable(false);
            $table->unsignedBigInteger('workspaceId');
            $table->timestamps();
        
            $table->foreign('adminId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('workspaceId')->references('id')->on('workspace')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
