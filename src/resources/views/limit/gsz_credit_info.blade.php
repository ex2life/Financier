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
                    <h2 class="text-center">Данные по кредиту групп связанных заемщиков</h2>
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
                            @if (count($gsz->company)>0)
                                <div class="list-group-item flex-column align-items-start">
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
                                            <div class="btn btn-outline-primary pull-right align-bottom"
                                                 data-toggle="modal"
                                                 data-credit_info_action="{{ route('credit_info_edit', ['id' => $gsz->id]) }}"
                                                 data-gsz_name="{{ $gsz->brief_name }}"
                                                 data-credit_info_month="{{ $gsz->credit_info->month }}"
                                                 data-credit_info_sum="{{ $gsz->credit_info->sum }}"
                                                 data-credit_info_stavka="{{ $gsz->credit_info->stavka }}"
                                                 title="Изменить" data-target="#editCreditInfo">

                                                @if ($gsz->credit_info->month>0)
                                                    Изменить данные о кредите
                                                @else
                                                    Заполнить данные о кредите
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <small
                                        class="text-muted">{{count($gsz->company_work6Month()).pluralForm(count($gsz->company),' компания работает', ' компании работают', ' компаний работает')}}
                                        более 6 мес.</small></div>
                            @endif
                        @empty
                            У вас пока нет групп.
                        @endforelse
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row text-right">
                        <div class="col-12">
                            <a type="button" class="btn btn-secondary" href="{{ route('limit_list') }}">Назад</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/limit_app.js') }}" defer></script>
    <!-- Scripts -->
    <div id="editCreditInfo" class="modal @if(session('modal')) show @endif" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" data-show="true">
            <div class="modal-content">
                <form method="post" id="editCreditInfo"
                      action="{{route('credit_info_edit', ['id' => session('gsz_id') ? session('gsz_id'):'0'])}}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="modal-title">{{session('gsz_id') ? 'Данные кредита для '.App\Gsz::firstwhere('id',session('gsz_id'))->brief_name:''}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="text-popup" class="modal-body">
                        <div class="form-group row">
                            <label for="month"
                                   class="col-md-4 col-form-label text-md-right">Срок кредита</label>
                            <div class="col-md-8">
                                <input id="month" type="number" min="1"
                                       class="form-control @error('month') is-invalid @enderror"
                                       name="month"
                                       value="{{ old('month') }}" required autofocus>
                                @error('month')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sum"
                                   class="col-md-4 col-form-label text-md-right">Сумма кредита</label>
                            <div class="col-md-8">
                                <input id="sum" type="number"
                                       class="form-control @error('sum') is-invalid @enderror"
                                       name="sum"
                                       value="{{ old('sum') }}" required autofocus>
                                @error('sum')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stavka"
                                   class="col-md-4 col-form-label text-md-right">Ставка кредита</label>
                            <div class="col-md-8">
                                <input id="stavka" type="number"
                                       class="form-control @error('stavka') is-invalid @enderror"
                                       name="stavka"
                                       value="{{ old('stavka') }}" required autofocus>
                                @error('stavka')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Закрыть
                        </button>
                        <button type="submit" class="btn btn-primary">Изменить данные
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
