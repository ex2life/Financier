<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->char('name', 150);
            $table->biginteger('user_id')->unsigned();
            $table->char('inn',12);
            $table->biginteger('gsz_id')->unsigned();
            $table->biginteger('opf_id')->unsigned();
            $table->biginteger('sno_id')->unsigned();
            $table->date('date_registr')->nullable()->default(Null);
            $table->date('date_begin_work')->nullable()->default(Null);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('gsz_id')->references('id')->on('gszs');
            $table->foreign('opf_id')->references('id')->on('opfs');
            $table->foreign('sno_id')->references('id')->on('snos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
