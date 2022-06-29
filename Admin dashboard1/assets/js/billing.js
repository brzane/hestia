$(document).ready(function () {
  $("#productModal").on("hidden.bs.modal", function () {
    $("#submit_button")
      .attr("value", "Add New")
      .attr("onclick", "manageData('addNew')")
      .fadeIn();
  });

  getExistingData(0, 50);
  getLoyaltyData(0, 50);
  //PREPARE ADD BUTTON
  $("#add_bill").click(function () {
    $("#billing_form")[0].reset();

    $("#billing_form").parsley().reset();

    $("#modal_title").text("Add Data");

    $("#action").val("Add");

    $("#submit_button").val("Add");

    $("#billingModal").modal("show");

    $("#form_message").html("");
  });
});
//DELETE ROW FROM THE TABLE
function deleteRow(rowID) {
  if (confirm("Are you sure??")) {
    $.ajax({
      url: "manage action/bills.php",
      method: "POST",
      dataType: "text",
      data: {
        key: "deleteRow",
        rowID: rowID,
      },
      success: function (response) {
        $("#table_number" + rowID)
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
//ADD|EDIT ROW FROM THE TABLE
function manageData(key) {
  $("#billing_form").parsley().validate();
  let name = $("#table_name");
  let cashier = $("#cashier_name");
  let waiter = $("#waiter_name");
  let discount = $("#discount");
  let editRowID = $("#hidden_id");
  if ($("#billing_form").parsley().isValid()) {
    $.ajax({
      url: "manage action/bills.php",
      method: "POST",
      dataType: "text",
      data: {
        key: key,
        name: name.val(),
        cashier: cashier.val(),
        waiter: waiter.val(),
        discount: discount.val(),
        rowID: editRowID.val(),
      },
      success: function (response) {
        $("#billingModal").modal("hide");
        $("#message").html("").fadeIn();
        console.log(response);
        if (response == "inserted") {
          $("#message")
            .html(
              '<div class="alert alert-success">The Bill Has been Paid</div>'
            )
            .fadeOut(4000);
         
        }
      },
    });
  }
}
//VIEW ROW INFO
function view(rowID) {
  $("#billingModalView").modal("show");
  $.ajax({
    url: "manage action/bills.php",
    method: "POST",
    dataType: "json",
    data: {
      key: "getRowData",
      rowID: rowID,
    },
    success: function (response) {
      console.log("success");
      $("#orders").html(response.orders);
      $("#date").html(response.date);
      $("#orders").append(response.totalCash);
    },
  });
}
//GET TABLE DATA 
function getExistingData(start, limit) {
  $.ajax({
    url: "manage action/bills.php",
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
        $("#billing_table tbody").append(response);
        start += limit;
        getExistingData(start, limit);
      } else
        $("#billing_table").DataTable({
          order: [[4, "desc"]],
          dom: dom,
          buttons: [
            {
              extend: "excelHtml5",
              title: "Billing Report",
              exportOptions: {
                columns: [0, 1, 2, 3,4],
              },
            },
            {
              extend: "pdfHtml5",
              title: "Billing Report",
              orientation: "portrait", //portrait
              pageSize: "A4",
              customize: function (doc) {
                doc.content[1].margin = [100, 0, 100, 0];
              },
              exportOptions: {
                columns: [0, 1, 2, 3,4],
              },
            },
            {
              extend: "print",
              title: "Billing Report",
              exportOptions: {
                columns: [0, 1, 2, 3,4],
              },
            },
          ],
        });
    },
  });
}
// GET LOYALTY TABLE DATA
function getLoyaltyData(start, limit) {
  let dom =
    "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
  $.ajax({
    url: "manage action/bills.php",
    method: "POST",
    dataType: "text",
    data: {
      key: "getLoyaltyData",
      start: start,
      limit: limit,
    },
    success: function (response) {
      $("#loyalty_table tbody").append(response);
      $("#loyalty_table").DataTable({
        dom: dom,
      });
    },
  });
}
