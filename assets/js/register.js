$(document).ready(function () {

    $('#form_regis').on('submit', function (event) {

        const email_len = $('#email').val().length;
        const password_len = $('#password').val().length;

        if (email_len < 10) {

            event.preventDefault();
            $('#email_desc').text('* Your email must be longer than 10 characters.');
        }
        else {

            $('#email_desc').text('');
        }
        if (password_len < 3 || password_len > 16) {

            event.preventDefault();
            $('#password_desc').text('* Your password must be longer than 3-16 characters.');
        }
        else {

            $('#password_desc').text('');
        }
    })
    $('#email').on('keyup', function () {

        var len = $('#email').val().length;

        if (len < 10) {

            $('#email').removeClass('focus-ring-dark').addClass('focus-ring-danger');
        }
        else {

            $('#email').removeClass('focus-ring-danger').addClass('focus-ring-success');
            $('#email_desc').text('');
        }
    })
    $('#password').on('keyup', function () {

        var len = $('#password').val().length;

        if (len < 3 || len > 16) {

            $('#password').removeClass('focus-ring-dark').addClass('focus-ring-danger');
        }
        else {

            $('#password').removeClass('focus-ring-danger').addClass('focus-ring-success');
            $('#password_desc').text('');
        }
    })
    $('#reveal_btn').on('click', function () {

        var type = $('#password').attr('type');

        if (type === 'password') {

            $('#password').attr('type', 'text');
            $('#reveal-eye').removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
        }
        else {

            $('#password').attr('type', 'password');
            $('#reveal-eye').removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
        }
    })
})