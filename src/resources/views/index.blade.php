@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <a class="mt-3 btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8" href="{{ route('calc_list') }}">Кредитный
                калькулятор </a>
            <a class="mt-3 btn btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="{{ route('limit_list') }}">Вероятность одобрения кредита</a>
            <a class="mt-3 btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="{{route('analise_gsz_list')}}">Финансовый анализ</a>
            <a class="mt-3 btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="{{route('buh')}}">Бухгалтерская отчетность</a>
            <a class="mt-3 btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="{{route('profile')}}">Ваш профиль</a>
        </div>
    </div>
@endsection
