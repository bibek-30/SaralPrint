<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['male', 'female', 'others'])->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('password');
            $table->string('mobile_number')->unique();
            // $table->integer('telephone')->default('xxxxxxxxx');
            $table->timestamp('mobile_number_verified_at')->nullable();
            $table->string('mobile_verified_code')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->enum('type', ['individual', 'corporate', 'admin']);
            $table->string('pan_number')
                ->unique()
                ->nullable();
            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending');
            $table->string('pan_document')
                ->unique()->nullable();
            $table->boolean('is_admin')->default(false);
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
        Schema::dropIfExists('users');
    }
};
