@extends('layouts.app')
<?php
function pluralForm($n, $form1, $form2, $form5)
{
    $n = abs($n) % 100;
    $n1 = $n % 10;
    if ($n > 10 && $n < 20) return $form5;
    if ($n1 > 1 && $n1 < 5) return $form2;
    if ($n1 == 1) return $form1;
    return $form5;
}
?>
@section('content')
    <div class="container " id="calc_app">
        <div class="card mt-md-5 opacitybg">
            <form action="{{ route('calc_graf') }}" id="frmPlatezhParam" method="post">
                @csrf
                <div class="card-header">
                    <h2 class="text-center">Финасовый анализ группы {{$gsz->brief_name}}</h2>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('status_info'))
                        <div class="alert alert-info" role="alert">
                            {{ session('status_info') }}
                        </div>
                    @endif

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="gsz-tab" data-toggle="tab" href="#gsz" role="tab"
                               aria-controls="gsz" aria-selected="true">Анализ группы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="company-tab" data-toggle="tab" href="#company" role="tab"
                               aria-controls="company" aria-selected="false">Анализ компаний</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="gsz" role="tabpanel" aria-labelledby="gsz-tab">
                            <div class="row">
                                <div class="col-12 col-xl-5">
                                    <ul class="list-group">
                                        <li class="list-group-item text-right"><span
                                                class="pull-left"><strong>Название:</strong></span>  {{$gsz->full_name}}
                                        </li>
                                        <li class="list-group-item text-right"><span
                                                class="pull-left"><strong>Всего компаний:</strong></span>  {{$gsz->company->count()}}
                                        </li>
                                        <li class="list-group-item text-right"><span
                                                class="pull-left"><strong>Компаний, работает более 6 месяцев:</strong></span>  {{$gsz->company_work6Month()->count()}}
                                        </li>
                                        <li class="list-group-item text-right"><span
                                                class="pull-left"><strong>Дата начала деятельности:</strong></span>  {{$gsz->date_begin_work()}}
                                        </li>
                                        <li class="list-group-item text-right"><span
                                                class="pull-left"><strong>Результаты:</strong></span> <span class="text-success">Хорошо</span> <span class="text-info">Пойдет</span> <span class="text-danger">Все плохо</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-xl-7 pt-xl-0 pt-3">
                                    <ul class="list-group">
                                        <li class="list-group-item text-right "><span
                                                class="pull-left "><strong>Коэффициент абсолютной ликвидности:</strong></span>
                                            <div class="{{$k1<0.2 ? 'text-danger' : ($k1>0.5 ? 'text-info' : 'text-success') }}">{{$k1}}</div>
                                        </li>
                                        <li class="list-group-item text-right "><span
                                                class="pull-left "><strong>Промежуточный коэффициент покрытия:</strong></span>
                                            <div class="{{$k2<0.7 ? 'text-danger' : ($k2>1 ? 'text-info' : 'text-success') }}">{{$k2}}</div>
                                        </li>
                                        <li class="list-group-item text-right "><span
                                                class="pull-left "><strong>Коэффициент покрытия обязательств:</strong></span>
                                            <div class="{{$k3<1.5 ? 'text-danger' : ($k3>2.5 ? 'text-info' : 'text-success') }}">{{$k3}}</div>
                                        </li>
                                        <li class="list-group-item text-right "><span
                                                class="pull-left "><strong>Коэффициент соотношения собственных и заемных средств:</strong></span>
                                            <div class="{{$k4>1 ? 'text-danger' : ($k4>0.5 ? 'text-info' : 'text-success') }}">{{$k4}}</div>
                                        </li>
                                        <li class="list-group-item text-right "><span
                                                class="pull-left "><strong>Рентабельность продукции (рентабельность продаж):</strong></span>
                                            <div class="{{!$k5_status ? 'text-danger'  : 'text-success'}}">{{$k5}}({{!$k5_status ? 'Падает'  : 'Растет'}})</div>
                                        </li>
                                        <li class="list-group-item text-right "><span
                                                class="pull-left "><strong>Суммарный класс компаний:</strong></span>
                                            <div class="{{$class_company<1.23 ? 'text-danger' : ($class_company<2.9 ? 'text-info' : 'text-success') }}">{{$class_company}}({{$class_company<1.23 ? 'Значительный риск банкротства' : ($class_company<2.9 ? 'Компания в неопределенном состоянии' : 'Финансовая надежность не вызывает сомнений')}})</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="company-tab">
                            <div class="row @if (count($companies)>1)row-cols-1 row-cols-md-2 @endif">
                                @forelse ($companies as $num=>$company)
                                    <div class="col d-flex align-items-stretch @if ($num>1) mt-3 @endif">
                                        <div class="card w-100">
                                            <div class="card-body">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h4 class="mb-1">{{$company->name}}</h4>
                                                    <div>
                                                        <small
                                                            class="text-muted">Создана {{$company->created_at->diffForHumans()}}</small>&ensp;
                                                    </div>
                                                </div>
                                                <p class="my-1"><strong>Инн:</strong> {{$company->inn}}</p>
                                                <p class="mb-1"><strong>Организационно-правовая
                                                        форма:</strong> {{$company->opf->brief_name}}</p>
                                                <p class="mb-1"><strong>Система
                                                        налогооблажения:</strong> {{$company->sno->brief_name}}</p>
                                                <p class="mb-1">
                                                    <strong>Зарегистрирована:</strong> {{$company->date_registr}}
                                                </p>
                                                <p class="mb-1"><strong>Начало
                                                        деятельности:</strong> {{$company->date_begin_work}}</p>
                                                <a type="button" class="btn btn-outline-primary" href="{{ route('analise_company', ['id' => $company->id]) }}">Финансовый анализ</a>

                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    В этой группе пока нет компаний.
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row text-right">
                        <div class="col-12">
                            <a type="button" class="btn btn-secondary" href="{{ route('analise_gsz_list') }}">Назад</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
