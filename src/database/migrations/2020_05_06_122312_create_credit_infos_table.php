<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_infos', function (Blueprint $table) {
            $table->id();
            $table->biginteger('month')->nullable(false)->default(0);
            $table->biginteger('sum')->nullable(false)->default(0);
            $table->biginteger('stavka')->nullable(false)->default(0);
            $table->biginteger('gsz_id')->unsigned();
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
        Schema::dropIfExists('credit_infos');
    }
}
