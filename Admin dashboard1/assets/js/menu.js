$(document).ready(function () {
  $("#productModal").on("hidden.bs.modal", function () {
    $("#submit_button")
      .attr("value", "Add New")
      .attr("onclick", "manageData('addNew')")
      .fadeIn();
  });
  //PREPARE ADD BUTTON
  $("#add_product").click(function () {
    $("#product_form")[0].reset();

    $("#product_form").parsley().reset();

    $("#modal_title").text("Add Data");

    $("#action").val("Add");

    $("#submit_button").val("Add");

    $("#productModal").modal("show");

    $("#form_message").html("");
  });

  getExistingData(0, 50);
});
//DELETE ROW FROM TABLE
function deleteRow(rowID) {
  if (confirm("Are you sure??")) {
    $.ajax({
      url: "manage action/menu.php",
      method: "POST",
      dataType: "text",
      data: {
        key: "deleteRow",
        rowID: rowID,
      },
      success: function (response) {
        $("#meal_name" + rowID)
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
  $("#product_form").parsley().validate();
  let rowID = $("#hidden_id");
  let name = $("#product_name");
  let category = $("#product_category");
  let price = $("#product_price");
  let description = $("#product_description");
  let form = $("#product_form")[0];
  if ($("#product_form").parsley().isValid()) {
    $.ajax({
      url: "manage action/menu.php",
      method: "POST",
      data: new FormData(form),
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (response) {
        $("#productModal").modal("hide");
        $("#message").html("").fadeIn();
        console.log(response);

        if (response.data == "inserted") {
          $("#message")
            .html(
              '<div class="alert alert-success">The Meal Has been Inserted</div>'
            )
            .fadeOut(4000);
        } else if (response.data == "edited") {
          $("#meal_name" + rowID.val()).html(name.val());
          $("#meal_price" + rowID.val()).html(category.val());
          $("#meal_category" + rowID.val()).html(price.val());
          $("#meal_description" + rowID.val()).html(description.val());
          $("#message")
            .html(
              '<div class="alert alert-success">The Meal Has been Edited</div>'
            )
            .fadeOut(4000);
        } else {
          $("#message")
            .html(
              '<div id="res" class="alert alert-danger">Meal is Alredy Exists</div>'
            )
            .fadeOut(4000);
        }
      },
    });
  }
}
//GET ROW DATA
function edit(rowID) {
  $("#product_form").parsley().reset();
  $.ajax({
    url: "manage action/menu.php",
    method: "POST",
    dataType: "json",
    data: {
      key: "getRowData",
      rowID: rowID,
    },
    success: function (response) {
      $("#productModal").modal("show");
      $("#product_price").val(response.price);
      $("#category_name").val(response.category);
      $("#product_name").val(response.name);
      $("#product_description").val(response.description);
      $("#hidden_id").val(rowID);
      $("#uploaded_image").html(
        '<input type="hidden" name="hidden_product_image" value="' +
          response.img +
          '" />'
      );
      $("#action").val("edit");
      $("#submit_button").val("Save Changes");
      $("#submit_button").attr("onclick", "manageData('updateRow')");
    },
  });
}
//GET TABLE DATA
function getExistingData(start, limit) {
  $.ajax({
    url: "manage action/menu.php",
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
              title: "Menu Report",
              exportOptions: {
                columns: [0, 1, 2],
              },
            },
            {
              extend: "pdfHtml5",
              title: "Menu Report",
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
              title: "Menu Report",
              exportOptions: {
                columns: [0, 1, 2],
              },
            },
          ],
        });
    },
  });
}
