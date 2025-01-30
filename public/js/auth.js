$(document).bind('keypress', function(e) {
    if (e.keyCode == 13) {
        $('#button_submit').trigger('click');
    }
});


$('#button_submit').click(function() {
    $('.text-alert span').remove();
    $('.text-alert p').remove();
    $('.text-alert ul').remove();
    $('.text-alert li').remove();
    var form = $('#form-login').serialize();
    $.ajax({
        type: "POST",
        url: base_url + "auth/login_auth",
        data: form,
        dataType: 'json',
        beforeSend: function() {
            $("#progress").show();
        },
        success: function(response) {
            console.log(response);
            if (response.status == "OK") {
                location.href = base_url + "employees/profile_view/"+response.user_id+"/"+response.position_id;
            } else {
                $('.alert').show();
                $('.text-alert').append('<span>'+response.status+'</span><p>'+response.message+'</p>');
                setTimeout(function(){ $('.alert').hide(); }, 5000);
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            $('.alert').show();
            $('.text-alert').append('<span>'+xhr.status+'</span>');
            setTimeout(function(){ $('.alert').hide(); }, 5000);
        }
    });
});

