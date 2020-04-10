<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialIdentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_idents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('google')->nullable();;
            $table->string('twitter')->nullable();;
            $table->string('facebook')->nullable();;
            $table->string('vkontakte')->nullable();;
            $table->string('telegram')->nullable();;
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')

                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_idents');
    }
}
