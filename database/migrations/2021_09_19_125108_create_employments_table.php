<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentsTable extends Migration
{
    public function up(): void
    {
        Schema::create('employments', function (Blueprint $table) {
            $table->id();
            $table->string('user_Id');
            $table->integer('user_employment_Id')->nullable();
            $table->string('institution');
            $table->string('position');
            $table->string('time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employments');
    }
}
