<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentDescriptionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('employment_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('user_Id');
            $table->integer('employment_Id');
            $table->text('description')->nullable();
            $table->text('achievements')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employment_descriptions');
    }
}
