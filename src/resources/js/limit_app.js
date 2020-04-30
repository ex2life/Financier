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
