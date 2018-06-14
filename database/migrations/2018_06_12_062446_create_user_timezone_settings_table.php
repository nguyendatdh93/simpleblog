<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTimezoneSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_timezone_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('timezone');
            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_timezone_settings');
    }
}
