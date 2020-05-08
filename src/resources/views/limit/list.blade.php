@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <a class="mt-3 btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="{{route('gsz_list')}}">Группы связанных заемщиков</a>
            <a class="mt-3 btn btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="{{route('gsz_dates')}}">Финансовые данные ГСЗ</a>
            <a class="mt-3 btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="{{route('credit_info')}}">Данные по кредиту</a>
            <a class="mt-3 btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="{{route('credit_limit_list')}}">Расчет максимального лимита</a>
            <a class="mt-3 btn btn-secondary btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="{{ route('index') }}">Назад</a>
        </div>
    </div>
@endsection
