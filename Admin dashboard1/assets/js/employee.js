$(document).ready(function () {
  $("#productModal").on("hidden.bs.modal", function () {
    $("#submit_button")
      .attr("value", "Add New")
      .attr("onclick", "manageData('addNew')")
      .fadeIn();
  });
  getExistingData(0, 50);
  getSalesData(0, 50);
  //PREPARE ADD BUTTON
  $("#add_employee").click(function () {
    $("#employee_form")[0].reset();

    $("#employee_form").parsley().reset();

    $("#modal_title").text("Add Data");

    $("#action").val("Add");

    $("#submit_button").val("Add");

    $("#employeeModal").modal("show");

    $("#form_message").html("");
  });
});
//DELETE ROW FROM TABLE
function deleteRow(rowID) {
  let name = $('#employee_name'+rowID+'');
  if (confirm("Are you sure??")) {
    $.ajax({
      url: "manage action/employee.php",
      method: "POST",
      dataType: "text",
      data: {
        key: "deleteRow",
        name:name.text(),
        rowID: rowID,
      },
      success: function (response) {
        $("#employee_ssn" + rowID)
          .parent()
          .remove();
          $("#sales_" + name)
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
  $("#employee_form").parsley().validate();
  let ssn = $("#employee_ssn");
  let name = $("#employee_name");
  let phone = $("#employee_phone");
  let salary = $("#employee_salary");
  let type = $("#employee_type");
  let editRowID = $("#hidden_id");
  if ($("#employee_form").parsley().isValid()) {
    $.ajax({
      url: "manage action/employee.php",
      method: "POST",
      dataType: "text",
      data: {
        key: key,
        ssn: ssn.val(),
        name: name.val(),
        phone: phone.val(),
        type: type.val(),
        salary: salary.val(),
        rowID: editRowID.val(),
      },
      success: function (response) {
        $("#employeeModal").modal("hide");
        $("#message").html("").fadeIn();

        if (response == "inserted") {
          $("#message")
            .html(
              '<div class="alert alert-success">The Employee Has been Inserted</div>'
            )
            .fadeOut(4000);
        } else if (response == "edited") {
          $("#employee_ssn" + editRowID.val()).html(ssn.val());
          $("#employee_name" + editRowID.val()).html(name.val());
          $("#employee_phone" + editRowID.val()).html(phone.val());
          $("#employee_salary" + editRowID.val()).html(salary.val());
          $("#employee_type" + editRowID.val()).html(type.val());
          $("#message")
            .html(
              '<div class="alert alert-success">The Employee Has been Edited</div>'
            )
            .fadeOut(4000);
        } else {
          $("#message")
            .html(
              '<div id="res" class="alert alert-danger">Employee is Alredy Exists</div>'
            )
            .fadeOut(4000);
        }
      },
    });
  }
}
//GET ROW DATA
function edit(rowID) {
  $("#employee_form").parsley().reset();
  $.ajax({
    url: "manage action/employee.php",
    method: "POST",
    dataType: "json",
    data: {
      key: "getRowData",
      rowID: rowID,
    },
    success: function (response) {
      console.log(response);
      $("#employeeModal").modal("show");
      $("#employee_ssn").val(response.ssn);
      $("#employee_name").val(response.name);
      $("#employee_phone").val(response.phone);
      $("#employee_type").val(response.type);
      $("#employee_salary").val(response.salary);
      $("#hidden_id").val(rowID);
      $("#submit_button").val("Save Changes");
      $("#submit_button").attr("onclick", "manageData('updateRow')");
    },
  });
}
//GET TABLE DATA
function getExistingData(start, limit) {
  $.ajax({
    url: "manage action/employee.php",
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
        $(".employee").append(response);
        start += limit;
        getExistingData(start, limit);
      } else
        $("#employee.table").DataTable({
          dom: dom,
          buttons: [
            {
              extend: "excelHtml5",
              title: "Employee Report",
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5],
              },
            },
            {
              extend: "pdfHtml5",
              title: "Employee Report",
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
              title: "Employee Report",
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5],
              },
            },
          ],
        });
    },
  });
}

function getSalesData(start, limit) {
  $.ajax({
    url: "manage action/employee.php",
    method: "POST",
    dataType: "text",
    data: {
      key: "getSalesData",
      start: start,
      limit: limit,
    },
    success: function (response) {
      $(".sales").append(response);
      $("#sales_table").DataTable();
    },
  });
}
