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

        e.preventDefault();

        $.ajax({

            url: $('#form_add').attr('action'),
            type: $('#form_add').attr('method'),
            data: $('#form_add').serialize(),
            success: function () {

                $('#close_btn').click();

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