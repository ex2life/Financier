function ValidFormPlatezhParam() {
    // Количество платежей по гибкой схеме
    var col_flex_payments = $('input[name="flex_payment_schedule[]"]').length;
    if (col_flex_payments > 0) {
        var sum_flex_payments = 0;
        $('input[name="flex_payment_schedule[]"]').each(function () {
            sum_flex_payments += parseFloat($(this).val());
        });
        var sum_kred = parseFloat($('#sum_kred').val());
        if (sum_flex_payments > sum_kred) {
            alert('Ошибка ввода - сумма платежей по кредиту (' + sum_flex_payments + ' руб) больше суммы кредита (' + sum_kred + ' руб)!');
            return false;
        }
        ;

    }
    ;
    return $('#frmPlatezhParam').valid();
}


//**********************************************************************************************
//Код выполняется после загрузки всего содержимого документа
//**********************************************************************************************
$(document).ready(function () {

//Настройка проверок значений элементов ввода в форме
    $("#frmPlatezhParam").validate({
        rules: {
            sum_kred: {
                required: true,
                pattern: "^\\d+(\\.\\d{1,2})?$"
            },
            str_beg_date: {
                required: true,
                pattern: "(0[1-9]|1[012])\\.[0-9]{4}"
            },
            col_month: {
                required: true,
                number: true,
                min: 1
            },
            proc: {
                required: true,
                pattern: "^\\d+(\\.\\d{1,2})?$"
            }
        },
        messages: {
            sum_kred: {
                required: "Укажите сумму кредита в рублях.",
                pattern: "Неправильный формат числа. Сумма должно быть в рублях (100) или рублях и копейках (100.25)"
            },
            str_beg_date: {
                required: "Укажите дату получения кредита (месяц и год).",
                pattern: "Неправильный формат даты. Укажите месяц и год получения кредита (например, 01.2010)"
            },
            col_month: {
                required: "Укажите срок кредита.",
                number: "Неправильный формат числа. Срок кредита - целое число",
                min: "Минимальный срок кредита - 1 месяц"
            },
            proc: {
                required: "Укажите годовую процентную ставку кредита.",
                pattern: "Неправильный формат числа. Процент - число с двумя знаками после запятой"
            }
        }
    });

    //Нажимаем на кнопку в форме
    $('#btnShowPaymentSchedule').click(function () {
        //Проверяем корректность значений в полях формы
        if (ValidFormPlatezhParam()) {
            var data = $("#frmPlatezhParam :input").serialize();
            $.post($("#frmPlatezhParam").attr('action'), data, function (html_reply) {
                    $('#text-popup').html(html_reply);
                    $('#phpModal').modal('show');
                }
            )
        }
    });

    //Submit в форме не используется
    $('#frmPlatezhParam').submit(function () {
            return false;
        }
    );

});
