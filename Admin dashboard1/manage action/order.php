<?php
if (isset($_POST['key'])) {

	$conn = new mysqli('localhost', 'root', '', 'restaurant_management');

	function num()
	{
		$x = 0;
		$conn = new mysqli('localhost', 'root', '', 'restaurant_management');
		$sql = $conn->query("SELECT * FROM menu");
		while ($data = $sql->fetch_array()) {
			if ($data['name'] == $_POST['meal_name']) {
				$x += ($data['price'] * $_POST['meal_num']);
			}
			if ($data['name'] == $_POST['snack_name']) {
				$x += ($data['price'] * $_POST['snack_num']);
			}
			if ($data['name'] == $_POST['drink_name']) {
				$x += ($data['price'] * $_POST['drink_num']);
			}
		}
		return $x;
	}

	if ($_POST['key'] == 'getExistingData') {
		$start = $conn->real_escape_string($_POST['start']);
		$limit = $conn->real_escape_string($_POST['limit']);

		$sql = $conn->query("SELECT * FROM orders LIMIT $start, $limit");
		if ($sql->num_rows > 0) {
			$response = "";
			while ($data = $sql->fetch_array()) {
				$response .= '
						<tr>
						<td id="num_table' . $data["id"] . '">' . $data["num_table"] . '</td>
							<td id="mealname' . $data["id"] . '">' . $data["mealname"]  . '</td>
							<td id="numMeal' . $data["id"] . '">' . $data["numMeal"] . '</td>
							<td id="name_drink' . $data["id"] . '">' . $data["name_drink"] . '</td>
							<td id="num_drink' . $data["id"] . '">' . $data["num_drink"]  . '</td>
					 		<td id="name_snack' . $data["id"] . '">' . $data["name_snack"] . '</td>
							<td id="num_snack' . $data["id"] . '">' . $data["num_snack"] . '</td>
							<td id="totalprice' . $data["id"] . '">' . $data["totalprice"] . '</td>
							<td id="date	' . $data["id"] . '">' . $data["date"]  . '</td>
							<td id="time	' . $data["id"] . '">' . $data["time"]  . '</td>
							<td>
								<input type="button" onclick="deleteRow(' . $data["id"] . ')" value="Delete" class="btn btn-danger">
							</td>
						</tr>
					';
			}
			exit($response);
		} else
			exit('reachedMax');
	}




	if ($_POST['key'] == 'deleteRow') {
		$rowID = $conn->real_escape_string($_POST['rowID']);
		$conn->query("DELETE FROM orders WHERE id='$rowID'");
		exit('The Order Has Been Deleted!');
	}

	if ($_POST['key'] == 'addNew') {
		$name = $conn->real_escape_string($_POST['name']);
		$name_food = $conn->real_escape_string($_POST['meal_name']);
		$num_food = $conn->real_escape_string($_POST['meal_num']);
		$name_snack = $conn->real_escape_string($_POST['snack_name']);
		$num_snack = $conn->real_escape_string($_POST['snack_num']);
		$name_drink = $conn->real_escape_string($_POST['drink_name']);
		$num_drink = $conn->real_escape_string($_POST['drink_num']);
		$total_price = num();

		$status = 'no';
		if (
			$_POST['meal_num'] == 'none' && $_POST['snack_num'] == 'none'
			&& $_POST['drink_num'] == 'none'
		)
			exit('Please Order Something');
		$conn->query("INSERT INTO orders (num_table,mealname,name_snack
			,name_drink,status,numMeal,num_snack,num_drink,totalprice) 
			VALUES ('$name', '$name_food', '$name_snack', '$name_drink','$status'
			, '$num_food', '$num_snack', '$num_drink', '$total_price')");
		exit('inserted');
	}
}
