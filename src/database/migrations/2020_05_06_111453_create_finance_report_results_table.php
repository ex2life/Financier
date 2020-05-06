<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceReportResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_report_results', function (Blueprint $table) {
            $table->id();
            $table->biginteger('finance_report_article_id')->nullable()->unsigned();
            $table->biginteger('balance_date_id')->nullable()->unsigned();
            $table->float('value')->default('0');
            $table->timestamps();

            $table->foreign('finance_report_article_id')->references('id')->on('finance_report_articles');
            $table->foreign('balance_date_id')->references('id')->on('balance_dates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finance_report_results');
    }
}
