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
            $table->string('email')->unique();
            $table->string('google_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->nullable();
            $table->integer('robot')->nullable();
            $table->string('avatar')->default('user.jpg');
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('publicemail')->nullable();
            $table->string('siteurl')->nullable();
            $table->string('youtube_follow_tags')->default('vegetta777');
            $table->string('instagram_follow_tags')->default('instagram');
            $table->string('facebook_follow_tags')->default('facebook');
            $table->string('twitter_username_for_follow')->default('jack');
            $table->string('flicker_keyword')->default('iran');
            $table->string('flicker_username')->default('mrlast');
            $table->string('yt_playlist')->nullable();
            $table->string('yt_chid')->nullable();
            $table->string('yt_keywords')->nullable();
            $table->string('fb_groupname')->nullable();
            $table->string('instagram_user_name')->default('cristiano');
            $table->string('twitter_hashtag')->nullable();
            $table->string('user_name')->unique()->nullable();
            $table->string('city')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('country')->default('last.today');
            $table->string('state')->nullable();
            $table->string('language')->nullable();
            $table->string('about')->nullable();
            $table->string('cover')->default('cover.jpg');
            $table->string('status')->nullable();
            $table->string('complete_the_profile')->nullable();
            $table->string('site_feeds')->default('https://www.buzzfeed.com/world.xml');
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
