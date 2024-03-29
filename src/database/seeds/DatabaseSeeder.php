<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OpfSeeder::class);
        $this->call(SnoSeeder::class);
        $this->call(BalanceArticleSeeder::class);
        $this->call(FinanceReportArticlesSeeder::class);
    }
}
