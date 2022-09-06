<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('estd');
            $table->string('address');
            $table->longText('maps');
            $table->string('zip');
            $table->string('mobile_number');
            $table->string('landline');
            $table->string('email');
            $table->string('about_us');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('instagram');
            $table->string('linkedIn');
            $table->string('website');
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
        Schema::dropIfExists('settings');
    }
}
