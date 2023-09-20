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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(false);
            $table->string('requestType')->nullable(false);
            $table->unsignedBigInteger('senderId');
            $table->unsignedBigInteger('receiverId');
            $table->unsignedBigInteger('locationId');
            $table->timestamps();

            $table->foreign('senderId')->references('id')->on("users")->delete();
            $table->foreign('receiverId')->references('id')->on("users")->delete();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
