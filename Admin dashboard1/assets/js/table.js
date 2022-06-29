$(document).ready(function () {
  $("#tableModal").on("hidden.bs.modal", function () {
    $("#submit_button")
      .attr("value", "Add New")
      .attr("onclick", "manageData('addNew')")
      .fadeIn();
  });
//PREPARE ADD BUTTON
  $("#add_table").click(function () {
    $("#table_form")[0].reset();

    $("#table_form").parsley().reset();

    $("#modal_title").text("Add Data");

    $("#action").val("Add");

    $("#submit_button").val("Add");

    $("#tableModal").modal("show");

    $("#form_message").html("");
  });

  getExistingData(0, 50);
});
//DELETE ROW FROM TABLE
function deleteRow(rowID) {
  if (confirm("Are you sure??")) {
    $.ajax({
      url: "manage action/table.php",
      method: "POST",
      dataType: "text",
      data: {
        key: "deleteRow",
        rowID: rowID,
      },
      success: function (response) {
        $("#table_name" + rowID)
          .parent()
          .remove();
        $("#message").html("").fadeIn();
        $("#message")
          .html(
            '<div id="res" class="alert alert-danger">' + response + "</div>"
          )
          .fadeOut(3000);
      },
    });
  }
}
//ADD|EDIT ROW FROM TABLE
function manageData(key) {
  $("#table_form").parsley().validate();
  let name = $("#table_name");
  let capacity = $("#table_capacity");
  let status = $("#table_status");
  let editRowID = $("#hidden_id");
  if ($("#table_form").parsley().isValid()) {
    $.ajax({
      url: "manage action/table.php",
      method: "POST",
      dataType: "text",
      data: {
        key: key,
        name: name.val(),
        capacity: capacity.val(),
        status: status.val(),
        rowID: editRowID.val(),
      },
      success: function (response) {
        $("#tableModal").modal("hide");
        $("#message").html("").fadeIn();
        console.log(response);
        if (response == "inserted") {
          $("#message")
            .html(
              '<div class="alert alert-success">The Table Has been Inserted</div>'
            )
            .fadeOut(4000);
        } else if (response == "edited") {
          $("#table_name" + editRowID.val()).html(name.val());
          $("#table_capacity" + editRowID.val()).html(capacity.val());
          $("#table_status" + editRowID.val()).html(status.val());
          $("#message")
            .html(
              '<div class="alert alert-success">The Table Has been Edited</div>'
            )
            .fadeOut(4000);
        } else {
          $("#message")
            .html(
              '<div id="res" class="alert alert-danger">Table With This Number Already Taken!</div>'
            )
            .fadeOut(4000);
        }
      },
    });
  }
}
//GET ROW DATA
function edit(rowID) {
  $("#table_form").parsley().reset();
  $.ajax({
    url: "manage action/table.php",
    method: "POST",
    dataType: "json",
    data: {
      key: "getRowData",
      rowID: rowID,
    },
    success: function (response) {
      $("#tableModal").modal("show");
      $("#table_name").val(response.tableName);
      $("#table_capacity").val(response.capacity);
      $("#table_status").val(response.status);
      $("#hidden_id").val(rowID);
      $("#submit_button").val("Save Changes");
      $("#submit_button").attr("onclick", "manageData('updateRow')");
    },
  });
}
//GET TABLE DATA
function getExistingData(start, limit) {
  $.ajax({
    url: "manage action/table.php",
    method: "POST",
    dataType: "text",
    data: {
      key: "getExistingData",
      start: start,
      limit: limit,
    },
    success: function (response) {
      let dom =
        "B<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
      if (response != "reachedMax") {
        $("tbody").append(response);
        start += limit;
        getExistingData(start, limit);
      } else
        $(".table").DataTable({
          dom: dom,
          buttons: [
            {
              extend: "excelHtml5",
              title: "Table Report",
              exportOptions: {
                columns: [0, 1, 2],
              },
            },
            {
              extend: "pdfHtml5",
              title: "Table Report",
              orientation: "portrait", //portrait
              pageSize: "A4",
              customize: function (doc) {
                doc.content[1].margin = [100, 0, 100, 0];
              },
              exportOptions: {
                columns: [0, 1, 2],
              },
            },
            {
              extend: "print",
              title: "Table Report",
              exportOptions: {
                columns: [0, 1, 2],
              },
            },
          ],
        });
    },
  });
}
