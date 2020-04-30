<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_articles', function (Blueprint $table) {
            $table->id();
            $table->boolean('balance_part')->comment('True - актив, False - пассив');
            $table->boolean('is_section')->default(false)->comment('Признак того, что строка является разделом баланса');
            $table->char('section_code')->comment('Код раздела');
            $table->char('code')->comment('Код статьи');
            $table->boolean('has_children')->default(false)->comment('True - есть подкоды (вычисляемый), False - нет');
            $table->char('parent_code',5)->default(false)->comment('Код статьи-родителя');
            $table->char('description',100);
            $table->boolean('is_sum_section')->default(false)->comment('True - сумма раздела');
            $table->boolean('is_sum_part')->default(false)->comment('True - сумма актива или пассива');
            $table->float('value')->default(false)->comment('Сумма по статье баланса');
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
        Schema::dropIfExists('balance_articles');
    }
}
