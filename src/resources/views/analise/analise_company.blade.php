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
                    <h2 class="text-center">Финасовый анализ компании {{$company->name}}</h2>
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

                    <div class="row">
                        <div class="col-12 col-xl-5">
                            <ul class="list-group">
                                <li class="list-group-item text-right "><span
                                        class="pull-left "><strong>Инн:</strong></span> {{$company->inn}}
                                </li>
                                <li class="list-group-item text-right"><span
                                        class="pull-left"><strong>Организационно-правовая
                            форма:</strong></span> {{$company->opf->brief_name}}
                                </li>
                                <li class="list-group-item text-right"><span
                                        class="pull-left"><strong>Система
                            налогооблажения:</strong></span> {{$company->sno->brief_name}}
                                </li>
                                <li class="list-group-item text-right"><span
                                        class="pull-left"><strong>Зарегистрирована:</strong></span> {{$company->date_registr}}
                                </li>
                                <li class="list-group-item text-right"><span
                                        class="pull-left"><strong>Дата расчета лимита:</strong></span> {{$company->gsz->date_calc_limit->date}}
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
                                        class="pull-left "><strong>Класс компаниии:</strong></span>
                                    <div class="{{$class_company<1.23 ? 'text-danger' : ($class_company<2.9 ? 'text-info' : 'text-success') }}">{{$class_company}}({{$class_company<1.23 ? 'Значительный риск банкротства' : ($class_company<2.9 ? 'Компания в неопределенном состоянии' : 'Финансовая надежность не вызывает сомнений')}})</div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row text-right">
                        <div class="col-12">
                            <a type="button" class="btn btn-secondary" href="{{ route('analise_company_list',['id'=>$company->gsz->id]) }}">Назад</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
