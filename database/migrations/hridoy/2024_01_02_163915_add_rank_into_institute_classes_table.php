<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRankIntoInstituteClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institute_classes', function (Blueprint $table) {
            $table->integer('rank')->nullable()
                  ->comment('-1 = Play, 0 = Nursery, 1 = Class One, 2 = Class Two, 3 = Class Three, 4 = Class Four, 5 = Class Five, 6 = Class Six, 7 = Class Seven, 8 = Class Eight, 9 = Class Nine, 10 = Class Ten, 11 = SSC Examinee, 12 = Class Eleven, 13 = Class Twelve');
            $table->integer('last_session_updated_year')->default(2022);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('institute_classes', function (Blueprint $table) {
            $table->dropColumn('rank')->nullable();
        });
    }
}
