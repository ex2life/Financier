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
                <label for="image">
                    {{ __('New Avatar') }}</label>
                <input type="file"
                       class="form-control @error('email') is-invalid @enderror"
                       name="image" id="image"
                       title="Выберете фото, если его нужно обновить">

                @error('image')
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
