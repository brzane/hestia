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
    <?php $obj->title('Complaints'); ?>

    <!-- DataTales Example -->
    <span id="message"></span>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-white">Complaint List</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="complaint_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Subject</th>
                            <th>Message</th>
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
<script type="text/javascript" src="assets/js/complaint.js"></script>
</body>

</html>



<!-- Modal -->
<div id="complaintModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="product_form">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="modal_title">View Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <label class="modal-title">Customer Name</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control" data-parsley-trigger="keyup" />
                    </div>
                    <div class="form-group">
                        <label class="modal-title">Product Name</label>
                        <input type="text" name="customer_email" id="customer_email" class="form-control" data-parsley-trigger="keyup" />
                    </div>

                    <!--required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" -->
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="customer_subject" id="customer_subject" class="form-control" data-parsley-trigger="keyup" />
                    </div>
                    <!-- 
                        required data-parsley-pattern="^[0-9]*\.[0-9]{2}$" -->
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="customer_message" id="customer_message" class="form-control" cols="30" rows="6"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>