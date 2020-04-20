<?php

use App\OPF;
use Illuminate\Database\Seeder;

class OPFSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $opf=new OPF();
        $opf->brief_name='ИП';
        $opf->full_name='Индивидуальный предприниматель';
        $opf->inn_length=12;
        $opf->is_corporation=False;
        $opf->save();

        $opf=new OPF();
        $opf->brief_name='ООО';
        $opf->full_name='Общество с ограниченной ответственностью';
        $opf->inn_length=10;
        $opf->is_corporation=True;
        $opf->save();

        $opf=new OPF();
        $opf->brief_name='АО';
        $opf->full_name='Акционерное общество';
        $opf->inn_length=10;
        $opf->is_corporation=True;
        $opf->save();

        $opf=new OPF();
        $opf->brief_name='ПАО';
        $opf->full_name='Публичное акционерное общество';
        $opf->inn_length=10;
        $opf->is_corporation=True;
        $opf->save();

    }
}
