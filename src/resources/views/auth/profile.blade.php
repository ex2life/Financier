@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{__('Profile')}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container bootstrap snippet">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>{{$user->name}}</h3></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <!--left col-->

                                    <div class="mb-2">
                                        <img title="profile image" class="rounded-circle img-fluid"
                                             src="{{asset("images/profile_images/default.png")}}">
                                    </div>
                                    <ul class="list-group">
                                        <li class="list-group-item text-muted">{{__('Profile')}}</li>
                                        <li class="list-group-item text-right"><span
                                                class="pull-left"><strong>Зарегистрирован</strong></span> {{date("d.m.Y", strtotime($user->created_at))}}
                                        </li>
                                        <li class="list-group-item text-right"><span
                                                class="pull-left"><strong>Компаний</strong></span> 0
                                        </li>
                                        <li class="list-group-item text-right"><span
                                                class="pull-left"><strong>ГСЗ</strong></span> 0
                                        </li>
                                    </ul>
                                </div>
                                <!--/col-3-->
                                <div class="col-sm-9">
                                    <nav class="mb-3">
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-settings-tab" data-toggle="tab"
                                               href="#nav-settings" role="tab" aria-controls="nav-settings"
                                               aria-selected="true">Settings</a>
                                            <a class="nav-item nav-link" id="nav-social-tab" data-toggle="tab"
                                               href="#nav-social" role="tab" aria-controls="nav-social"
                                               aria-selected="false">Social</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-settings" role="tabpanel"
                                             aria-labelledby="nav-settings-tab">
                                            <form class="form" action="##" method="post" id="registrationForm">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="name">
                                                                {{ __('Name') }}</label>
                                                            <input type="text" class="form-control" name="last_name"
                                                                   id="name" placeholder="{{ __('Name') }}" value="{{$user->name}}"
                                                                   title="Введите ваше ФИО">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="email">
                                                                {{ __('Email') }}</label>
                                                            <input type="email" class="form-control" name="email" id="email"
                                                                   placeholder="you@email.com" title="Введите ваш e-mail" value="{{$user->email}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">

                                                            <label for="nickname">
                                                                {{ __('Nickname') }}</label>
                                                            <input type="text" class="form-control" name="nickname" id="nickname"
                                                                   placeholder="login" value="{{$user->nickname}}"
                                                                   title="введите ваш логин">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-xs-12">
                                                        <br>
                                                        <button class="btn btn-lg btn-success" type="submit"><i
                                                                class="glyphicon glyphicon-ok-sign"></i> {{ __('Save') }}
                                                        </button>
                                                        <button class="btn btn-lg" type="reset"><i
                                                                class="glyphicon glyphicon-repeat"></i> {{ __('Reset') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="nav-social" role="tabpanel"
                                             aria-labelledby="nav-social-tab">
                                            СоцСети
                                        </div>
                                    </div>


                                </div>
                                <!--/tab-content-->

                            </div>
                            <!--/col-9-->
                        </div>
                        <!--/row-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
