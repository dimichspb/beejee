(function($){
    $('#preview-modal').on('shown.bs.modal', function () {
        fillPreviewFields($("#user").val(), $("#email").val(), $("#description").val());
    })

    $("#image").change(function() {
        readImage(this);
    });
})(jQuery);

function fillPreviewFields(username, email, description)
{
    $("#preview-user").val(username);
    $("#preview-email").val(email);
    $("#preview-description").val(description);
}

function readImage(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#preview-image').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}