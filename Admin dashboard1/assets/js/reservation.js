$(document).ready(function () {
  $("#reservationModal").on("hidden.bs.modal", function () {
    $("#submit_button")
      .attr("value", "Add New")
      .attr("onclick", "manageData('addNew')")
      .fadeIn();
  });
  getExistingData(0, 50);
  getTableData();
  //PREPARE ADD BUTTON
  $("#add_reservation").click(function () {
    $("#reservation_form")[0].reset();

    $("#reservation_form").parsley().reset();

    $("#modal_title").text("Add Data");

    $("#action").val("Add");

    $("#submit_button").val("Add");

    $("#reservationModal").modal("show");

    $("#form_message").html("");
  });
  $("#datepicker").datepicker({
    format: "yyyy-mm-dd",
  });
  $("#timepicker").timepicker();
});
//DELETE ROW FROM TABLE
function deleteRow(rowID) {
  if (confirm("Are you sure??")) {
    $.ajax({
      url: "manage action/reservations.php",
      method: "POST",
      dataType: "text",
      data: {
        key: "deleteRow",
        rowID: rowID,
      },
      success: function (response) {
        $("#res_name" + rowID)
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
  $("#reservation_form").parsley().validate();
  let name = $("#person_name");
  let phone = $("#person_phone");
  let sets = $("#person_number");
  let table = $("#table_number");
  let time = $("#timepicker");
  let date = $("#datepicker");
  let editRowID = $("#hidden_id");
  if ($("#reservation_form").parsley().isValid()) {
    $.ajax({
      url: "manage action/reservations.php",
      method: "POST",
      dataType: "text",
      data: {
        key: key,
        name: name.val(),
        phone: phone.val(),
        sets: sets.val(),
        table: table.val(),
        time: time.val(),
        date: date.val(),
        rowID: editRowID.val(),
      },
      success: function (response) {
        $("#reservationModal").modal("hide");
        $("#message").html("").fadeIn();
        if (response == "inserted") {
          $("#message")
            .html(
              '<div class="alert alert-success">The Reservation Has been Inserted</div>'
            )
            .fadeOut(4000);
        } else if (response == "edited") {
          $("#res_name" + editRowID.val()).html(name.val());
          $("#res_phone" + editRowID.val()).html(phone.val());
          $("#res_number" + editRowID.val()).html(sets.val());
          $("#res_date" + editRowID.val()).html(date.val());
          $("#res_time" + editRowID.val()).html(time.val());
          $("#message")
            .html(
              '<div class="alert alert-success">The Reservation Has been Edited</div>'
            )
            .fadeOut(4000);
        } else {
          $("#message")
            .html(
              '<div id="res" class="alert alert-danger">Sorry The Table is Booked or Does Not Exist</div>'
            )
            .fadeOut(4000);
        }
      },
    });
  }
}
//GET ROW DATA
function edit(rowID) {
  $.ajax({
    url: "manage action/reservations.php",
    method: "POST",
    dataType: "json",
    data: {
      key: "getRowData",
      rowID: rowID,
    },
    success: function (response) {
      $("#reservation_form")[0].reset();
      $("#reservationModal").modal("show");
      $("#person_name").val(response.personName);
      $("#person_phone").val(response.personPhone);
      $("#person_number").val(response.personsNumber);
      $("#datepicker").val(response.date);
      $("#timepicker").val(response.time);
      if(response.tableNumber!="pending"){
        $("#table_number").val(response.tableNumber);
      }
      $("#hidden_id").val(rowID);
      $("#submit_button").val("Save Changes");
      $("#submit_button").attr("onclick", "manageData('updateRow')");
    },
  });
}
//GET RESERVATION TABLE DATA
function getExistingData(start, limit) {
  $.ajax({
    url: "manage action/reservations.php",
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
        $("#reservation_table").DataTable({
          order: [
            [4, "desc"],
            [5, "desc"],
          ],
          dom: dom,
          buttons: [
            {
              extend: "excelHtml5",
              title: "Reservation Report",
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5],
              },
            },
            {
              extend: "pdfHtml5",
              title: "Reservation Report",
              orientation: "portrait", //portrait
              pageSize: "A4",
              customize: function (doc) {
                doc.content[1].margin = [100, 0, 100, 0];
              },
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5],
              },
            },
            {
              extend: "print",
              title: "Reservation Report",
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5],
              },
            },
          ],
        });
    },
  });
}
//GET TABLES TABLE DATA
function getTableData() {
  $.ajax({
    url: "manage action/reservations.php",
    method: "POST",
    dataType: "text",
    data: {
      key: "getTableData",
    },
    success: function (response) {
      $("#table-status").append(response);
    },
  });
}
