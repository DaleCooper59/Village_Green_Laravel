<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'firstname');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->after('id');
            $table->string('lastname')->after('firstname');
            $table->string('gender')->after('lastname');
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
             $table->unsignedInteger('age')->after('gender');
        });

        Schema::table('users', function (Blueprint $table) {
           $table->date('birth')->after('age');
        });

        Schema::table('users', function (Blueprint $table) {
           $table->string('tel', 50)->after('email_verified_at');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
