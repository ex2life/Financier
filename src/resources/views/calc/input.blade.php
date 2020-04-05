@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-5 opacitybg">
            <div class="card-header">
                <h2 class="text-center">{{($type == 'annuit') ? 'АННУИТЕТНЫЙ ПЛАТЕЖ' : (($type == 'differ') ? 'ДИФФЕРЕНЦИРОВАННЫЙ ПЛАТЕЖ' : 'ГИБКИЙ ГРАФИК ПОГАШЕНИЯ')}}</h2>
            </div>
            <div class="card-body">
                <form action="" id="frmPlatezhParam" method="post">
                    <input type="hidden" name="type_platezh" id="type_platezh" value="{{$type}}">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="str_beg_date" class="control-label text-left">Дата получения кредита
                                (ММ.ГГГГ) </label>
                            <input type="text" class="form-control" name="str_beg_date" value="<?=date('m.Y')?>"
                                   id="str_beg_date" maxlength="7" autofocus required
                                   pattern="(0[1-9]|1[012])\.[0-9]{4}">
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="col_month" class="control-label">Срок кредита в месяцах </label>
                                <input type="number" class="form-control" min="1" name="col_month" id="col_month"
                                       value="1"
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
                </form>
            </div>
        </div>


        <div class="jumbotron opacitybg">
            <form method="post" id="frmPlatezhParam" action="out_platezh_schedule.php">
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                        if ($type == 'flex') {
                            echo '<div class="input_payment_schedule" id="input_payment_schedule">';
                            echo '<div></div>';
                            echo '</div>';
                            echo '<p></p>';
                        }
                        ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <input class="col-xs-6 btn btn-primary" type="submit" id="btnShowPaymentSchedule"
                               value="Рассчитать график">
                        <a class="btn btn-warning col-xs-6" href="./calc.html">Другой тип платежа</a>
                    </div>
                </div>    <!-- Конец row -->
            </form>
        </div> <!-- Конец jumbotron -->

        <!-- Контейнер для вывода графика платежей в magnific-popup -->
        <div id="text-popup" class="white-popup mfp-hide">
        </div>
    </div>
@endsection
