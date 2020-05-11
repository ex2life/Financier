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
    <div class="container" id="calc_app">
        <div class="card mt-md-5 opacitybg">
            <form action="{{ route('calc_graf') }}" id="frmPlatezhParam" method="post">
                @csrf
                <div class="card-header">
                    <h2 class="text-center">Оценка кредита для групп заемщиков</h2>
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
                    <div class="list-group">
                        @forelse ($gszs as $num=>$gsz)
                            @if (count($gsz->company)>0 and $gsz->credit_info->month>0)
                                <a class="list-group-item list-group-item-action flex-column align-items-start" href="{{route('credit_limit',['id'=>$gsz->id])}}">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$gsz->brief_name}}</h5>
                                        <div>
                                            <small
                                                class="text-muted">Создана {{$gsz->created_at->diffForHumans()}}</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <p class="mb-1">{{$gsz->full_name}}</p>
                                            <p class="mb-1"><strong>Начало
                                                    деятельности: </strong>{{$gsz->date_begin_work()}}</p>
                                            <div class="d-flex">
                                                <div class="row ml-0 mb-1">
                                                    <div class=""><strong>Дата
                                                            расчета: </strong>{{$gsz->date_calc_limit->date}}</div>
                                                </div>
                                            </div>
                                            @if ($gsz->credit_info->month>0)
                                                <div class="d-flex">
                                                    <div class="row ml-0 mb-1">
                                                        <div class=""><strong>Срок
                                                                кредита: </strong>{{$gsz->credit_info->month.pluralForm($gsz->credit_info->month,' месяц', ' месяца', ' месяцев')}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="row ml-0 mb-1">
                                                        <div class=""><strong>Требуемая сумма
                                                                кредита: </strong>{{str_replace('.00', '', number_format( $gsz->credit_info->sum, 2, '.', ' '))}}</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="row ml-0 mb-1">
                                                        <div class=""><strong>Ставка, предложенная
                                                                банком: </strong>{{$gsz->credit_info->stavka}}%
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="text-danger">Данные о кредите еще не заполнены</div>
                                            @endif

                                        </div>
                                        <div class="col-md-6 col-12 flex-column mt-auto">
                                        </div>
                                    </div>

                                    <small
                                        class="text-muted">{{count($gsz->company_work6Month()).pluralForm(count($gsz->company),' компания работает', ' компании работают', ' компаний работает')}}
                                        более 6 мес.</small></a>
                            @endif
                        @empty
                            У вас пока нет групп.
                        @endforelse
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row ">
                        <div class="col-12 col-md-6">
                            <div class="text-info"><small>Если группы нет в списке, необходимо заполнить данные о кредите</small></div>
                        </div>
                        <div class="col-12 col-md-6 text-right">
                            <a type="button" class="btn btn-secondary" href="{{ route('limit_list') }}">Назад</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
