<div id="editCompany" class="modal @if(session('modalEdit')) show @endif" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document" data-show="true">
        <div class="modal-content">
            <form action="{{ route('company_add', ['id' => $gsz->id]) }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Изменение компании</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="text-popup" class="modal-body">
                    <div class="form-group row">
                        <label for="name_company"
                               class="col-md-4 col-form-label text-md-right">Название компании</label>
                        <div class="col-md-8">
                            <input id="name_company" type="text"
                                   class="form-control @error('name_company') is-invalid @enderror"
                                   name="name_company"
                                   value="{{ old('name_company') }}" required autofocus>
                            @error('name_company')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inn"
                               class="col-md-4 col-form-label text-md-right">Инн</label>
                        <div class="col-md-8">
                            <input id="inn" type="number"
                                   class="form-control @error('inn') is-invalid @enderror" name="inn"
                                   value="{{ old('inn') }}" required>
                            @error('inn')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="opf"
                               class="col-md-4 col-form-label text-md-right">Организационно-правовая форма</label>
                        <div class="col-md-8">
                            <select id="opf" class="form-control @error('opf') is-invalid @enderror" name="opf"
                                    required>
                                @foreach (App\Opf::all() as $opf)
                                    <option value="{{$opf->id}}"
                                            title="{{$opf->full_name}}" {{old("opf") == $opf->id ? "selected":""}}>
                                        {{$opf->brief_name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('opf')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sno"
                               class="col-md-4 col-form-label text-md-right">Система налогооблажения</label>
                        <div class="col-md-8">
                            <select id="sno" class="form-control @error('sno') is-invalid @enderror" name="sno"
                                    required>
                                @foreach (App\Sno::all() as $sno)
                                    <option value="{{$opf->id}}"
                                            title="{{$sno->full_name}}" {{old("sno") == $sno->id ? "selected":""}}>
                                        {{$sno->brief_name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('sno')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date_registr"
                               class="col-md-4 col-form-label text-md-right">Дата регистрации</label>
                        <div class="col-md-8">
                            <input id="date_registr" type="date"
                                   class="form-control @error('date_registr') is-invalid @enderror"
                                   name="date_registr"
                                   value="{{ old('date_registr') }}" required>
                            @error('date_registr')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date_begin_work"
                               class="col-md-4 col-form-label text-md-right">Дата начала деятельности</label>
                        <div class="col-md-8">
                            <input id="date_begin_work" type="date"
                                   class="form-control @error('date_begin_work') is-invalid @enderror"
                                   name="date_begin_work"
                                   value="{{ old('date_begin_work') }}" required>
                            @error('date_begin_work')
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
                    <button type="submit" class="btn btn-primary">Изменить компанию
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

