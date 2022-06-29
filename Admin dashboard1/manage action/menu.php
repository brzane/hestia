<?php
$conn = new mysqli('localhost', 'root', '', 'restaurant_management');
if (isset($_POST['key'])) {
	if ($_POST['key'] == 'getRowData') {
		$rowID = $conn->real_escape_string($_POST['rowID']);
		$sql = $conn->query("SELECT * FROM menu WHERE id='$rowID'");
		$data = $sql->fetch_array();
		$jsonArray = array(
			'name' => $data['name'],
			'price' => $data['price'],
			'category' => $data['category'],
			'description' => $data['description'],
			'img' => $data['img']
		);

		exit(json_encode($jsonArray));
	}

	if ($_POST['key'] == 'getExistingData') {
		$start = $conn->real_escape_string($_POST['start']);
		$limit = $conn->real_escape_string($_POST['limit']);

		$sql = $conn->query("SELECT * FROM menu LIMIT $start, $limit");
		if ($sql->num_rows > 0) {
			$response = "";
			while ($data = $sql->fetch_array()) {
				$response .= '
							<tr>
							    <td id="meal_name' . $data["id"] . '">' . $data["name"] . '</td>
								<td id="meal_price' . $data["id"] . '">' . $data["price"] . ' $' . '</td>
								<td id="meal_category' . $data["id"] . '">' . $data["category"] . '</td>
								<td id="meal_description' . $data["id"] . '">Click on Edit to View</td>
								<td>
									<input type="button" onclick="edit(' . $data["id"] . ')" value="Edit" class="btn btn-primary">
									<input type="button" onclick="deleteRow(' . $data["id"] . ')" value="Delete" class="btn btn-danger">
								</td>
							</tr>
						';
			}
			exit($response);
		} else
			exit('reachedMax');
	}

	$rowID = $conn->real_escape_string($_POST['rowID']);

	if ($_POST['key'] == 'deleteRow') {
		$conn->query("DELETE FROM menu WHERE id='$rowID'");
		exit('The Row Has Been Deleted!');
	}
}
if (isset($_POST['action'])) {
	// $image = $_POST["hidden_product_image"];
	// if ($_FILES["product_image"]["name"] != '') {
	$image = upload_image("product_image");
	// }
	$description = $conn->real_escape_string($_POST['product_description']);
	$name = $conn->real_escape_string($_POST['product_name']);
	$price = $conn->real_escape_string($_POST['product_price']);
	$category = $conn->real_escape_string($_POST['category_name']);
	if ($_POST['action'] == "Add") {
		$sql = $conn->query("SELECT id,name,price,category FROM menu WHERE name = '$name'");
		if ($sql->num_rows > 0)
		exit(json_encode(array("data"=>"already exist")));
		else {
			
			$conn->query("INSERT INTO menu (name, price, category,img,description) 
								VALUES ('$name', '$price', '$category','$image','$description')");
			exit(json_encode(array("data"=>"inserted")));
		}
	}
	
	if ($_POST['action'] == 'edit') {
		$rowID = $conn->real_escape_string($_POST['hidden_id']);
		$conn->query("UPDATE menu SET name='$name', price='$price', category='$category',description='$description' WHERE id='$rowID'");
		exit(json_encode(array("data"=>"edited")));
	}
}

function upload_image($image)
{
	if (isset($_FILES[$image])) {
		$extension = explode('.', $_FILES[$image]['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = "../../public/assets/img/menu/" . $new_name;
		$destination1 = "assets/img/menu/"  . $new_name;
		move_uploaded_file($_FILES[$image]['tmp_name'], $destination);
		return $destination1;
	}
}
