(function($){
    $('#preview-modal').on('shown.bs.modal', function () {
        fillPreviewFields($("#user").val(), $("#email").val(), $("#description").val());
    })
})(jQuery);

function fillPreviewFields(username, email, description)
{
    $("#preview-user").val(username);
    $("#preview-email").val(email);
    $("#preview-description").val(description);
}