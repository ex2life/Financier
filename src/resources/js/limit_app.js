$(document).ready(function() {
    $('.modal.show').modal('show');
});

$('#confirmDeleteCompany').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    var company_del_link = $(e.relatedTarget).data('company_del_link');
    $("#delForm").attr('action', company_del_link);
});

$('#confirmDeleteGsz').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    var gsz_del_link = $(e.relatedTarget).data('gsz_del_link');
    $("#delForm").attr('action', gsz_del_link);
});


$('#editCompany').on('show.bs.modal', function(e) {
    var company_name = $(e.relatedTarget).data('company_name');
    var company_action = $(e.relatedTarget).data('company_action');
    var company_inn = $(e.relatedTarget).data('company_inn');
    var company_opf = $(e.relatedTarget).data('company_opf');
    var company_sno = $(e.relatedTarget).data('company_sno');
    var company_date_registr = $(e.relatedTarget).data('company_date_registr');
    var company_date_begin_work = $(e.relatedTarget).data('company_date_begin_work');
    var modal = $(this);
    if (company_name != null){
        modal.find('.invalid-feedback').remove();
        modal.find('.is-invalid').removeClass('is-invalid');
        modal.find('#edit_name_company').val(company_name);
        modal.find('#edit_inn').val(company_inn);
        modal.find('#edit_opf').val(company_opf);
        modal.find('#edit_sno').val(company_sno);
        modal.find('#edit_date_registr').val(company_date_registr);
        modal.find('#edit_date_begin_work').val(company_date_begin_work);
        modal.find("#edit_companyForm").attr('action', company_action);
    }
});

$('#editGsz').on('show.bs.modal', function(e) {
    var gsz_action = $(e.relatedTarget).data('gsz_action');
    var gsz_brief_name = $(e.relatedTarget).data('gsz_brief_name');
    var gsz_full_name = $(e.relatedTarget).data('gsz_full_name');
    var modal = $(this);
    if (gsz_brief_name != null){
        modal.find('.invalid-feedback').remove();
        modal.find('.is-invalid').removeClass('is-invalid');
        modal.find('#edit_brief_name').val(gsz_brief_name);
        modal.find('#edit_full_name').val(gsz_full_name);
        modal.find("#edit_gszForm").attr('action', gsz_action);
    }
});

$('#editDate').on('show.bs.modal', function(e) {
    var gsz_date_action = $(e.relatedTarget).data('gsz_date_action');
    var gsz_brief_name = $(e.relatedTarget).data('gsz_brief_name');
    var gsz_date = $(e.relatedTarget).data('gsz_date');
    var modal = $(this);
    if (gsz_brief_name != null){
        modal.find('.invalid-feedback').remove();
        modal.find('.is-invalid').removeClass('is-invalid');
        modal.find('#modal-title').text('Дата расчета лимита для '+gsz_brief_name);
        modal.find('#date_calc_limit').val(gsz_date);
        modal.find("#editDateForm").attr('action', gsz_date_action);
    }
});

$('#editCreditInfo').on('show.bs.modal', function(e) {
    var credit_info_action = $(e.relatedTarget).data('credit_info_action');
    var gsz_name = $(e.relatedTarget).data('gsz_name');
    var credit_info_month = $(e.relatedTarget).data('credit_info_month');
    var credit_info_sum = $(e.relatedTarget).data('credit_info_sum');
    var credit_info_stavka = $(e.relatedTarget).data('credit_info_stavka');
    var modal = $(this);
    if (gsz_name != null){
        modal.find('.invalid-feedback').remove();
        modal.find('.is-invalid').removeClass('is-invalid');
        modal.find('#modal-title').text('Данные кредита для '+gsz_name);
        modal.find('#month').val(credit_info_month);
        modal.find('#sum').val(credit_info_sum);
        modal.find('#stavka').val(credit_info_stavka);
        modal.find("#editCreditInfo").attr('action', credit_info_action);
    }
});

const calc_app = new Vue({
    el: '#limit_app',
    data: {
    },
    methods: {
        summing({target}) {
            var parent_code=target.getAttribute('data-parent-code');
            var childElements = $('.'+parent_code);
            var sum=0;
            for(child of childElements) {
                sum+=parseFloat(child.value.replace(/ /g,""));
            }
            $('#'+parent_code).val(sum.toFixed(2));
            $('#'+parent_code+'div').text(sum.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " "));
            var section_code=target.getAttribute('data-section-code');
            childElements = $('.'+section_code);
            sum=0.00;
            flt=0.00;
            for(child of childElements) {
                str=child.value.replace(/ /g,"")
                flt=parseFloat(str)
                sum+=flt;
            }
            $('#'+section_code).text(parseFloat(sum.toFixed(2)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " "));
            var part=target.getAttribute('data-part');
            childElements = $('.'+part);
            sum=0.00;
            for(child of childElements) {
                sum+=parseFloat(child.innerText.replace(/ /g,""));
            }
            $('#'+part).text(parseFloat(sum.toFixed(2)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " "));
            var parts=part.slice(0, -1);
            var alert= $('#'+parts);
            var balance_id=target.getAttribute('data-balance-id');
            var button= $('#but'+balance_id);
            var passiv=parseFloat($('#'+parts+'0').text().replace(/ /g,""));
            var activ=parseFloat($('#'+parts+'1').text().replace(/ /g,""));
            if (passiv==activ){
                alert.removeClass('alert-danger');
                alert.text('Все хорошо, пассив равен активу.');
                alert.addClass('alert-success');
                button.prop('disabled', false);
            }
            else{
                alert.removeClass('alert-success');
                if (passiv>activ) {
                    alert.text('Пассив больше актива на ' + parseFloat((passiv-activ).toFixed(2)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + '! Сохранение не возможно!');
                }
                else{
                    alert.text('Актив больше пассива на ' + parseFloat((activ-passiv).toFixed(2)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + '! Сохранение не возможно!');
                }
                alert.addClass('alert-danger');
                button.prop('disabled', true);
            }
        },
    },
});
