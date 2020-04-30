<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateCalcLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_calc_limits', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable(false);
            $table->biginteger('gsz_id')->unsigned();
            $table->timestamps();

            $table->foreign('gsz_id')->references('id')->on('gszs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('date_calc_limits');
    }
}
