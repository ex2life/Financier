<form class="form" action="{{route('profile_changePassword')}}" method="post"
      id="registrationForm">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="form-group">

                <label for="current_password">
                    {{ __('Current password') }}</label>
                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password"
                       id="current_password"
                       placeholder="{{ __('Password') }}"
                       value=""
                       title="введите ваш действующий пароль">
                @error('current_password')
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

                <label for="new_password">
                    {{ __('New password') }}</label>
                <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                       id="new_password"
                       placeholder="{{ __('Password') }}"
                       value=""
                       title="введите новый пароль">
                @error('new_password')
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

                <label for="new_password_confirmation">
                    {{ __('Confirm Password') }}</label>
                <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" re
                       id="new_password_confirmation"
                       placeholder="{{ __('Password') }}"
                       value=""
                       title="повторите пароль">
                @error('new_password_confirmation')
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
                        class="glyphicon glyphicon-ok-sign"></i> {{ __('Change') }}
                </button>
                <button class="btn btn-lg" type="reset"><i
                        class="glyphicon glyphicon-repeat"></i> {{ __('Reset') }}
                </button>
            </div>
        </div>
    </div>
</form>
