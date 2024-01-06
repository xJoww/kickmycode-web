$(document).ready(function() {

    setTimeout (function () {

        loadTable();
        loadPagination();

    }, 800);
   
    const toast_btn = document.getElementById('create_btn')
    const toast_alert = document.getElementById('toast_alert')
    
    if (toast_btn) {

        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast_alert)

        toast_btn.addEventListener('click', () => {

            toastBootstrap.show()
        })
    }
    $('#form_add').on('submit', function (e) {

        $('#email').on('keyup', function () {

            var length = $('#email').val().length;

            if (length < 10) {

                $('#email').removeClass('focus-ring-success').addClass('focus-ring-danger');
            }
            else $('#email').removeClass('focus-ring-danger').addClass('focus-ring-success');
        })
        $('#email_pw').on('keyup', function () {

            var length = $('#email_pw').val().length;

            if (length < 1) {

                $('#email_pw').removeClass('focus-ring-success').addClass('focus-ring-danger');
            }
            else $('#email_pw').removeClass('focus-ring-danger').addClass('focus-ring-success');
        })
        $('#stake_pw').on('keyup', function () {

            var length = $('#stake_pw').val().length;

            if (length < 1) {

                $('#stake_pw').removeClass('focus-ring-success').addClass('focus-ring-danger');
            }
            else $('#stake_pw').removeClass('focus-ring-danger').addClass('focus-ring-success');
        })
        e.preventDefault();

        $.ajax({

            url: $('#form_add').attr('action'),
            type: $('#form_add').attr('method'),
            data: $('#form_add').serialize(),
            success: function () {

                $('#close_btn').click();
                $('#no-data').text('');

                loadTable();
                loadPagination();
            }
        });
    })
    $('#keyword').on('input', function(){

        var searchTerm = $(this).val();

        if(searchTerm.length > 0){

            $.ajax({

                url: 'home/ajax/dashboard-search.php',
                type: 'POST',
                data: {search: searchTerm},
                cache: false,
                success: function(data){

                    if(data.trim() == '') {

                        $('#live-table').html('');
                        $('#loading-data').text("We couldn't found any data with '" + searchTerm + "'.");
                    }
                    else $('#live-table').html(data);
                }
            });
        }
        else {

            loadTable();
        }
    });
    $('#email').on('keyup', function () {

        var len =  $('#email').val().length;

        if (len < 10) {

            $('#email').removeClass('focus-ring-success').addClass('focus-ring-danger');
            $('#email_desc').text('* The email must be longer than 10 characters.');
        }
        else {

            $('#email').removeClass('focus-ring-danger').addClass('focus-ring-success');
            $('#email_desc').text('');
        }
    })
    $('#email_pw').on('keyup', function () {

        var len =  $('#email_pw').val().length;

        if (len < 1) {

            $('#email_pw').removeClass('focus-ring-success').addClass('focus-ring-danger');
            $('#email_pw_desc').text('* The email password must be filled.');
        }
        else {

            $('#email_pw').removeClass('focus-ring-danger').addClass('focus-ring-success');
            $('#email_pw_desc').text('');
        }
    })
    $('#stake_pw').on('keyup', function () {

        var len =  $('#stake_pw').val().length;

        if (len < 1) {

            $('#stake_pw').removeClass('focus-ring-success').addClass('focus-ring-danger');
            $('#stake_pw_desc').text('* The stake password must be filled.');
        }
        else {

            $('#stake_pw').removeClass('focus-ring-danger').addClass('focus-ring-success');
            $('#stake_pw_desc').text('');
        }
    })
});
function loadTable() {

    $('#loading-data').text('');

    $.ajax({

        url: "home/ajax/dashboard-realtime.php",
        type: "GET",
        success: function (response) {

            $('#live-table').html(response);
        }
    });
}
function loadPagination() {

    $.ajax({

        url: "home/ajax/dashboard-pagination.php",
        type: "GET",
        success: function (response) {

            $('#live-pagination').html(response);
        }
    });
}