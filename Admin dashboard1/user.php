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
    <?php $obj->title('User'); ?>

    <!-- DataTales Example -->
    <span id="message"></span>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-white">User List</h6>
                </div>
                <div class="col" align="right">
                    <button type="button" name="add_user" id="add_user" class="btn btn-primary btn-square  rounded btn-sm">Add</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="user_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>User Contact No.</th>
                            <th>User Email</th>
                            <th>Password</th>
                            <th>User Type</th>
                            <th>Created On</th>
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

<script type="text/javascript" src="assets/js/user.js"></script>
</body>

</html>

<!-- Modal -->
<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">User Name <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="user_name" id="user_name" class="form-control" required data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">User Contact No. <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="user_contact_no" id="user_contact_no" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">User Email <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="user_email" id="user_email" autocomplete="off" class="form-control" required data-parsley-type="email" data-parsley-maxlength="150" data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">User Password <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="password" name="user_password" id="user_password" class="form-control" required data-parsley-minlength="6" data-parsley-maxlength="16" data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">User Type <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select name="user_type" id="user_type" class="form-control" required data-parsley-trigger="change">
                                    <option value="">Select Type</option>
                                    <option value="Manager">Admin</option>
                                    <option value="Waiter">Waiter</option>
                                    <option value="Cashier">Cashier</option>
                                </select>
                            </div>
                        </div>
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