@extends('layouts.app')

@section('content')
    <div class="container">
        <header>
            <h1 class="text-center">ФИНАНСИСТ ОНЛАЙН</h1>
        </header>
        <div class="row">
            <a class="btn_margin btn btn-outline-dark btn-lg col-3 offset-md-9" href="./cred_calc/calc.html">Кредитный
                калькулятор </a>
            <a class="btn_margin btn btn-outline-dark btn-lg col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xs-offset-1 col-sm-offset-5 col-md-offset-7 col-lg-offset-9"
               href="cred_limit/limit.html">Расчет суммы кредита</a>
            <a class="btn_margin btn btn-outline-dark btn-lg col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xs-offset-1 col-sm-offset-5 col-md-offset-7 col-lg-offset-9"
               href="#">Финансовый анализ</a>
            <a class="btn_margin btn btn-outline-dark btn-lg col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xs-offset-1 col-sm-offset-5 col-md-offset-7 col-lg-offset-9"
               href="#">Управленческая отчетность</a>
            <a class="btn_margin btn btn-outline-dark btn-lg col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xs-offset-1 col-sm-offset-5 col-md-offset-7 col-lg-offset-9"
               href="#">Анализ инвестиционных проектов</a>
        </div>
    </div>
@endsection
