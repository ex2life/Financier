<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_dates', function (Blueprint $table) {
            $table->id();
            $table->biginteger('date_calc_limit_id')->nullable()->unsigned();
            $table->biginteger('company_id')->nullable()->unsigned();
            $table->date('date_balance')->default(Null);
            $table->timestamps();

            $table->foreign('date_calc_limit_id')->references('id')->on('date_calc_limits')->onDelete('cascade');;
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balance_dates');
    }
}
