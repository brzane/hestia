<?php
session_start();
//Take the information of session
$con = new mysqli('localhost', 'root', '', 'restaurant_management');

/*==================
	RESTAURANT DATA
====================*/
if (isset($_POST['key'])) {
    if ($_POST['key'] == 'getrestaurantdata') {
        $sql = $con->query(query: "SELECT * FROM restaurant Where id=1");
        $data = $sql->fetch_array();
        $jsonArray = array(
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'from_time' => $data['from_time'],
            'to_time' => $data['to_time'],
            'facebook' => $data['facebook'],
            'twitter' => $data['twitter'],
            'linked_in' => $data['linked_in'],
            'logo' => $data['logo']

        );
        exit(json_encode($jsonArray));
    }
}

if (isset($_POST['restaurant_name'])) {
    $name = $con->real_escape_string($_POST['restaurant_name']);
    $phone = $con->real_escape_string($_POST['restaurant_contact_no']);
    $email = $con->real_escape_string($_POST['restaurant_email']);
    $address = $con->real_escape_string($_POST['restaurant_address']);
    $from_time = $con->real_escape_string($_POST['from-time']);
    $to_time = $con->real_escape_string($_POST['to-time']);
    $facebook = $con->real_escape_string($_POST['facebook-link']);
    $twitter = $con->real_escape_string($_POST['twitter-link']);
    $linked_in = $con->real_escape_string($_POST['linked-in-link']);
    $restaurant_logo = $_POST["hidden_restaurant_logo"];

    if ($_FILES["restaurant_logo"]["name"] != '') {
        $restaurant_logo = upload_image("restaurant_logo", "logo");
    }

    $con->query("UPDATE restaurant SET 
    name='$name',
    phone='$phone',
    email='$email',
    address='$address',
    from_time='$from_time',
    to_time='$to_time',
    facebook='$facebook',
    twitter='$twitter',
    linked_in='$linked_in',
    logo='$restaurant_logo'
    WHERE id = 1");
    exit(json_encode(array('data'=>'info')));
}
/*==================
	TESTIMONIAL DATA
====================*/
if (isset($_POST['key'])) {
    if ($_POST['key'] == 'gettestimonialdata') {
        $sql = $con->query(query: "SELECT * FROM testimonial LIMIT 3");
        $jsonArray = array();
        while ($data = $sql->fetch_array()) {
            $jsonArray[] = $data;
        }

        exit(json_encode(array("data" => $jsonArray)));
    }
}
if (isset($_POST['key'])) {
    if ($_POST['key'] == 'edittestimonial') {
        $name1 = $con->real_escape_string($_POST['name1']);
        $testimonial1 = $con->real_escape_string($_POST['testimonial1']);
        $name2 = $con->real_escape_string($_POST['name2']);
        $testimonial2 = $con->real_escape_string($_POST['testimonial2']);
        $name3 = $con->real_escape_string($_POST['name3']);
        $testimonial3 = $con->real_escape_string($_POST['testimonial3']);
        $query = "UPDATE testimonial SET customer_name='$name1',testimonial='$testimonial1' WHERE id = 1;
                  UPDATE testimonial SET customer_name='$name2',testimonial='$testimonial2' WHERE id = 2;
                  UPDATE testimonial SET customer_name='$name3',testimonial='$testimonial3' WHERE id = 3;
    ";
        $con->multi_query($query);
        exit('testimonial');
    }
}
/*==================
	ABOUT US DATA
====================*/
if (isset($_POST['key'])) {
    if ($_POST['key'] == 'getaboutdata') {
        $sql = $con->query(query: "SELECT * FROM about_us Where id=1");
        $data = $sql->fetch_array();
        $jsonArray = array(
            'about_picture' => $data['about_picture'],
            'about_us' => $data['about_text'],
            'theme_color' => $data['theme_color']
        );
        exit(json_encode($jsonArray));
    }
}

if (isset($_POST['about_us'])) {
    $theme_color = $con->real_escape_string($_POST['theme_color']);
    $about_text = $con->real_escape_string($_POST['about_us']);
    $about_picture = $_POST["hidden_about_us_photo"];
    if ($_FILES["about_us_photo"]["name"] != '') {
        $about_picture = upload_image("about_us_photo", "about-us");
    }

    $con->query("UPDATE about_us SET 
    about_text='$about_text',
    about_picture='$about_picture',
    theme_color='$theme_color'
    WHERE id = 1");
    exit(json_encode(array('data'=>'about_us')));
}


/*==================
	HEADER DATA
====================*/
if (isset($_POST['key'])) {
    if ($_POST['key'] == 'getheaderdata') {
        $sql = $con->query(query: "SELECT * FROM header Where id=1");
        $data = $sql->fetch_array();
        $jsonArray = array(
            'restaurant_slogan' => $data['restaurant_slogan'],
            'photo1' => $data['photo1'],
            'photo2' => $data['photo2'],
            'photo3' => $data['photo3']
        );
        exit(json_encode($jsonArray));
    }
}

if (isset($_POST['restaurant_slogan'])) {
    $slogan = $con->real_escape_string($_POST['restaurant_slogan']);
    $picture1 = $_POST["hidden_header_photo1"];
    $picture2 = $_POST["hidden_header_photo2"];
    $picture3 = $_POST["hidden_header_photo3"];
    if ($_FILES["header_photo1"]["name"] != '') {
        $picture1 = upload_image("header_photo1", "header");
    }
    if ($_FILES["header_photo2"]["name"] != '') {
        $picture2 = upload_image("header_photo2", "header");
    }
    if ($_FILES["header_photo1"]["name"] != '') {
        $picture3 = upload_image("header_photo3", "header");
    }
    $con->query("UPDATE header SET 
    restaurant_slogan='$slogan',
    photo1='$picture1',
    photo2='$picture2',
    photo3='$picture3'
    WHERE id = 1");
    exit(json_encode(array('data'=>'header')));
}
function upload_image($image, $folder)
{
    if (isset($_FILES[$image])) {
        $extension = explode('.', $_FILES[$image]['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = "../../public/assets/img/" . "$folder/" . $new_name;
        $destination1 = "assets/img/" . "$folder/" . $new_name;
        move_uploaded_file($_FILES[$image]['tmp_name'], $destination);
        return $destination1;
    }
}
