<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovorningBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('govorning_bodies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->require;
            $table->string('designation')->require;
            $table->text('image');
            $table->timestamps();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('govorning_bodies');
    }
}
