<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOPFSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opfs', function (Blueprint $table) {
            $table->id();
            $table->char('brief_name', 10);
            $table->char('full_name', 100);
            $table->tinyinteger('inn_length')->unsigned();
            $table->boolean('is_corporation')->comment('Признак того, что компания является организацией (не ИП). У ИП=0, у других = 1.');
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
        Schema::dropIfExists('opfs');
    }
}
