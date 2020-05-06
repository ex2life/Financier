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
                    <h2 class="text-center">Финансовые данные групп связанных заемщиков</h2>
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
                                <a href="{{ route('company_finance_list', ['id' => $gsz->id]) }}"
                                   class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$gsz->brief_name}}</h5>
                                        <div>
                                            <small
                                                class="text-muted">Создана {{$gsz->created_at->diffForHumans()}}</small>
                                        </div>
                                    </div>
                                    <p class="mb-1">{{$gsz->full_name}}</p>
                                    <p class="mb-1"><strong>Начало деятельности: </strong>{{$gsz->date_begin_work()}}</p>
                                    <div class="d-flex">
                                        <div class="row ml-0 mb-1">
                                            <div class=""><strong>Дата расчета: </strong>{{$gsz->date_calc_limit->date}}</div>
                                            <div>
                                                <object data="" type="">
                                                    <a data-toggle="modal"
                                                       data-gsz_date_action="{{ route('gsz_date_edit', ['id' => $gsz->id]) }}"
                                                       data-gsz_brief_name="{{ $gsz->brief_name }}"
                                                       data-gsz_date="{{ $gsz->date_calc_limit->date }}"
                                                       title="Изменить" data-target="#editDate"><i
                                                            class="fa fa-pencil fa-fw"></i>
                                                    </a>
                                                </object>
                                            </div>
                                        </div>
                                    </div>
                                    <small
                                        class="text-muted">{{count($gsz->company_work6Month()).pluralForm(count($gsz->company),' компания работает', ' компании работают', ' компаний работает')}}
                                        более 6 мес.</small>
                                </a>
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
    <!-- Scripts -->
    <script src="{{ asset('js/limit_app.js') }}" defer></script>
    <div id="editDate" class="modal @if(session('modal')) show @endif" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" data-show="true">
            <div class="modal-content">
                <form method="post" id="editDateForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="text-popup" class="modal-body">
                        <div class="form-group row">
                            <label for="date_calc_limit"
                                   class="col-md-4 col-form-label text-md-right">Дата расчета</label>
                            <div class="col-md-8">
                                <input id="date_calc_limit" type="date"
                                       class="form-control @error('date_calc_limit') is-invalid @enderror"
                                       name="date_calc_limit"
                                       value="{{ old('date_calc_limit') }}" required autofocus>
                                @error('date_calc_limit')
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
                        <button type="submit" class="btn btn-primary">Изменить дату
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
