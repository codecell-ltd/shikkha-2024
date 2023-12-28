<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolManualMarkTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_manual_mark_types', function (Blueprint $table) {
            $table->id();
            // $table->string('type_name');
            $table->foreignId('result_mark_type_id')->constrained('school_mark_types')->cascadeOnDelete();
            $table->foreignId('institute_class_id')->constrained('institute_classes')->cascadeOnDelete();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_manual_mark_types');
    }
}
