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
                    <h2 class="text-center">Оценка кредита для {{$gsz->brief_name}}</h2>
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
                                        class="pull-left"><strong>Результаты:</strong></span> <span class="text-success">Хорошо</span> <span class="text-info">Нормально</span> <span class="text-danger">Плохо</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-xl-7 pt-xl-0 pt-3">
                            <ul class="list-group">
                                <li class="list-group-item text-right "><span
                                        class="pull-left "><strong>Срок
                                                                кредита:</strong></span>
                                    <div class="">{{$gsz->credit_info->month.pluralForm($gsz->credit_info->month,' месяц', ' месяца', ' месяцев')}}</div>
                                </li>
                                <li class="list-group-item text-right "><span
                                        class="pull-left "><strong>Требуемая сумма
                                                                кредита:</strong></span>
                                    <div class="">{{$gsz->credit_info->sum}}</div>
                                </li>
                                <li class="list-group-item text-right "><span
                                        class="pull-left "><strong>Ставка, предложенная
                                                                банком:</strong></span>
                                    <div class="">{{$gsz->credit_info->stavka}}%</div>
                                </li>
                                <li class="list-group-item text-right "><span
                                        class="pull-left "><strong>Вероятность одобрения данного кредита:</strong></span>
                                    <div class="">{{$gsz->credit_ver()}}%</div>
                                </li>
                                <li class="list-group-item text-right "><span
                                        class="pull-left "><strong>Макс сумма кредита по закону:</strong></span>
                                    <div class="">{{$gsz->max_n12()}}</div>
                                </li>
                                <li class="list-group-item text-right "><span
                                        class="pull-left "><strong>Кредитоспособность:</strong></span>
                                    <div class="{{$class_company<1.23 ? 'text-danger' : ($class_company<2.9 ? 'text-info' : 'text-success') }}">{{$class_company}}({{$class_company<1.23 ? 'Крайне низкая' : ($class_company<2.9 ? 'Требует повышенного внимания' : 'Высокая')}})</div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row text-right">
                        <div class="col-12">
                            <a type="button" class="btn btn-secondary" href="{{ route('credit_limit_list') }}">Назад</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
