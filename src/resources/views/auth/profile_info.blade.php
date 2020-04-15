<div class="mb-2">
    <img title="profile image" class="rounded-circle img-fluid"
         src="{{asset($user->avatar->path)}}">
    <button type="button" class="btn btn-secondary container-fluid mt-3" data-toggle="modal"
            data-target="#myModal">Сменить фото</button>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
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
                  class="form-horizontal"  enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    {{ csrf_field() }}
                    <script>
                        $(document).ready(function() {
                            $('input[type="file"]').on("change", function() {
                                let filenames = [];
                                let files = document.getElementById("image").files;
                                if (files.length > 1) {
                                    filenames.push("Total Files (" + files.length + ")");
                                } else {
                                    for (let i in files) {
                                        if (files.hasOwnProperty(i)) {
                                            filenames.push(files[i].name);
                                        }
                                    }
                                }
                                $(this)
                                    .next(".custom-file-label")
                                    .html(filenames.join(","));
                            });
                        });
                    </script>
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

                    <small id="imagehelp" class="form-text text-muted">фото должно быть квадратное.
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
