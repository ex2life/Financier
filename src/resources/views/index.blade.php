@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <a class="mt-3 btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8" href="{{ route('calc_list') }}">Кредитный
                калькулятор </a>
            <a class="mt-3 btn btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="{{ route('limit_list') }}">Расчет суммы кредита</a>
            <a class="mt-3 btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="#">Финансовый анализ</a>
            <a class="mt-3 btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="#">Управленческая отчетность</a>
            <a class="mt-3 btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="#">Анализ инвестиционных проектов</a>
        </div>
    </div>
@endsection
