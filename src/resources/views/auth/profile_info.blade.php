<div class="mb-2">
    <img title="profile image" class="rounded-circle img-fluid"
         src="{{asset($user->avatar->path)}}">
    <button type="button" class="btn btn-secondary container-fluid mt-3" data-toggle="modal"
            data-target="#newAvatarModal">Сменить фото
    </button>
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
