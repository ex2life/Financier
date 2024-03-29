@extends('layouts.app')
@section('content')
    <div class="container " id="limit_app">
        <div class="card mt-md-5 opacitybg">
            <div class="card-header">
                <h2 class="text-center">Баланс организации {{$company->name}}</h2>
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
                    <div class="col-12 col-xl-4">
                        <ul class="list-group sticky-top">
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
                        </ul>
                    </div>
                    <div class="col-12 col-xl-8">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach ($balance_dates as $balance_date)
                                <li class="nav-item">
                                    <a class="nav-link @if (($loop->first) and (!session('balance_id'))) active @elseif (session('balance_id')==$balance_date->id) active  @endif"
                                       id="tab{{$balance_date->id}}-tab"
                                       data-toggle="tab" href="#tab{{$balance_date->id}}" role="tab"
                                       aria-controls="tab{{$balance_date->id}}"
                                       aria-selected="@if ($loop->first) true @else false @endif">{{$balance_date->date_balance}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @foreach ($balance_dates as $balance_date)
                                <div
                                    class="tab-pane fade @if (($loop->first) and (!session('balance_id'))) show active @elseif (session('balance_id')==$balance_date->id) show active  @endif"
                                    id="tab{{$balance_date->id}}" role="tabpanel"
                                    aria-labelledby="tab{{$balance_date->id}}-tab">
                                    <form method="post" action="{{route('save_balance', ['id' => $balance_date->id])}}">
                                        @csrf
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                <tr>
                                                    <th colspan="3" scope="col" class="text-info">
                                                        <h3 class="">Актив на {{$balance_date->date_balance}}</h3>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <thead>
                                                <tr>
                                                    <th scope="col">Наименование показателя</th>
                                                    <th scope="col">Код</th>
                                                    <th scope="col">Сумма</th>
                                                </tr>
                                                </thead>
                                                @foreach ($balance_date->get_Corporation_Balance_Active() as $section)
                                                    @include('limit/company_balance_section')
                                                @endforeach
                                                <tfoot>
                                                <tr>
                                                    @php //isset для phpshtorm, он считает, что переменной нет.
                                                if( isset( $balance_date)) $sum_part_balance=$balance_date->get_Balance_Active_Sum();
                                                    @endphp
                                                    <th scope="col">
                                                        <strong>{{$sum_part_balance->balance_article->description}}</strong>
                                                    </th>
                                                    <th scope="col">
                                                        <strong>{{$sum_part_balance->balance_article->code}}</strong>
                                                    </th>
                                                    <th scope="col" class="text-right">
                                                        <strong
                                                            id="pa{{$balance_date->id}}rt1">{{str_replace('.00', '', number_format($sum_part_balance->value, 2, '.', ' '))}}</strong>
                                                    </th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            <table class="table table-striped table-sm">
                                                <thead class="mt-4">
                                                <tr>
                                                    <th colspan="3" scope="col" class="text-info pt-auto">
                                                        <h3 class="">Пассив на {{$balance_date->date_balance}}</h3>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <thead>
                                                <tr>
                                                    <th scope="col">Наименование показателя</th>
                                                    <th scope="col">Код</th>
                                                    <th scope="col">Сумма</th>
                                                </tr>
                                                </thead>
                                                @foreach ($balance_date->get_Corporation_Balance_Passiv() as $section)
                                                    @include('limit/company_balance_section')
                                                @endforeach
                                                <tfoot>
                                                <tr>
                                                    @php //isset для phpshtorm, он считает, что переменной нет.
                                                if( isset( $balance_date)) $sum_part_balance=$balance_date->get_Balance_Passiv_Sum();
                                                    @endphp
                                                    <th scope="col">
                                                        <strong>{{$sum_part_balance->balance_article->description}}</strong>
                                                    </th>
                                                    <th scope="col">
                                                        <strong>{{$sum_part_balance->balance_article->code}}</strong>
                                                    </th>
                                                    <th scope="col" class="text-right">
                                                        <strong
                                                            id="pa{{$balance_date->id}}rt0">{{str_replace('.00', '', number_format($sum_part_balance->value, 2, '.', ' '))}}</strong>
                                                    </th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="alert alert-success" id="pa{{$balance_date->id}}rt">Все
                                                    хорошо, пассив равен активу.
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <button id="but{{$balance_date->id}}" class="btn btn-primary w-100"
                                                        type="submit">
                                                    Сохранить
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row text-right">
                    <div class="col-12">
                        <a type="button" class="btn btn-secondary"
                           href="{{ route('company_finance_list', ['id' => $company->gsz->id]) }}">Назад</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{url('/js/limit_app.js')}}" defer></script>
@endsection
