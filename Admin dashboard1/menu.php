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
    <?php $obj->title('Menu'); ?>

    <!-- DataTales Example -->
    <span id="message"></span>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-white">Menu List</h6>
                </div>
                <div class="col" align="right">
                    <button type="button" name="add_menu" id="add_product" class="btn btn-primary btn-square rounded btn-sm">Add</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="product_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Meal Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Description</th>
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
<script type="text/javascript" src="assets/js/menu.js"></script>
</body>

</html>



<!-- Modal -->
<div id="productModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="product_form">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="modal_title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <label>Category </label><span class="text-danger">*</span>
                        <select name="category_name" id="category_name" class="form-control" required data-parsley-trigger="change">
                            <option value="">Select Category</option>
                            <option value="meals">Meals</option>
                            <option value="snacks">Snacks</option>
                            <option value="drinks">Drinks</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="modal-title">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="product_name" id="product_name" class="form-control" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-trigger="keyup" />
                    </div>

                    <div class="form-group">
                        <label>Product Price <span class="text-danger">*</span></label>
                        <input type="text" name="product_price" id="product_price" class="form-control" required data-parsley-type="integer" data-parsley-trigger="keyup" />
                    </div>

                    <div class="form-group">
                        <label>Product Description <span class="text-danger">*</span></label>
                        <textarea name="product_description" cols="30" rows="4" id="product_description" class="form-control" required data-parsley-trigger="keyup"></textarea>
                    </div>
                    <div class="form-group mb-0">
                        <label>Select Image <span class="text-danger">*</span></label><br id="image-input" />
                        <input type="file" name="product_image" id="product_image" required />
                        <br />
                        <span class="text-muted">Only .jpg, .png file allowed for upload</span><br />

                        <span id="uploaded_image"></span>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="add" />
                    <input type="button" name="submit" id="submit_button" id="manageBtn" onclick="manageData('addNew')" class="btn btn-success " value="Add" />
                    <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>