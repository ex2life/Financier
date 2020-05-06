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
                    <h2 class="text-center">{{$gsz->brief_name}}</h2>
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

                        <div class="row @if (count($companies)>1)row-cols-1 row-cols-md-2 @endif">
                            @forelse ($companies as $num=>$company)
                                <div class="col d-flex align-items-stretch @if ($num>1) mt-3 @endif">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h4 class="mb-1">{{$company->name}}</h4>
                                                <div>
                                                    <small
                                                        class="text-muted">Создана {{$company->created_at->diffForHumans()}}</small>
                                                </div>
                                            </div>
                                            <p class="my-1"><strong>Инн:</strong> {{$company->inn}}</p>
                                            <p class="mb-1"><strong>Организационно-правовая
                                                    форма:</strong> {{$company->opf->brief_name}}</p>
                                            <p class="mb-1"><strong>Система
                                                    налогооблажения:</strong> {{$company->sno->brief_name}}</p>
                                            <p class="mb-1"><strong>Зарегистрирована:</strong> {{$company->date_registr}}
                                            </p>
                                            <p class="mb-1"><strong>Начало
                                                    деятельности:</strong> {{$company->date_begin_work}}</p>
                                            @if (!$company->work6Month())
                                                <small
                                                    class="text-info">Компания не будет учитываться в расчете, так как
                                                    не работает 6 месяцев</small>
                                            @endif
                                            <div class="btn-group btn-group-toggle mt-2">
                                                <a type="button" class="btn btn-outline-primary" href="{{ route('company_balance', ['id' => $company->id]) }}">Баланс</a>
                                                <a type="button" class="btn btn-outline-primary" href="{{ route('company_finance_result', ['id' => $company->id]) }}">Финансовые результаты</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                В этой группе пока нет компаний.
                            @endforelse
                        </div>
                    </div>
                <div class="card-footer">
                    <div class="row text-right">
                        <div class="col-12">
                            <a type="button" class="btn btn-secondary" href="{{ route('gsz_dates') }}">Назад</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{url('/js/limit_app.js')}}" defer></script>
@endsection
