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
                            <a href="{{ route('analise_company_list', ['id' => $gsz->id])}}"
                               class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{$gsz->brief_name}}</h5>
                                    <div>
                                        <small class="text-muted">Создана {{$gsz->created_at->diffForHumans()}}</small>
                                    </div>
                                </div>
                                <p class="mb-1">{{$gsz->full_name}}</p>

                                <small
                                    class="text-muted">{{count($gsz->company_work6Month()).pluralForm(count($gsz->company),' компания работает', ' компании работают', ' компаний работает')}}
                                    более 6 мес.</small>
                            </a>
                        @empty
                            У вас пока нет групп.
                        @endforelse
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row text-right">
                        <div class="col-12">
                            <a type="button" class="btn btn-secondary" href="{{ route('index') }}">Назад</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
