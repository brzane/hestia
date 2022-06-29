<?php
session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['type'] != 'Cashier' && $_SESSION['type'] != 'Manager') {
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
    <?php $obj->title('Billing'); ?>

    <!-- DataTales Example -->
    <span id="message"></span>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-white">Bill List</h6>
                </div>
                <div class="col" align="right">
                    <button type="button" name="add_bill" id="add_bill" class="btn btn-primary btn-square rounded btn-sm">Add</button>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="billing_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Table Number</th>
                            <th>Waiter</th>
                            <th>Cashier</th>
                            <th>Total Cash</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-white">Loyalty Program</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered loyalty" id="loyalty_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Customer Phone</th>
                            <th>Number Of Visits</th>
                            <th>Discount</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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

<script type="text/javascript" src="assets/js/billing.js">

</script>
</body>

</html>
<?php
function table()
{
    $conn = new mysqli('localhost', 'root', '', 'restaurant_management');
    $sql = $conn->query("SELECT table_name FROM tables where table_status='booked' ");
    while ($data = $sql->fetch_array()) {
        echo '<option value="' . $data['table_name'] . '">' . $data['table_name'] . '</option>';
    }
}

function employee($type)
{
    $conn = new mysqli('localhost', 'root', '', 'restaurant_management');
    $sql = $conn->query("SELECT name FROM employee where type='$type' ");
    while ($data = $sql->fetch_array()) {
        echo '<option value="' . $data['name'] . '">' . $data['name'] . '</option>';
    }
}

?>
<!-- Modal -->
<div id="billingModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="billing_form">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="modal_title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <label>Table <span class="text-danger">*</span></label>
                        <select name="table_name" id="table_name" class="form-control" required data-parsley-trigger="change">
                            <option value="">Select Table</option>
                            <?php table(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cashier <span class="text-danger">*</span></label>
                        <select name="cashier_name" id="cashier_name" class="form-control" required data-parsley-trigger="change">
                            <option value="">Select Cashier</option>
                            <?php employee("Cashier"); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Waiter <span class="text-danger">*</span></label>
                        <select name="cashier_name" id="cashier_name" class="form-control" required data-parsley-trigger="change">
                            <option value="">Select Waiter</option>
                            <?php employee("Waiter"); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Discount | Gift Card <span class="text-danger">*</span></label>
                        <select name="discount" id="discount" class="form-control" required data-parsley-trigger="change">
                            <option value="No">No</option>
                            <option value="yes">Yes</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="button" name="submit" id="submit_button" id="manageBtn" onclick="manageData('addNew')" class="btn btn-success " value="Add" />
                    <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>



<!-- Modal -->
<div id="billingModalView" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="modal_title">View Bill Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h3 style="text-align: center;">Orders
                </h3>
                <div id="orders"></div>
                <span>
                    <h3 style="text-align: center;">The Date
                        <h6 id="date" style="text-align: center;">
                        </h6>
                    </h3>
                </span>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        </form>
    </div>
</div>