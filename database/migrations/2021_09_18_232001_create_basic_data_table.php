<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicDataTable extends Migration
{
    public function up(): void
    {
        Schema::create('basic_data', function (Blueprint $table) {
            $table->id();
            $table->string('user_Id');
            $table->string('name');
            $table->string('surname');
            $table->string('phone')->nullable();
            $table->string('email');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('basic_data');
    }
}
