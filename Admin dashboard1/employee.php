<?php
session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['type'] != 'Manager') {
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
    <?php $obj->title('Employee'); ?>

    <!-- DataTales Example -->
    <span id="message"></span>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-white">Employee List</h6>
                </div>
                <div class="col" align="right">
                    <button type="button" name="add_employee" id="add_employee" class="btn btn-primary btn-square rounded btn-sm">Add</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="employee_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>SSN</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Salary</th>
                            <th>Start Date</th>
                            <th>Action</th>
                        </tr>

                    </thead>
                    <tbody class="employee">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-white">Sales Bounus</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="sales_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>His Job</th>
                            <th>Number of Bills</th>
                            <th>Sales</th>
                        </tr>

                    </thead>
                    <tbody  class="sales">

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
<script type="text/javascript" src="assets/js/employee.js"></script>
</body>

</html>



<!-- Modal -->
<div id="employeeModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="employee_form">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="modal_title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <label class="modal-title">Employee Ssn <span class="text-danger">*</span></label>
                        <input type="text" name="employee_ssn" id="employee_ssn" class="form-control" required data-parsley-type="integer" data-parsley-minlength="6" data-parsley-maxlength="20" data-parsley-trigger="keyup" />
                    </div>
                    <div class="form-group">
                        <label class="modal-title">Employee Name <span class="text-danger">*</span></label>
                        <input type="text" name="employee_name" id="employee_name" class="form-control" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-trigger="keyup" />
                    </div>
                    <div class="form-group">
                        <label class="modal-title">Employee Phone <span class="text-danger">*</span></label>
                        <input type="text" name="employee_phone" id="employee_phone" class="form-control" data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" required data-parsley-trigger="keyup" />
                    </div>
                    <div class="form-group">
                        <label>Type <span class="text-danger">*</span></label>
                        <select name="employee_type" id="employee_type" class="form-control" required data-parsley-trigger="change">
                            <option value="">Select Type</option>
                            <option value="waiter">Waiter</option>
                            <option value="cashier">Cashier</option>
                            <option value="cheif">Cheif</option>
                            <option value="co-cheif">Co-cheif</option>
                            <option value="cleaning">Cleaning</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Salary <span class="text-danger">*</span></label>
                        <input type="text" name="employee_salary" id="employee_salary" class="form-control" required data-parsley-pattern="/^[0-9 \s]+$/" data-parsley-trigger="keyup" />
                    </div>
                    <!-- 
                        required data-parsley-pattern="^[0-9]*\.[0-9]{2}$" -->

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