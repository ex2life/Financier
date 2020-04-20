<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSNOSTable extends Migration
{
    /**
     * Run the migrations.
     *2020_04_20_095233
     * @return void
     */
    public function up()
    {
        Schema::create('s_n_o_s', function (Blueprint $table) {
            $table->id();
            $table->char('brief_name', 10);
            $table->char('full_name', 100);
            $table->boolean('cred_limit_affect');
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
        Schema::dropIfExists('s_n_o_s');
    }
}
