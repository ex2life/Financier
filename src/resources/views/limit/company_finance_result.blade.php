@extends('layouts.app')
@section('content')
    <div class="container " id="limit_app">
        <div class="card mt-md-5 opacitybg">
            <div class="card-header">
                <h2 class="text-center">Финансовые результаты организации {{$company->name}}</h2>
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
                                    <form method="post"
                                          action="{{route('save_finance_result', ['id' => $balance_date->id])}}">
                                        @csrf
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                <tr>
                                                    <th colspan="3" scope="col" class="text-info">
                                                        <h3 class="">Финансовые результаты
                                                            на {{$balance_date->date_balance}}</h3>
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
                                                @foreach ($balance_date->finance_report_results as $string)
                                                    <tr>
                                                        <td class="">{{$string->finance_report_article->description}}</td>
                                                        <td class="">{{$string->finance_report_article->code}}</td>
                                                        <td class="text-right"
                                                            style="min-width: 100px; max-width: 125px;">
                                                            <input type="text"
                                                                   onblur="this.value = this.value.replace(',','.').replace(/[^\d.-]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ' ')"
                                                                   onfocus="this.value = this.value.replace(/\s/g, '')"
                                                                   class="text-right without-arrow"
                                                                   name="{{$string->finance_report_article->code}}"
                                                                   style="width: 100%;" value="{{str_replace('.00', '', number_format($string->value, 2, '.', ' '))}}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
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
@endsection
