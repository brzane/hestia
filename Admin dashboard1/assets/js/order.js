$(document).ready(function () {
  $("#productModal").on("hidden.bs.modal", function () {
    $("#submit_button")
      .attr("value", "Add New")
      .attr("onclick", "manageData('addNew')")
      .fadeIn();
  });
//PREPARE ADD BUTTON
  $("#add_order").on("click", function () {
    let table_id = $(this).data("index");
    $("#hidden_table_id").val(table_id);
    $("#hidden_table_name").val($(this).data("table_name"));
    $("#orderModal").modal("show");
    $("#order_form")[0].reset();
    $("#order_form").parsley().reset();
    $("#submit_button").attr("disabled", false);
    $("#submit_button").val("Add");
    let order_id = $(this).data("order_id");
    $("#hidden_order_id").val(order_id);
  });

  getExistingData(0, 50);
});
//DELETE ROW FROM TABLE
function deleteRow(rowID) {
  if (confirm("Are you sure??")) {
    $.ajax({
      url: "manage action/order.php",
      method: "POST",
      dataType: "text",
      data: {
        key: "deleteRow",
        rowID: rowID,
      },
      success: function (response) {
        $("#num_table" + rowID)
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
  $("#order_form").parsley().validate();
  let name = $("#table_name");
  let meal_name = $("#meal_name");
  let meal_num = $("#meal_num");
  let snack_name = $("#snack_name");
  let snack_num = $("#snack_num");
  let drink_name = $("#drink_name");
  let drink_num = $("#drink_num");
  let editRowID = $("#hidden_id");
  if ($("#order_form").parsley().isValid()) {
    $.ajax({
      url: "manage action/order.php",
      method: "POST",
      dataType: "text",
      data: {
        key: key,
        name: name.val(),
        meal_name: meal_name.val(),
        meal_num: meal_num.val(),
        snack_name: snack_name.val(),
        snack_num: snack_num.val(),
        drink_name: drink_name.val(),
        drink_num: drink_num.val(),
        rowID: editRowID.val(),
      },
      success: function (response) {
        $("#orderModal").modal("hide");
        $("#message").html("").fadeIn();

        if (response == "inserted") {
          $("#message")
            .html(
              '<div class="alert alert-success">The Meal Has been Inserted</div>'
            )
            .fadeOut(4000);
        }
      },
    });
  }
}
//GET TABLE DATA
function getExistingData(start, limit) {
  $.ajax({
    url: "manage action/order.php",
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
          order: [
            [8, "desc"],
            [9, "desc"],
          ],
          dom: dom,
          buttons: [
            {
              extend: "excelHtml5",
              title: "Order Report",
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
              },
            },
            {
              extend: "pdfHtml5",
              title: "Order Report",
              orientation: "portrait", //portrait
              pageSize: "A4",
              customize: function (doc) {
                doc.content[1].margin = [50, 0, 50, 0];
              },
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
              },
            },
            {
              extend: "print",
              title: "Order Report",
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
              },
            },
          ],
        });
    },
  });
}
