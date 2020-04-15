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
                                <div class="col-xl-3 col-lg-4 col-md-5 d-none d-md-block">
                                    @include('auth/profile_info')
                                </div>
                                <!--/col-3-->
                                <div class="col-xl-9 col-lg-8 col-md-7 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>{{$user->name}}</h3></div>
                                    </div>
                                    <nav class="mb-3">
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-settings-tab" data-toggle="tab"
                                               href="#nav-settings" role="tab" aria-controls="nav-settings"
                                               aria-selected="true">Settings</a>
                                            <a class="nav-item nav-link d-md-none" id="nav-info-tab" data-toggle="tab"
                                               href="#nav-info" role="tab" aria-controls="nav-info"
                                               aria-selected="true">Profile info</a>
                                            <a class="nav-item nav-link" id="nav-social-tab" data-toggle="tab"
                                               href="#nav-social" role="tab" aria-controls="nav-social"
                                               aria-selected="false">Social</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade" id="nav-info" role="tabpanel"
                                             aria-labelledby="nav-info-tab">
                                            @include('auth/profile_info')
                                        </div>
                                        <div class="tab-pane fade show active" id="nav-settings" role="tabpanel"
                                             aria-labelledby="nav-settings-tab">
                                            @include('auth/profile_setting')
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
@endsection
