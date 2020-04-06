@extends('layouts.app')

@section('content')
    <div class="container" id="calc_app">
        <div class="card mt-5 opacitybg">
            <form action="" id="frmPlatezhParam" method="post">
                <div class="card-header">
                    <h2 class="text-center">{{($type == 'annuit') ? 'АННУИТЕТНЫЙ ПЛАТЕЖ' : (($type == 'differ') ? 'ДИФФЕРЕНЦИРОВАННЫЙ ПЛАТЕЖ' : 'ГИБКИЙ ГРАФИК ПОГАШЕНИЯ')}}</h2>
                </div>
                <div class="card-body">
                    <input type="hidden" name="type_platezh" id="type_platezh" value="{{$type}}">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="str_beg_date" class="control-label text-left">Дата получения кредита
                                (ММ.ГГГГ) </label>
                            <input type="text" class="form-control" name="str_beg_date" value="<?=date('m.Y')?>"
                                   id="str_beg_date" maxlength="7" autofocus @input="getMonthYearfromInput"
                                   ref="MonthYearInput" required
                                   pattern="(0[1-9]|1[012])\.[0-9]{4}">
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="col_month" class="control-label">Срок кредита в месяцах </label>
                                <input type="number" class="form-control" min="1" name="col_month" id="col_month"
                                       value="1" @input="kolvoinput"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="sum_kred" class="control-label">Сумма кредита </label>
                                <input type="text" class="form-control" name="sum_kred" id="sum_kred" required
                                       pattern="^\d+(\.\d{1,2})?$">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="proc" class="control-label">Процентная ставка в год </label>
                                <input type="text" class="form-control" name="proc" id="proc" required
                                       pattern="^\d+(\.\d{1,2})?$">
                            </div>
                        </div>
                    </div>
                    @if ($type == 'flex')
                        <div class="row">
                            <div class="col-12 col-md-6" v-for="item in listDate">
                                <div class="form-group">
                                    <label for="flex_payment_schedule" class="control-label">Гашение @{{ item
                                        }} </label>
                                    <input type="text" class="form-control" name="flex_payment_schedule[]"
                                           id="flex_payment_schedule" value="0" required>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="row text-right">
                        <div class="col-12 col-md-6 offset-md-6">
                            <button type="button" class="btn btn-primary" type="submit" id="btnShowPaymentSchedule">Рассчитать график</button>
                            <button type="button" class="btn btn-light" href="{{ route('calc_list') }}">Другой тип платежа</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Контейнер для вывода графика платежей в magnific-popup -->
        <div id="text-popup" class="white-popup mfp-hide">
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/calc_app.js') }}" defer></script>
@endsection
