<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Userinfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('userinfos', function (Blueprint $table) {
            $table->bigIncrements('userid');
            $table->string('name');
            $table->string('user_name')->unique();
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->string('user_role');
            $table->timestamp('registered_at');
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
        //
    }
}
