<div id="{{$id_modal}}" class="modal @if(session($id_modal)) show @endif" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" data-show="true">
        <div class="modal-content">
            <form action="{{$action}}" method="post" id="{{$pref}}gszForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{$title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="text-popup" class="modal-body">
                    <div class="form-group row">
                        <label for="{{$pref}}brief_name"
                               class="col-md-4 col-form-label text-md-right">Краткое имя</label>
                        <div class="col-md-8">
                            <input id="{{$pref}}brief_name" type="text"
                                   class="form-control @error($pref.'brief_name') is-invalid @enderror" name="{{$pref}}brief_name"
                                   value="{{ old($pref.'brief_name') }}" required autofocus>
                            @error($pref.'brief_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="{{$pref}}full_name"
                               class="col-md-4 col-form-label text-md-right">Полное имя</label>
                        <div class="col-md-8">
                            <input id="{{$pref}}full_name" type="text"
                                   class="form-control @error($pref.'full_name') is-invalid @enderror" name="{{$pref}}full_name"
                                   value="{{ old($pref.'full_name') }}" required autofocus>
                            @error($pref.'full_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Закрыть
                    </button>
                    <button type="submit" class="btn btn-primary">{{$button}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
