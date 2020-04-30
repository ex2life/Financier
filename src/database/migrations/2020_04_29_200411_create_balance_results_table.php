<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_results', function (Blueprint $table) {
            $table->id();
            $table->biginteger('balance_article_id')->nullable()->unsigned();
            $table->biginteger('balance_date_id')->nullable()->unsigned();
            $table->float('Value')->default('0');
            $table->timestamps();

            $table->foreign('balance_article_id')->references('id')->on('balance_articles');
            $table->foreign('balance_date_id')->references('id')->on('balance_dates')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balance_results');
    }
}
