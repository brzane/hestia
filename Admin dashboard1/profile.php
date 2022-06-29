<?php
session_start();
require('header.php');
$obj = new board();
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <br />
    <!-- Page Heading -->
    <?php $obj->title('Profile'); ?>

    <form>
        <div class="row">
            <div class="col-md-12">
                <span id="message"></span>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h6 class="m-0 font-weight-bold text-white ">Profile</h6>
                            </div>
                            <div clas="col" align="right">
                                <input type="hidden" name="action" value="profile" />
                                <button type="submit" name="edit_button" id="edit_button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                &nbsp;&nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--<div class="row">
                                    <div class="col-md-6">!-->
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="user_name" id="user_name" class="form-control" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-maxlength="175" data-parsley-trigger="keyup" />
                        </div>
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" name="user_contact_no" id="user_contact_no" class="form-control" required data-parsley-maxlength="12" data-parsley-type="integer" data-parsley-trigger="keyup" />
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" name="user_email" id="user_email" class="form-control" required data-parsley-maxlength="175" data-parsley-type="email" data-parsley-trigger="keyup" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="user_password" id="user_password" class="form-control" required data-parsley-maxlength="16" data-parsley-trigger="keyup" />
                        </div>

                        <!--</div>
                                </div>!-->
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php
require('footer.php');
?>
<script src="assets/js/profile.js"></script>
</body>

</html>