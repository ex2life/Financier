$(document).ready(function() {
    $('.modal.show').modal('show');
});

$('#confirmDeleteCompany').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    var company_del_link = $(e.relatedTarget).data('company_del_link');
    $("#delForm").attr('action', company_del_link);
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
    console.log(company_name);
    console.log(company_name == null);
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

