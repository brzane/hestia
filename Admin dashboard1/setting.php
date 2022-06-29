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
    <!-- Page Heading -->
    <?php $obj->title('Setting'); ?>


    <div class="row">
        <div class="col-md-6">
            <span id="message_info"></span>
            <form method="post" id="restaurant_form" enctype="multipart/form-data" autocomplete="off">
                <div class="card shadow mb-4 ">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col">
                                <h6 class="m-0 font-weight-bold text-white ">Restuarant info</h6>
                            </div>
                            <div clas="col" align="right">
                                <button type="submit" name="edit_restaurant" id="edit_restaurant" class="btn btn-primary  btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                &nbsp;&nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Restaurant Name</label>
                                    <input type="text-area" name="restaurant_name" id="restaurant_name" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Restaurant Email</label>
                                    <input type="text" name="restaurant_email" id="restaurant_email" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Restaurant Contact No.</label>
                                    <input type="text" name="restaurant_contact_no" id="restaurant_contact_no" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Restaurant Address</label>
                                    <input type="text" name="restaurant_address" id="restaurant_address" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <strong><label>Opening Hours</label></strong>
                                    <br>
                                    <label>From</label>
                                    <select class="form-control  show-tick" title="What Time ?" required="required" id="from-time" name="from-time">
                                        <option value="10:00 AM">10:00 AM</option>
                                        <option value="12:00 AM">12:00 AM</option>
                                        <option value="2:00 PM">2:00 PM</option>
                                        <option value="4:00 PM">4:00 PM</option>
                                        <option value="6:00 PM">6:00 PM</option>
                                        <option value="8:00 PM">8:00 PM</option>
                                        <option value="10:00 PM">10:00 PM</option>
                                    </select>
                                    <label>To</label>
                                    <select class="form-control select-picker show-tick" title="What Time ?" required="required" id="to-time" name="to-time">
                                        <option value="10:00 AM">10:00 AM</option>
                                        <option value="12:00 AM">12:00 AM</option>
                                        <option value="2:00 PM">2:00 PM</option>
                                        <option value="4:00 PM">4:00 PM</option>
                                        <option value="6:00 PM">6:00 PM</option>
                                        <option value="8:00 PM">8:00 PM</option>
                                        <option value="10:00 PM">10:00 PM</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <strong><label>Social Links</label></strong>
                                    <br>
                                    <label class="mt-1">Facebook</label>
                                    <input type="text" name="facebook-link" id="facebook-link" class="form-control" />

                                    <label class="mt-2">Twitter</label>
                                    <input type="text" name="twitter-link" id="twitter-link" class="form-control" />

                                    <label class="mt-2">Linked-in</label>
                                    <input type="text" name="linked-in-link" id="linked-in-link" class="form-control" />
                                </div>
                                <div class="form-group mb-0">
                                    <label>Select Logo</label><br />
                                    <input type="file" name="restaurant_logo" id="restaurant_logo" />
                                    <br />
                                    <span class="text-muted">Only .jpg, .png file allowed for upload</span><br />

                                    <span id="uploaded_logo"></span>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <span id="message_testimonial"></span>
            <form method="post" id="setting_form" enctype="multipart/form-data" autocomplete="off">
                <div class="card shadow mb-4 ">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col">
                                <h6 class="m-0 font-weight-bold text-white ">Testimonials</h6>
                            </div>
                            <div clas="col" align="right">
                                <button type="submit" name="edit_testimonial" id="edit_testimonial" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                &nbsp;&nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" name="customer_name1" id="customer_name1" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Customer Testimonial </label>
                                    <textarea name="customer_testimonial1" id="customer_testimonial1" cols="3" rows="6" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" name="customer_name2" id="customer_name2" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Customer Testimonial </label>
                                    <textarea name="customer_testimonial2" id="customer_testimonial2" cols="3" rows="6" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" name="customer_name3" id="customer_name3" class="form-control" />
                                </div>
                                <div class="form-group mb-2">
                                    <label>Customer Testimonial </label>
                                    <textarea name="customer_testimonial3" id="customer_testimonial3" cols="3" rows="5" class="form-control"></textarea>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <span id="message_about_us"></span>
            <form method="post" id="about_us_form" enctype="multipart/form-data" autocomplete="off">
                <div class="card shadow mb-4 ">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col">
                                <h6 class="m-0 font-weight-bold text-white ">About Us</h6>
                            </div>
                            <div clas="col" align="right">
                                <button type="submit" name="edit_about" id="edit_about" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                &nbsp;&nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong><label>Website Theme</label></strong>
                                    <br>
                                    <select class="form-control  show-tick" required="required" id="theme_color" name="theme_color">
                                        <option value="default">default</option>
                                        <option value="blue">blue</option>
                                        <option value="dark-red">dark-red</option>
                                        <option value="pink">pink</option>
                                        <option value="green">green</option>
                                        <option value="yellow">yellow</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>About Us </label>
                                    <textarea name="about_us" id="about_us" cols="3" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group ">
                                    <label>Select Picture</label><br />
                                    <input type="file" name="about_us_photo" id="about_us_photo" value="" />
                                    <br />
                                    <span class="text-muted">Only .jpg, .png file allowed for upload</span><br />
                                    <span id="uploaded_about_us">

                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <span id="message_header"></span>
            <form method="post" id="header_form" enctype="multipart/form-data" autocomplete="off">
                <div class="card shadow mb-4 ">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col">
                                <h6 class="m-0 font-weight-bold text-white ">Header</h6>
                            </div>
                            <div clas="col" align="right">
                                <button type="submit" name="edit_header" id="edit_header" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                &nbsp;&nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Resturant Slogan</label>
                                    <input type="text" name="restaurant_slogan" id="restaurant_slogan" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Select Main Picture</label><br />
                                    <input type="file" name="header_photo1" id="header_photo1" />
                                    <br />
                                    <span class="text-muted">Only .jpg, .png file allowed for upload</span><br />
                                    <span id="uploaded_photo1"></span>
                                </div>
                                <div class="form-group">
                                    <label>Select 2nd Picture</label><br />
                                    <input type="file" name="header_photo2" id="header_photo2" />
                                    <br />
                                    <span class="text-muted">Only .jpg, .png file allowed for upload</span><br />
                                    <span id="uploaded_photo2"></span>
                                </div>
                                <div class="form-group">
                                    <label>Select 3nd Picture</label><br />
                                    <input type="file" name="header_photo3" id="header_photo3" />
                                    <br />
                                    <span class="text-muted">Only .jpg, .png file allowed for upload</span><br />
                                    <span id="uploaded_photo3"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php
require('footer.php');
?>
<script src="assets/js/setting.js"></script>

</body>

</html>