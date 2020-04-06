<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class CalcController extends Controller
{
    public function calc_list()
    {
        return view('calc.list');
    }

    public function calc_input($type)
    {
        return view('calc.input', ['type' => $type]);
    }

    public function calc_to_html()
    {
        $type_platezh = $_POST['type_platezh'];
        $str_beg_date = "01." . $_POST['str_beg_date'];
        $sum_kred = $_POST['sum_kred'];
        $col_month = $_POST['col_month'];
        $proc = $_POST['proc'];

        $arr_payments = array_fill(0, $col_month, 0);
        $n = 0;
        if ($type_platezh == 'flex') {
            foreach ($_POST['flex_payment_schedule'] as $flex_payment) {
                $arr_payments[$n] = round((float)$flex_payment, 2);
                $n++;
            }
        }

        // Формируем массив с данными о платежах в каждом месяце
        $arr_all_platezh = $this->Payment_Schedule($type_platezh, $str_beg_date, $sum_kred, $col_month, $proc, $arr_payments);

        if (isset($_POST['pdf'])) {
            //Была нажата кнопка "Вывести в pdf" (name="pdf")
            //Формируем pdf-файл с расчетом платежа и открываем его в новой вкладке
            $this->PDF($str_beg_date, $sum_kred, $col_month, $proc, $arr_all_platezh);
        } else {
            // Формируем html-код для табличной части расчета платежей для всплывающего окна
            $platezhi_in_html = $this->Platezh_to_html($str_beg_date, $sum_kred, $col_month, $proc, $arr_all_platezh);

            // Выводим html-код, который вернется через Ajax и будет послан во всплывающее окно (в том числе кнопки для Pdf и xls).
            echo $platezhi_in_html;
        }
    }





    /*
Функции для вывода рассчитанного графика платежей в разные форматы:
   Platezh_to_html - возвращает html-код для отображения во всплывающем окне
   PDF             - формирует файл Grafik.pdf
   XLS             - формирует файл Grafik.xls
*/


//---------------------------------------------------------------------
// Формирование html-кода для графика платежей
//---------------------------------------------------------------------
    public function Platezh_to_html($str_beg_date, $sum_kred, $col_month, $proc, $arr_all_platezh)
    {
        $type_platezh = $arr_all_platezh[0]['type_platezh'];

        $str_out = "<p>Вид платежа: ";
        if ($type_platezh == 'annuit')
            $str_out .= "<strong>Аннуитетный платеж</strong></p>";
        elseif ($type_platezh == 'differ')
            $str_out .= "<strong>Дифференцированный платеж</strong></p>";
        elseif ($type_platezh == 'flex')
            $str_out .= "<strong>Гибкий платеж</strong></p>";
        $str_sum_kred = number_format($sum_kred, 2, '.', ' ');
        $str_proc = number_format($proc, 2, '.', ' ');
        $str_out .= "<p>Сумма кредита: <strong>$str_sum_kred</strong> руб.<br>";
        $str_out .= "Процентная ставка: <strong>$str_proc</strong> %<br>";
        $str_out .= "Срок кредита (мес): <strong>$col_month</strong> </p>";

        $str_out .= "<table class=\"platezh_table\">\n";
        $str_out .= "<tr class=\"platezh_table_header\"><th>N</th><th>Дата</th><th>Сумма платежа</th><th>Погашение основного долга</th><th>Погашение процентов</th><th>Остаток основного долга</th></tr>";

        $total_platezh = $total_platezh_main_dolg = $total_platezh_proc = 0;

        foreach ($arr_all_platezh as $arr_platezh) {
            $str_platezh = number_format($arr_platezh['platezh'], 2, '.', ' ');
            $str_platezh_main_dolg = number_format($arr_platezh['platezh_main_dolg'], 2, '.', ' ');
            $str_platezh_proc = number_format($arr_platezh['platezh_proc'], 2, '.', ' ');
            $str_ostatok = number_format($arr_platezh['ostatok'], 2, '.', ' ');
            $str_out .= "<tr><td>" . $arr_platezh['nomer'] . "</td><td>" . $arr_platezh['date'] . "</td><td>" . $str_platezh . "</td>";
            $str_out .= "<td>" . $str_platezh_main_dolg . "</td><td>" . $str_platezh_proc . "</td><td>" . $str_ostatok . "</td></tr>";
            $total_platezh += $arr_platezh['platezh'];
            $total_platezh_main_dolg += $arr_platezh['platezh_main_dolg'];
            $total_platezh_proc += $arr_platezh['platezh_proc'];
        }
        $str_total_platezh = number_format($total_platezh, 2, '.', ' ');
        $str_total_platezh_main_dolg = number_format($total_platezh_main_dolg, 2, '.', ' ');
        $str_total_platezh_proc = number_format($total_platezh_proc, 2, '.', ' ');
        $str_out .= "<tr class=\"platezh_table_footer\"><td></td><td>Итого</td><td>$str_total_platezh</td><td>$str_total_platezh_main_dolg</td>";
        $str_out .= "<td>$str_total_platezh_proc</td><td></td></tr>";
        $str_out .= "</table>\n";


        // Форма для печати в pdf и сохранения в Excel
        $str_out .= "<form  target='_blank' method='post' action='/calc/calc_graf'>";
        $str_out .= "<input type=\"hidden\" name=\"_token\" value=\"".csrf_token()."\">";
        $str_out .= "<input type='hidden' name='type_platezh' value=$type_platezh>";
        $str_out .= "<input type='hidden' name='sum_kred' value=$sum_kred>";
        $str_out .= "<input type='hidden' name='str_beg_date' value=$str_beg_date>";
        $str_out .= "<input type='hidden' name='col_month' value=$col_month>";
        $str_out .= "<input type='hidden' name='proc' value=$proc>";

        if ($type_platezh == 'flex') {
            foreach ($_POST['flex_payment_schedule'] as $flex_payment) {
                $str_out .= "<input type='hidden' name='flex_payment_schedule[]' value=$flex_payment>";
            }
        }
        $str_out .= '<input class="btn btn-link" type="submit" id="btnOutToPDF" name="pdf" value="Вывести в pdf">';
        $str_out .= '<input class="btn btn-link" type="submit" id="btnSaveToXLS" name="xls" value="Сохранить в xls">';
        $str_out .= '</form>';

        return $str_out;
    }


    //функции для расчета графика платежей по разным схемам


    //---------------------------------------------------------------------
    // Добавление одного или нескольких календарных месяцев к TIMESTAMP
    //---------------------------------------------------------------------
    function Add_month($time, $num = 1)
    {
        $d = date('j', $time);  // день
        $m = date('n', $time);  // месяц
        $y = date('Y', $time);  // год

        // Прибавить месяц(ы)
        $m += $num;
        if ($m > 12) {
            $y += floor($m / 12);
            $m = ($m % 12);
            // Дополнительная проверка на декабрь
            if (!$m) {
                $m = 12;
                $y--;
            }
        }
        // Это последний день месяца?
        if ($d == date('t', $time)) {
            $d = 31;
        }
        // Открутить дату, пока она не станет корректной
        while (true) {
            if (checkdate($m, $d, $y)) {
                break;
            }
            $d--;
        }
        // Вернуть новую дату в TIMESTAMP
        return mktime(0, 0, 0, $m, $d, $y);
    }


//---------------------------------------------------------------------
// Расчет графика платежей по разным схемам.
// Возвращает массив с типом платежа, датами и суммами платежей.
//---------------------------------------------------------------------
    function Payment_Schedule($type_platezh, $str_beg_date, $sum_kred, $col_month, $proc, $arr_payments)
    {
        /*
        $type_platezh : тип платежей по кредитам {'annuit', 'differ', 'flex'}
        $str_beg_date : дата выдачи кредита в формате 01.ММ.ГГГГ (гасить начинаем в СЛЕДУЮЩЕМ месяце)
        $sum_kred : сумма кредита (=начальная сумма основного долга)
        $col_month : срок кредита в месяцах
        $proc : годовой процент
        $arr_payments : массив платежей при гибких платежах
        */

        $sum_kred = round((float)$sum_kred, 2);
        $proc = round((float)$proc, 2);
        $col_month = (int)($col_month);

        $arr_all_platezh = array();

        $beg_date = strtotime($str_beg_date);

        # Платить начинаем в следующем месяце после взятия кредита
        $platezh_next_date = $this->Add_month($beg_date);
        $ostatok_dolg = $sum_kred;
        $month_proc = ($proc / 100) / 12; #месячный процент

        // Определяем ежемесячный платеж для аннуитета и дифееренцированной схемы
        if ($type_platezh == 'annuit') {
            $platezh = $sum_kred * ($month_proc + $month_proc / (pow(1 + $month_proc, $col_month) - 1));
            $platezh = round($platezh, 2); #ежемесячный платеж
        } elseif ($type_platezh == 'differ') {
            $platezh_main_dolg = $sum_kred / $col_month;
            $platezh_main_dolg = round((float)$platezh_main_dolg, 2); #ежемесячное погашение основного долга
            $platezh = $sum_kred * ($month_proc + $month_proc / (pow(1 + $month_proc, $col_month) - 1));
            $platezh = round($platezh, 2); #ежемесячный платеж
        }

        /*Рассчитываем в цикле платежи для каждого месяца.
        Для текущего месяца заполняется массив $arr_platezh, затем этот массив добавляется в качестве элемента
        в массив $arr_all_platezh. */
        for ($nomer_platezh = 1; $nomer_platezh <= $col_month; $nomer_platezh++) {
            $ostatok_dolg_0 = $ostatok_dolg; #остаток основного долга до очередного погашения
            $platezh_proc = $ostatok_dolg * $month_proc;
            $platezh_proc = round($platezh_proc, 2); #погашение процентов

            if ($type_platezh == 'annuit') {
                $platezh_main_dolg = $platezh - $platezh_proc;
            } elseif ($type_platezh == 'differ') {
                $platezh = $platezh_main_dolg + $platezh_proc;
            } elseif ($type_platezh == 'flex') {
                $platezh_main_dolg = $arr_payments[$nomer_platezh - 1];
                $platezh = $platezh_main_dolg + $platezh_proc;
            }
            $ostatok_dolg = $ostatok_dolg - $platezh_main_dolg; #остаток основного долга после очередного погашения

            $platezh_date = $platezh_next_date;
            /* Сначала была полная дата
            $str_platezh_date = date("d.m.Y", $platezh_date);
            */
            $str_platezh_date = date("m.Y", $platezh_date);
            $platezh_next_date = $this->Add_month($platezh_date);

            # Корректировка последнего платежа
            if ($nomer_platezh == $col_month) {
                if ($ostatok_dolg != 0) {
                    $platezh_proc = $ostatok_dolg_0 * $month_proc;
                    $platezh_proc = round($platezh_proc, 2); #погашение процентов
                    $platezh_main_dolg = $ostatok_dolg_0;
                    $platezh = $platezh_proc + $platezh_main_dolg;
                    $ostatok_dolg = 0.00;
                }
            }

            // Формируем массив с параметрами платежа для текущего месяца
            $arr_platezh = array('type_platezh' => $type_platezh,
                'nomer' => $nomer_platezh,
                'date' => $str_platezh_date,
                'ostatok_0' => $ostatok_dolg_0,
                'platezh' => $platezh,
                'platezh_proc' => $platezh_proc,
                'platezh_main_dolg' => $platezh_main_dolg,
                'ostatok' => $ostatok_dolg);
            /*Добавляем массив с параметрами платежа в текущем месяце
            в общий массив с платежами за каждый месяц
            */
            $arr_all_platezh[] = $arr_platezh;
        }

        return $arr_all_platezh;
    }

    //---------------------------------------------------------------------
    // Сохранение графика платежей в pdf
    //---------------------------------------------------------------------
    public function PDF($str_beg_date, $sum_kred, $col_month, $proc, $arr_all_platezh)
    {
        $str_out = "<style>";
        $str_out .= "
            .Table {
                border: 1px solid #1C6EA4;
                background-color: #EEEEEE;
                width: 100%;
                text-align: left;
                border-collapse: collapse;
            }
            td, th {
                border: 1px solid #AAAAAA;
                padding: 3px 2px;
            }
            .color1 {
                background-color: #D0E4F5;
            }
            .platezh_table_header, .platezh_table_footer {
                background-color: #1C6EA4;
                color: #FFFFFF;
            }
            ";
        $str_out .= "</style>";
        $str_out .= "<p>Вид платежа: ";
        $type_platezh = $arr_all_platezh[0]['type_platezh'];
        if ($type_platezh == 'annuit')
            $str_out .= "<strong>Аннуитетный платеж</strong></p>";
        elseif ($type_platezh == 'differ')
            $str_out .= "<strong>Дифференцированный платеж</strong></p>";
        elseif ($type_platezh == 'flex')
            $str_out .= "<strong>Гибкий платеж</strong></p>";
        $str_sum_kred = number_format($sum_kred, 2, '.', ' ');
        $str_proc = number_format($proc, 2, '.', ' ');
        $str_out .= "<p>Сумма кредита: <strong>$str_sum_kred</strong> руб.<br>";
        $str_out .= "Процентная ставка: <strong>$str_proc</strong> %<br>";
        $str_out .= "Срок кредита (мес): <strong>$col_month</strong> </p>";
        $str_out .= "<table class=\"Table\">\n";
        $str_out .= "<thead><tr class=\"platezh_table_header\"><th>N</th><th>Дата</th><th>Сумма платежа</th><th>Погашение основного долга</th><th>Погашение процентов</th><th>Остаток основного долга</th></tr></thead><tbody class=\"tbody\">";

        $total_platezh = $total_platezh_main_dolg = $total_platezh_proc = 0;
        $color = false;
        foreach ($arr_all_platezh as $arr_platezh) {
            $str_platezh = number_format($arr_platezh['platezh'], 2, '.', ' ');
            $str_platezh_main_dolg = number_format($arr_platezh['platezh_main_dolg'], 2, '.', ' ');
            $str_platezh_proc = number_format($arr_platezh['platezh_proc'], 2, '.', ' ');
            $str_ostatok = number_format($arr_platezh['ostatok'], 2, '.', ' ');
            if ($color) {
                $str_out .= "<tr class=\"color1\">";
            } else {
                $str_out .= "<tr>";
            }
            $color = !$color;
            $str_out .= "<td class=\"tbody\">" . $arr_platezh['nomer'] . "</td><td>" . $arr_platezh['date'] . "</td><td>" . $str_platezh . "</td>";
            $str_out .= "<td>" . $str_platezh_main_dolg . "</td><td>" . $str_platezh_proc . "</td><td>" . $str_ostatok . "</td></tr>";
            $total_platezh += $arr_platezh['platezh'];
            $total_platezh_main_dolg += $arr_platezh['platezh_main_dolg'];
            $total_platezh_proc += $arr_platezh['platezh_proc'];
        }
        $str_total_platezh = number_format($total_platezh, 2, '.', ' ');
        $str_total_platezh_main_dolg = number_format($total_platezh_main_dolg, 2, '.', ' ');
        $str_total_platezh_proc = number_format($total_platezh_proc, 2, '.', ' ');
        $str_out .= "<tr class=\"platezh_table_footer\"><td></td><td>Итого</td><td>$str_total_platezh</td><td>$str_total_platezh_main_dolg</td>";
        $str_out .= "<td>$str_total_platezh_proc</td><td></td></tr>";
        $str_out .= "</tbody></table>\n";

        PDF::SetFont('dejavusans', '', 30);
        PDF::AddPage();
        PDF::SetTitle('Финансист Онлайн');
        PDF::Cell(0, 20, 'Финансист Онлайн', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        PDF::SetFont('dejavusans', '', 14);
        PDF::Ln();
        PDF::writeHTML($str_out, true, false, true, false, '');
        PDF::Output('hello_world.pdf');

    }
}
