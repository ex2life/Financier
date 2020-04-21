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
            $table->biginteger('inn')->unsigned();
            $table->biginteger('g_s_z_id')->unsigned();
            $table->biginteger('o_p_f_id')->unsigned();
            $table->biginteger('s_n_o_id')->unsigned();
            $table->date('date_registr')->nullable()->default(Null);
            $table->date('date_begin_work')->nullable()->default(Null);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('g_s_z_id')->references('id')->on('g_s_z_s');
            $table->foreign('o_p_f_id')->references('id')->on('o_p_f_s');
            $table->foreign('s_n_o_id')->references('id')->on('s_n_o_s');
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
