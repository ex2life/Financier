@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <a class="mt-3 btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8" href="{{ route('calc_annuit') }}">Аннуитетный
                платеж </a>
            <a class="mt-3 btn btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="{{ route('calc_differ') }}">Дифференцированный платеж</a>
            <a class="mt-3 btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="{{ route('calc_flex') }}">Гибкий график погашения</a>
            <a class="mt-3 btn btn-light btn-lg col-10 offset-1 col-md-4 offset-md-8"
               href="{{ route('index') }}">Назад</a>
        </div>
    </div>
@endsection
