jQuery('.selectpicker').selectpicker();
$(document).ready(function() {
    $("#pro_company_name_id").hide();
    $("#companypro_license_no_id").hide();
    $('#company_product_details_id').change(function() {
        var company_details = $(this).val();
        if (company_details == "procompany_name") {
            $("#pro_company_name_id").show();
            $("#companypro_license_no_id").hide();
            jQuery('#company_product_details_id').selectpicker('refresh');
               
        } else if (company_details == "prolicense_no") {
            $("#companypro_license_no_id").show();
            $("#pro_company_name_id").hide();
            jQuery('#company_product_details_id').selectpicker('refresh');
        } else if (company_details.includes("procompany_name") && company_details.includes("prolicense_no")) {
            $("#pro_company_name_id").show();
            $("#companypro_license_no_id").show();
            jQuery('#company_product_details_id').selectpicker('refresh');
        } else {
            $("#pro_company_name_id").hide();
            $("#companypro_license_no_id").hide();
            jQuery('#company_product_details_id').selectpicker('refresh');
        }
    });
});