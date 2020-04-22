<?php

use App\Sno;
use Illuminate\Database\Seeder;

class SnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sno=new Sno();
        $sno->brief_name='OCНО';
        $sno->full_name='Общая система налогообложения, уплачивается НДС';
        $sno->cred_limit_affect=True;
        $sno->save();

        $sno=new Sno();
        $sno->brief_name='УСН/Д-Р';
        $sno->full_name='Упрощенная система налогообложения, объект обложения - доходы, уменьшенные на величину расходов';
        $sno->cred_limit_affect=True;
        $sno->save();

        $sno=new Sno();
        $sno->brief_name='УСН/Д';
        $sno->full_name='Упрощенная система налогообложения, объект обложения - доходы';
        $sno->cred_limit_affect=True;
        $sno->save();

        $sno=new Sno();
        $sno->brief_name='ЕСХН';
        $sno->full_name='Единый сельхозналог';
        $sno->cred_limit_affect=True;
        $sno->save();

        $sno=new Sno();
        $sno->brief_name='ЕНВД';
        $sno->full_name='Единый налог на вмененный доход';
        $sno->cred_limit_affect=False;
        $sno->save();
    }
}
