<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_users', function (Blueprint $table) {
            $table->id();
            $table->string("email")->unique();
            $table->string("phone")->nullable();
            $table->string("password");
            $table->enum("guard", ["school", "teacher", "student", "staff", "admin"]);
            $table->integer("guard_id")->comment("existing table id");
            $table->integer("school_from")->nullable()->comment("existing school id");
            $table->foreignId("role_id")->nullable();
            $table->foreign("role_id")->references("id")->on("roles")->onDelete("cascade");
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('all_users');
    }
}
