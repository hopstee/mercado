
$(document).ready(function(){
    var textarea_max = 500;
    $("#textarea-feedback").html(textarea_max + "{{ t('characters left') }}");
    $('#message').keyup(function() {
        var textarea_length = $('#message').val().length,
            textarea_remaining = textarea_max - textarea_length;

        if (textarea_length === 0) {
            $('#textarea-feedback').html(textarea_max + "{{ t('characters left') }}");
        } else if (textarea_length > textarea_max) {
            $('#textarea-feedback').html('Too many characters');
        } else {
            $('#textarea-feedback').html(textarea_remaining + "{{ t('characters left') }}");
        }
    });
});