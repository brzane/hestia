$(document).ready(function() {

    $("#productModal").on('hidden.bs.modal', function() {
        $("#submit_button").attr('value', 'Add New').attr('onclick', "manageData('addNew')").fadeIn();
    });

    getExistingData(0, 50);

});
//DELETE ROW FROM TABLE
function deleteRow(rowID) {
    if (confirm('Are you sure??')) {
        $.ajax({
            url: 'manage action/complaint.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'deleteRow',
                rowID: rowID
            },
            success: function(response) {
                $("#name" + rowID).parent().remove();
                $("#message").html("").fadeIn();
                $("#message").html('<div id="res" class="alert alert-danger">' + response + '</div>').fadeOut(3000);
            }
        });
    }
}

//VIEW ROW INFO
function view(rowID) {
    $.ajax({
        url: 'manage action/complaint.php',
        method: 'POST',
        dataType: 'json',
        data: {
            key: 'getRowData',
            rowID: rowID
        },
        success: function(response) {
            $('#complaintModal').modal('show');
            $("#customer_name").val(response.name);
            $("#customer_email").val(response.email);
            $("#customer_subject").val(response.subject);
            $('#customer_message').val(response.message);
            $("#hidden_id").val(rowID);
        }
    });
}
//GET TABLE DATA
function getExistingData(start, limit) {
    $.ajax({
        url: 'manage action/complaint.php',
        method: 'POST',
        dataType: 'text',
        data: {
            key: 'getExistingData',
            start: start,
            limit: limit
        },
        success: function(response) {
            let dom = "B<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
            if (response != "reachedMax") {
                $('tbody').append(response);
                start += limit;
                getExistingData(start, limit);
            } else
                $(".table").DataTable({
                    "dom": dom,
                    buttons: [{
                            extend: 'excelHtml5',
                            title: 'Complaint Report',
                            exportOptions: {
                                columns: [0, 1, 2]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Complaint Report',
                            orientation: 'portrait', //portrait
                            pageSize: 'A4',
                            customize: function(doc) {
                                doc.content[1].margin = [100, 0, 100, 0]
                            },
                            exportOptions: {
                                columns: [0, 1, 2]
                            }
                        },
                        {
                            extend: 'print',
                            title: 'Complaint Report',
                            exportOptions: {
                                columns: [0, 1, 2]
                            }
                        }
                    ]
                });
        }
    });
}