<div id="{{$id_modal}}" class="modal @if(session($id_modal)) show @endif" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document" data-show="true">
        <div class="modal-content">
            <form action="{{$action}}" method="post"
                  id="{{$pref}}companyForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{$title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="text-popup" class="modal-body">
                    <div class="form-group row">
                        <label for="{{$pref}}name_company"
                               class="col-md-4 col-form-label text-md-right">Название компании</label>
                        <div class="col-md-8">
                            <input id="{{$pref}}name_company" type="text"
                                   class="form-control @error($pref.'name_company') is-invalid @enderror"
                                   name="{{$pref}}name_company"
                                   value="{{ old($pref.'name_company') }}" required autofocus>
                            @error($pref.'name_company')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="{{$pref}}inn"
                               class="col-md-4 col-form-label text-md-right">Инн</label>
                        <div class="col-md-8">
                            <input id="{{$pref}}inn" type="number"
                                   class="form-control @error($pref.'inn') is-invalid @enderror" name="{{$pref}}inn"
                                   value="{{ old($pref.'inn') }}" required>
                            @error($pref.'inn')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="{{$pref}}opf"
                               class="col-md-4 col-form-label text-md-right">Организационно-правовая форма</label>
                        <div class="col-md-8">
                            <select id="{{$pref}}opf" class="form-control @error($pref.'opf') is-invalid @enderror"
                                    name="{{$pref}}opf"
                                    required>
                                @foreach (App\Opf::all() as $opf)
                                    <option value="{{$opf->id}}"
                                            title="{{$opf->full_name}}" {{old($pref.'opf') == $opf->id ? "selected":""}}>
                                        {{$opf->brief_name}}
                                    </option>
                                @endforeach
                            </select>
                            @error($pref.'opf')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="{{$pref}}sno"
                               class="col-md-4 col-form-label text-md-right">Система налогооблажения</label>
                        <div class="col-md-8">
                            <select id="{{$pref}}sno" class="form-control @error($pref.'sno') is-invalid @enderror"
                                    name="{{$pref}}sno"
                                    required>
                                @foreach (App\Sno::all() as $sno)
                                    <option value="{{$sno->id}}"
                                            title="{{$sno->full_name}}" {{old($pref.'sno') == $sno->id ? "selected":""}}>
                                        {{$sno->brief_name}}
                                    </option>
                                @endforeach
                            </select>
                            @error($pref.'sno')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="{{$pref}}date_registr"
                               class="col-md-4 col-form-label text-md-right">Дата регистрации</label>
                        <div class="col-md-8">
                            <input id="{{$pref}}date_registr" type="date"
                                   class="form-control @error($pref.'date_registr') is-invalid @enderror"
                                   name="{{$pref}}date_registr"
                                   value="{{ old($pref.'date_registr') }}" required>
                            @error($pref.'date_registr')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="{{$pref}}date_begin_work"
                               class="col-md-4 col-form-label text-md-right">Дата начала деятельности</label>
                        <div class="col-md-8">
                            <input id="{{$pref}}date_begin_work" type="date"
                                   class="form-control @error($pref.'date_begin_work') is-invalid @enderror"
                                   name="{{$pref}}date_begin_work"
                                   value="{{ old($pref.'date_begin_work') }}" required>
                            @error($pref.'date_begin_work')
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
