<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->enum('gender',['male' , 'female']);
            $table->string('password');
            $table->string('email')->unique();
            // note : only employee can register and login with fb - gmail
            // manager can register by normal e-mail
            $table->string('fb_id')->nullable();
            $table->string('google_id')->nullable();
            // End here
            $table->integer("user_type")->nullable();
            $table->timestamp('email_verified_at')->nullable();
            // $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->rememberToken();
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
}
