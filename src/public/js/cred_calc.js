

//**********************************************************************************************
//Код выполняется после загрузки всего содержимого документа
//**********************************************************************************************
$(document).ready(function() {


	//Нажимаем на кнопку в форме
	$('#btnShowPaymentSchedule').click(function(){
		//Проверяем корректность значений в полях формы
        var data = $("#frmPlatezhParam :input").serialize();
        $.get($("#frmPlatezhParam").attr('action'), data, function(html_reply){
                $('#text-popup').html(html_reply);
                $('#myModal').modal('show');
            }
        )
	});

	//Submit в форме не используется
	$('#frmPlatezhParam').submit(function() {
		return false;
	}
	);

});
