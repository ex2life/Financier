@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card opacitybg">
                    <div class="card-header d-flex w-100 justify-content-between">
                        <div class="my-auto"><h5>{{__('Profile')}}</h5></div>
                        <a href="{{route('index')}}" class="btn btn-outline-secondary">Домой <i class="fa fa-home"></i></a>
                    </div>

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
                        <div class="">
                            <div class="row">
                                <div class="col-xl-3 col-lg-4 col-md-5 d-none d-md-block">
                                    @include('auth/profile_info')
                                </div>
                                <!--/col-3-->
                                <div class="col-xl-9 col-lg-8 col-md-7 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>{{$user->name}}</h3></div>
                                    </div>
                                    <nav class="mb-3 ">
                                        <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <li class="nav-item dropdown d-md-none">
                                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                                   role="button" aria-haspopup="true"
                                                   aria-expanded="false">{{__('Profile')}}</a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#nav-settings"
                                                       data-toggle="tab">{{__('Setting')}}</a>
                                                    <a class="dropdown-item" href="#nav-password"
                                                       data-toggle="tab">{{__('Update password')}}</a>
                                                    <a class="dropdown-item" href="#nav-social"
                                                       data-toggle="tab">{{__('Social networks')}}</a>
                                                </div>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link d-none d-md-block {{empty(session('topass')) ? 'active':''}}"
                                                   id="nav-settings-tab" data-toggle="tab"
                                                   href="#nav-settings" role="tab" aria-controls="nav-settings"
                                                   aria-selected="true">{{__('Setting')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link d-md-none" id="nav-info-tab" data-toggle="tab"
                                                   href="#nav-info" role="tab" aria-controls="nav-info"
                                                   aria-selected="true">{{__('Info')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link d-none d-md-block {{!empty(session('topass')) ? 'active':''}}"
                                                   id="nav-password-tab" data-toggle="tab"
                                                   href="#nav-password" role="tab" aria-controls="nav-password"
                                                   aria-selected="false">{{__('Change password')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link d-none d-md-block" id="nav-social-tab"
                                                   data-toggle="tab"
                                                   href="#nav-social" role="tab" aria-controls="nav-social"
                                                   aria-selected="false">{{__('Social networks')}}</a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade d-md-none" id="nav-info" role="tabpanel"
                                             aria-labelledby="nav-info-tab">
                                            @include('auth/profile_info')
                                        </div>
                                        <div class="tab-pane fade show {{empty(session('topass')) ? 'active':''}}"
                                             id="nav-settings" role="tabpanel"
                                             aria-labelledby="nav-settings-tab">
                                            @include('auth/profile_setting')
                                        </div>
                                        <div class="tab-pane fade show {{!empty(session('topass')) ? 'active':''}}"
                                             id="nav-password" role="tabpanel"
                                             aria-labelledby="nav-password-tab">
                                            @include('auth/profile_password')
                                        </div>
                                        <div class="tab-pane fade" id="nav-social" role="tabpanel"
                                             aria-labelledby="nav-social-tab">
                                            @include('auth/profile_social')
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
    <div id="newAvatarModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Изменение фото</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('profile_uploadAvatar')}}" method="POST"
                      class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div id="text-popup" class="modal-body">

                        {{ csrf_field() }}

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Фото</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" required class="custom-file-input" id="image" name="image"
                                       aria-describedby="image">
                                <label class="custom-file-label" for="image">Выберите файл</label>
                            </div>
                        </div>

                        <script>
                            document.querySelector('.custom-file-input').addEventListener('change',function(e){
                                var fileName = document.getElementById("image").files[0].name;
                                var nextSibling = e.target.nextElementSibling;
                                nextSibling.innerText = fileName;
                            })
                        </script>

                        <small id="imagehelp" class="form-text text-muted">фото должно быть квадратное
                        </small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Закрыть
                        </button>
                        <button type="submit" class="btn btn-primary">Загрузить фото
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
