@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card opacitybg">
                    <div class="card-header">{{__('Profile')}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('status_error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('status_error') }}
                            </div>
                        @endif
                        <div class="container bootstrap snippet">
                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <!--left col-->

                                    <div class="mb-2">
                                        <img title="profile image" class="rounded-circle img-fluid"
                                             src="{{asset("images/profile_images/default.png")}}">
                                    </div>
                                    <ul class="list-group">
                                        <li class="list-group-item text-muted">{{__('Profile')}}</li>
                                        <li class="list-group-item text-right "><span
                                                class="pull-left "><strong>Зарегистрирован</strong></span> {{date("d.m.Y", strtotime($user->created_at))}}
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
                                <div class="col-md-9 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>{{$user->name}}</h3></div>
                                    </div>
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
                                            <form class="form" action="{{route('profile_update')}}" method="post"
                                                  id="registrationForm">
                                                @method('PUT')
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">

                                                            <label for="nickname">
                                                                {{ __('Nickname') }}</label>
                                                            <input type="text" class="form-control" name="nickname"
                                                                   id="nickname"
                                                                   disabled placeholder="login"
                                                                   value="{{$user->nickname}}"
                                                                   title="введите ваш логин">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="name">
                                                                {{ __('Full name') }}</label>
                                                            @if(!empty(old('name')))
                                                                <input type="text"
                                                                       class="form-control @error('name') is-invalid @enderror"
                                                                       name="name"
                                                                       id="name" placeholder="{{ __('Full name') }}"
                                                                       value="{{old('name')}}"
                                                                       title="Введите ваше ФИО">
                                                            @else
                                                                <input type="text"
                                                                       class="form-control @error('name') is-invalid @enderror"
                                                                       name="name"
                                                                       id="name" placeholder="{{ __('Full name') }}"
                                                                       value="{{$user->name}}"
                                                                       title="Введите ваше ФИО">
                                                            @endif

                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="email">
                                                                {{ __('Email') }}</label>
                                                            <input type="email"
                                                                   class="form-control @error('email') is-invalid @enderror"
                                                                   name="email" id="email"
                                                                   placeholder="you@email.com"
                                                                   title="Введите ваш e-mail" value="{{$user->email}}">

                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <br>
                                                            <button class="btn btn-lg btn-success" type="submit"><i
                                                                    class="glyphicon glyphicon-ok-sign"></i> {{ __('Save') }}
                                                            </button>
                                                            <button class="btn btn-lg" type="reset"><i
                                                                    class="glyphicon glyphicon-repeat"></i> {{ __('Reset') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="nav-social" role="tabpanel"
                                             aria-labelledby="nav-social-tab">
                                            <div class="col-12">
                                                <div class="mb-2">
                                                    <a href="{{ route((is_null($socialIdent->vkontakte)) ? 'auth_social' : 'auth_social_del', ['provider' => 'vkontakte']) }}">
                                                        <button type="button" class="social-button vk-button">
                                                            <span class="social-button__icon vk-icon">
                                                                <object
                                                                    type="image/svg+xml"
                                                                    data="{{asset("images/social/VKLogo.svg")}}">
                                                                </object>
                                                            </span>
                                                            <span
                                                                class="social-button__text vk-text">{{ (is_null($socialIdent->vkontakte)) ? __('Add sign in with') : __('Delete sign in with') }} VK</span>
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="mb-2">
                                                    <a href="{{route((is_null($socialIdent->google)) ? 'auth_social' : 'auth_social_del', ['provider' => 'google']) }}">
                                                        <button type="button" class="social-button google-button">
                                            <span class="social-button__icon google-icon">
                                                <object
                                                    type="image/svg+xml"
                                                    data="{{asset("images/social/GoogleLogo.svg")}}">
                                                </object>
                                            </span>
                                                            <span class="social-button__text google-text">{{(is_null($socialIdent->google)) ? __('Add sign in with') : __('Delete sign in with') }} Google</span>
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="mb-2">
                                                    <a href="{{route((is_null($socialIdent->twitter)) ? 'auth_social' : 'auth_social_del', ['provider' => 'twitter']) }}">
                                                        <button type="button" class="social-button twitter-button">
                                            <span class="social-button__icon twitter-icon">
                                                <object
                                                    type="image/svg+xml"
                                                    data="{{asset("images/social/TwitterLogo.svg")}}">
                                                </object>
                                            </span>
                                                            <span
                                                                class="social-button__text twitter-text">{{(is_null($socialIdent->twitter)) ? __('Add sign in with') : __('Delete sign in with') }} Twitter</span>
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="form-group">
                                                    <a href="{{route((is_null($socialIdent->facebook)) ? 'auth_social' : 'auth_social_del', ['provider' => 'facebook']) }}">
                                                        <button type="button" class="social-button facebook-button">
                                            <span class="social-button__icon facebook-icon">
                                                <img src="{{asset("images/social/FacebookLogo.png")}}" alt=""
                                                     height="100%" width="100%">
                                            </span>
                                                            <span
                                                                class="social-button__text facebook-text">{{(is_null($socialIdent->facebook)) ? __('Add sign in with') : __('Delete sign in with') }} Facebook</span>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
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
