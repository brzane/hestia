$(document).ready(function () {
  $("#userModal").on("hidden.bs.modal", function () {
    $("#submit_button")
      .attr("value", "Add New")
      .attr("onclick", "manageData('addNew')")
      .fadeIn();
  });
  //PREPARE ADD BUTTON
  $("#add_user").click(function () {
    $("#user_form")[0].reset();

    $("#user_form").parsley().reset();

    $("#modal_title").text("Add Data");

    $("#action").val("Add");

    $("#submit_button").val("Add");

    $("#userModal").modal("show");

    $("#form_message").html("");

    $("#user_uploaded_image").html("");
  });

  getExistingData(0, 50);
});
//DELETE ROW FROM TABLE
function deleteRow(rowID) {
  if (confirm("Are you sure??")) {
    $.ajax({
      url: "manage action/users.php",
      method: "POST",
      dataType: "text",
      data: {
        key: "deleteRow",
        rowID: rowID,
      },
      success: function (response) {
        $("#user_name" + rowID)
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
  $("#user_form").parsley().validate();
  let name = $("#user_name");
  let phone = $("#user_contact_no");
  let type = $("#user_type");
  let email = $("#user_email");
  let password = $("#user_password");
  let editRowID = $("#hidden_id");
  if ($("#user_form").parsley().isValid()) {
    $.ajax({
      url: "manage action/users.php",
      method: "POST",
      dataType: "text",
      data: {
        key: key,
        name: name.val(),
        phone: phone.val(),
        email: email.val(),
        password: password.val(),
        type: type.val(),
        rowID: editRowID.val(),
      },
      success: function (response) {
        $("#userModal").modal("hide");
        $("#message").html("").fadeIn();
        console.log(response);
        if (response == "inserted")
          $("#message")
            .html(
              '<div class="alert alert-success">The User Has been Inserted</div>'
            )
            .fadeOut(4000);
        else if (response == "edited") {
          $("#user_name" + editRowID.val()).html(name.val());
          $("#user_phone" + editRowID.val()).html(phone.val());
          $("#user_email" + editRowID.val()).html(email.val());
          $("#user_type" + editRowID.val()).html(type.val());
          $("#user_password" + editRowID.val()).html(password.val());
          $("#message")
            .html(
              '<div class="alert alert-success">The User Has been Edited</div>'
            )
            .fadeOut(4000);
        } else {
          $("#message")
            .html(
              '<div id="res" class="alert alert-danger">User is Alredy Exists</div>'
            )
            .fadeOut(4000);
        }
      },
    });
  }
}
//GET ROW DATA
function edit(rowID) {
  $("#user_form").parsley().reset();
  $.ajax({
    url: "manage action/users.php",
    method: "POST",
    dataType: "json",
    data: {
      key: "getRowData",
      rowID: rowID,
    },
    success: function (response) {
      $("#userModal").modal("show");
      $("#user_name").val(response.name);
      $("#user_contact_no").val(response.phone);
      $("#user_email").val(response.email);
      $("#user_type").val(response.type);
      $("#user_password").val(response.password);
      $("#hidden_id").val(rowID);
      $("#submit_button").val("Save Changes");
      $("#submit_button").attr("onclick", "manageData('updateRow')");
    },
  });
}
//GET TABLE DATA
function getExistingData(start, limit) {
  $.ajax({
    url: "manage action/users.php",
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
              title: "User Report",
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5],
              },
            },
            {
              extend: "pdfHtml5",
              title: "User Report",
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
              title: "User Report",
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5],
              },
            },
          ],
        });
    },
  });
}
