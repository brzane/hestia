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
    <?php $obj->title('Table'); ?>

    <!-- DataTales Example -->
    <span id="message"></span>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-white ">Table List</h6>
                </div>
                <div class="col" align="right">
                    <button type="button" name="add_table" id="add_table" class="btn btn-square rounded btn-sm btn-primary">Add</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_data" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Table Number</th>
                            <th>Table Capacity</th>
                            <th>Status</th>
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php
require('footer.php');
?>
<script type="text/javascript" src="assets/js/table.js"></script>
</body>

</html>
<div id="tableModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="table_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <label>Table Number <span class="text-danger">*</span></label>
                        <input type="text" name="table_name" id="table_name" class="form-control" required data-parsley-type="integer" data-parsley-minlength="1" data-parsley-maxlength="4" data-parsley-trigger="keyup" />
                    </div>
                    <div class="form-group">
                        <label>Table Capacity <span class="text-danger">*</span></label>
                        <select name="table_capacity" id="table_capacity" class="form-control" required data-parsley-trigger="change">
                            <option value="">Select Table Capacity</option>
                            <option value="1">1 Person</option>
                            <option value="2">2 Person</option>
                            <option value="3">3 Person</option>
                            <option value="4">4 Person</option>
                            <option value="5">5 Person</option>
                            <option value="6">6 Person</option>
                            <option value="7">7 Person</option>
                            <option value="8">8 Person</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Table Capacity <span class="text-danger">*</span></label>
                        <select name="table_capacity" id="table_status" class="form-control" required data-parsley-trigger="change">
                            <option value="">Status</option>
                            <option value="booked">Booked</option>
                            <option value="available">Available</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="button" name="submit" id="submit_button" class="btn btn-success " value="Add" onclick="manageData('addNew');" />
                    <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>