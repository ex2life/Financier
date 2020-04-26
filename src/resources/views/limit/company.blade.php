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
                <div class="card-body">

                        <div class="row @if (count($companies)>1)row-cols-1 row-cols-md-2 @endif">
                            @forelse ($companies as $num=>$company)
                                <div class="col d-flex align-items-stretch @if ($num>1) mt-3 @endif">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h4 class="mb-1">{{$company->name}}</h4>
                                                <div>
                                                    <small
                                                        class="text-muted">Создана {{$company->created_at->diffForHumans()}}</small>&ensp;
                                                    <a data-toggle="modal"
                                                       data-company_action="{{ route('company_edit', ['id' => $company->id]) }}"
                                                       data-company_name="{{ $company->name }}"
                                                       data-company_inn="{{ $company->inn }}"
                                                       data-company_opf="{{ $company->opf->id }}"
                                                       data-company_sno="{{ $company->sno->id }}"
                                                       data-company_date_registr="{{ $company->date_registr }}"
                                                       data-company_date_begin_work="{{ $company->date_begin_work }}"
                                                       title="Изменить" data-target="#editCompany"><i
                                                            class="fa fa-pencil fa-fw"></i></a>
                                                    </a>
                                                    <a data-toggle="modal"
                                                       data-company_del_link="{{ route('company_delete', ['id' => $company->id]) }}"
                                                       data-company_edit="False"
                                                       title="Удалить" data-target="#confirmDeleteCompany"><i
                                                            class="fa fa-trash fa-fw"></i></a>
                                                    </a>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#newCompany">
                                Создать компанию
                            </button>
                            <a type="button" class="btn btn-secondary" href="{{ route('gsz_list') }}">Назад</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{url('/js/limit_app.js')}}" defer></script>
    @include('limit.bodymodal_Company',
        ['id_modal' =>  'newCompany',
        'action'    =>  route('company_add', ['id' => $gsz->id]),
        'title'     =>  'Создание компании',
        'button'    =>  'Создать компанию',
        'pref'      =>  ''])
    @include('limit.bodymodal_Company',
        ['id_modal' =>  'editCompany',
        'action'    =>  route('company_edit', ['id' => session('company_id') ? session('company_id'):'0']),
        'title'     =>  'Изменение компании',
        'button'    =>  'Изменить компанию',
        'pref'      =>  'edit_'])
    <div id="confirmDeleteCompany" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
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
                    Удаление необратимо.
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
