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
                    <h2 class="text-center">Группы связанных заемщиков</h2>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @forelse ($gszs as $num=>$gsz)
                            <a href="{{ route('company_list', ['id' => $gsz->id]) }}"
                               class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{$gsz->brief_name}}</h5>
                                    <small class="text-muted">Создана {{$gsz->created_at->diffForHumans()}}</small>
                                </div>
                                <p class="mb-1">{{$gsz->full_name}}</p>
                                <small
                                    class="text-muted">{{count($gsz->company).pluralForm(count($gsz->company),' компания', ' компании', ' компаний')}}</small>
                            </a>
                        @empty
                            У вас пока нет групп.
                        @endforelse
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row text-right">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#addGSZ">
                                Создать группу
                            </button>
                            <a type="button" class="btn btn-secondary" href="{{ route('limit_list') }}">Назад</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/limit_app.js') }}" defer></script>
    <div id="addGSZ" class="modal @if(session('modal')) show @endif" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" data-show="true">
            <div class="modal-content">
                <form action="{{route('gsz_add')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Создание группы</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="text-popup" class="modal-body">
                        <div class="form-group row">
                            <label for="brief_name"
                                   class="col-md-4 col-form-label text-md-right">Краткое имя</label>
                            <div class="col-md-8">
                                <input id="brief_name" type="text"
                                       class="form-control @error('brief_name') is-invalid @enderror" name="brief_name"
                                       value="{{ old('brief_name') }}" required autofocus>
                                @error('brief_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="full_name"
                                   class="col-md-4 col-form-label text-md-right">Полное имя</label>
                            <div class="col-md-8">
                                <input id="full_name" type="text"
                                       class="form-control @error('full_name') is-invalid @enderror" name="full_name"
                                       value="{{ old('full_name') }}" required autofocus>
                                @error('full_name')
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
                        <button type="submit" class="btn btn-primary">Создать группу
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
