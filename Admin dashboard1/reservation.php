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
    <?php $obj->title('Reservation'); ?>

    <!-- DataTales Example -->
    <span id="message"></span>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-white ">Reservation List</h6>
                </div>
                <div class="col" align="right">
                    <button type="button" name="add_reservation" id="add_reservation" class="btn btn-primary btn-square rounded btn-sm">Add</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="reservation_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Table's Number</th>
                            <th>Persons Number</th>
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
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 text-center  font-weight-bold text-white ">Table Status</h6>
            </div>
            <div class="card-body">
                <div class="row ml-4" id="table-status">

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


<script type="text/javascript" src="assets/js/reservation.js"></script>
</body>

</html>

<!-- Modal -->
<div id="reservationModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="reservation_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="person_name" id="person_name" class="form-control" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-trigger="keyup" />
                    </div>
                    <div class="form-group">
                        <label>Phone Number <span class="text-danger">*</span></label>
                        <input type="text" name="person_phone" id="person_phone" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" class="form-control" data-parsley-trigger="keyup" />
                    </div>
                    <div class="form-group">
                        <label>Table Number</label>
                        <input type="text" name="table_number" id="table_number"  data-parsley-type="integer" data-parsley-minlength="1" data-parsley-maxlength="12" class="form-control" data-parsley-trigger="keyup" />
                    </div>

                    <div class="form-group">
                        <label>Sets <span class="text-danger">*</span></label>
                        <select name="person_number" id="person_number" class="form-control" required data-parsley-trigger="change">
                            <option value="">Select number</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date <span class="text-danger">*</span></label>
                        <input type="text" name="date" class="form-control" id="datepicker" placeholder="Date" required >
                    </div>
                    <div class="form-group">
                        <label>Time <span class="text-danger">*</span></label>
                        <input type="text" name="time" id="timepicker" required class="form-control timepicker" data-parsley-trigger="keyup" />
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