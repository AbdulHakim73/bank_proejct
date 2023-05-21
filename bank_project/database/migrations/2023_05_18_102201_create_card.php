<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{   public function up(): void
    {
        Schema::create('card', function (Blueprint $table) {
            $table->id();
            $table->integer('CardNumber');
            $table->string('FullName');
            $table->string('Date');
            $table->integer('TypeOfCard');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('card');
    }
};
