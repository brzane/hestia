<?php
$con = new mysqli('localhost', 'root', '', 'restaurant_management');

if (isset($_POST['key'])) {
    /*==================
	RESTAURANT DATA
    ====================*/
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

    /*==================
	TESTIMONIAL DATA
    ====================*/

    if ($_POST['key'] == 'gettestimonialdata') {
        $sql = $con->query(query: "SELECT * FROM testimonial LIMIT 3");
        $jsonArray = array();
        while ($data = $sql->fetch_array()) {
            $jsonArray[] = $data;
        }

        exit(json_encode(array("data" => $jsonArray)));
    }

    /*==================
	ABOUT US DATA
    ====================*/

    if ($_POST['key'] == 'getaboutdata') {
        $sql = $con->query(query: "SELECT * FROM about_us Where id=1");
        $data = $sql->fetch_array();
        $jsonArray = array(
            'about_picture' => $data['about_picture'],
            'theme_color' => $data['theme_color'],
            'about_us' => $data['about_text']
        );
        exit(json_encode($jsonArray));
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
    /*==================
	MENU DATA
    ====================*/
    if ($_POST['key'] == 'getmenudata') {
        $meals = getmenu("meals");
        $snacks = getmenu("snacks");
        $drinks = getmenu("drinks");
        exit(json_encode(array(
            'meals' => $meals,
            'snacks' => $snacks,
            'drinks' => $drinks
        )));
    }
}
   /*==================
	INSERT CONTACT DATA
    ====================*/
if (isset($_POST['name'])) {
    $message = $con->real_escape_string($_POST['message']);
    $name = $con->real_escape_string($_POST['name']);
    $email = $con->real_escape_string($_POST['email']);
    $subject = $con->real_escape_string($_POST['subject']);

    $con->query("INSERT INTO complaint (name, email, subject,message) 
								VALUES ('$name', '$email', '$subject','$message')");
    exit(json_encode(array("data" => "inserted")));
}
   /*==================
	INSERT RESERVATION DATA
    ====================*/
if (isset($_POST['res_date'])) {
    $date = $con->real_escape_string($_POST['res_date']);
    $name = $con->real_escape_string($_POST['res_name']);
    $time = $con->real_escape_string($_POST['res_time']);
    $sets = $con->real_escape_string($_POST['res_sets']);
    $phone = $con->real_escape_string($_POST['res_phone']);
    $table = 'pending';
    $con->query("INSERT INTO reservations (person_name,person_phone,
    table_number,persons_number, date,time) 
                   VALUES ('$name', '$phone', '$table'
                   , '$sets', '$date', '$time')");
    exit(json_encode(array("data" => "inserted")));
}


function getmenu($category)
{
    $con = new mysqli('localhost', 'root', '', 'restaurant_management');
    $sql = $con->query("SELECT * FROM menu WHERE category='$category'");
    if ($sql->num_rows > 0) {
        $response = "";
        while ($data = $sql->fetch_array()) {
            $response .= '
            <div class="col-md-6">
            <div class="media">
              <div class="media-left">
                <a>
                  <img class="media-object" src="' . $data['img'] . '" alt="veggie pizza">
                </a>
              </div>
              <div class="media-body">
                <h4 class="media-heading"><a>' . $data['name'] . '</a></h4>
                <span class="mu-menu-price">$' . $data['price'] . '</span>
                <p>' . $data['description'] . '</p>
              </div>
            </div>
          </div>
                        ';
        }
        return $response;
    } else {
        exit("hi");
    }
}
