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
                            <a href="{{ route('company_list', ['id' => $gsz->id]) }}"
                               class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{$gsz->brief_name}}</h5>
                                    <div>
                                        <small class="text-muted">Создана {{$gsz->created_at->diffForHumans()}}</small>
                                        <object data="" type="">
                                            <a data-toggle="modal"
                                               data-gsz_action="{{ route('gsz_edit', ['id' => $gsz->id]) }}"
                                               data-gsz_brief_name="{{ $gsz->brief_name }}"
                                               data-gsz_full_name="{{ $gsz->full_name }}"
                                               title="Изменить" data-target="#editGsz"><i
                                                    class="fa fa-pencil fa-fw"></i>
                                            </a>
                                        </object>
                                        <object data="" type="">
                                            <a data-toggle="modal"
                                               data-gsz_del_link="{{ route('gsz_delete', ['id' => $gsz->id]) }}"
                                               title="Удалить" data-target="#confirmDeleteGsz"><i
                                                    class="fa fa-trash fa-fw"></i>
                                            </a>
                                        </object>
                                    </div>
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
                                    data-target="#newGsz">
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
    @include('limit.modal_Gsz',
        ['id_modal' =>  'newGsz',
        'action'    =>  route('gsz_add'),
        'title'     =>  'Создание группы',
        'button'    =>  'Создать группу',
        'pref'      =>  ''])
    @include('limit.modal_Gsz',
        ['id_modal' =>  'editGsz',
        'action'    =>  route('gsz_edit', ['id' => session('gsz_id') ? session('gsz_id'):'0']),
        'title'     =>  'Изменение группы',
        'button'    =>  'Изменить группу',
        'pref'      =>  'edit_'])
    <div id="confirmDeleteGsz" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <!-- header modal -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <!-- body modal -->
                <div class="modal-body text-center">
                    Все входящие компании будет также удалены. Удаление необратимо.
                    <hr>
                    <form id="delForm" method="post">
                        {{method_field('DELETE')}} {{csrf_field()}}
                        <button type="submit" value="delete" class="btn btn-danger">Удалить</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
