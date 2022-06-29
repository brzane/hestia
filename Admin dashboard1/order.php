<?php
session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['type'] != 'Waiter' && $_SESSION['type'] != 'Manager') {
        header('location:403.php');
    }
} else {
    header('location:login.php');
}

require('header.php');
$obj = new board();

?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <br />
    <!-- Page Heading In PHP-->
    <?php $obj->title('Order'); ?>

    <div class="row">
        <div class="col col-sm-12">
            <span id="message"></span>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-white">Order List</h6>
                        </div>
                        <div class="col" align="right">
                            <button type="button" name="add_order" id="add_order" class="btn btn-primary btn-square rounded btn-sm">Add</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class=" table-responsive " id="order_status">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Table's Number</th>
                                    <th>Name Meal</th>
                                    <th>Num meal</th>
                                    <th>Name Drink</th>
                                    <th>Num Drink</th>
                                    <th>Name snack</th>
                                    <th>Num snack</th>
                                    <th>Total Price</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php
require('footer.php');
?>

<script type="text/javascript" src="assets/js/order.js"> </script>



</body>

</html>
<?php
function menu($Category)
{
    $conn = new mysqli('localhost', 'root', '', 'restaurant_management');
    $sql = $conn->query("SELECT name FROM menu Where category = '$Category'");
    while ($data = $sql->fetch_array()) {
        echo '<option value="' . $data['name'] . '">' . $data['name'] . '</option>';
    }
}
function table()
{
    $conn = new mysqli('localhost', 'root', '', 'restaurant_management');
    $sql = $conn->query("SELECT table_name FROM tables where table_status='booked' ");
    while ($data = $sql->fetch_array()) {
        echo '<option value="' . $data['table_name'] . '">' . $data['table_name'] . '</option>';
    }
}

?>

<div id="orderModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="order_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Add Item</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <label>Table Number <span class="text-danger">*</span></label>
                        <select name="table_name" id="table_name" class="form-control" required data-parsley-trigger="change">
                            <option value="">Select Table</option>
                            <?php table(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Meal <span class="text-danger">*</span></label>
                        <select name="meal_name" id="meal_name" class="form-control" required data-parsley-trigger="change">
                            <option value="none">Select Meal</option>
                            <?php menu("meals"); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="meal_num" id="meal_num" class="form-control" required data-parsley-trigger="change">
                            <option value="none">Select Meal Number</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Snack <span class="text-danger">*</span></label>
                        <select name="snack_name" id="snack_name" class="form-control" required data-parsley-trigger="change">
                            <option value="none">Select Snack</option>
                            <?php menu("snacks"); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="snack_num" id="snack_num" class="form-control" required data-parsley-trigger="change">
                            <option value="none">Select snack Number</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label>Drink <span class="text-danger">*</span></label>
                        <select name="drink_name" id="drink_name" class="form-control" required data-parsley-trigger="change">
                            <option value="none">Select Drink</option>
                            <?php menu("drinks"); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="drink_num" id="drink_num" class="form-control" required data-parsley-trigger="change">
                            <option value="none">Number of drink</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_table_id" id="hidden_table_id" />
                    <input type="hidden" name="hidden_order_id" id="hidden_order_id" />
                    <input type="hidden" name="hidden_product_rate" id="hidden_product_rate" />
                    <input type="hidden" name="hidden_table_name" id="hidden_table_name" />
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="button" name="submit" id="submit_button" onclick="manageData('addNew')" class="btn btn-success " value="Add" />
                    <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>