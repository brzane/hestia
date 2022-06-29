<?php
if (isset($_POST['key'])) {

	$conn = new mysqli('localhost', 'root', '', 'restaurant_management');

	if ($_POST['key'] == 'getRowData') {
		$rowID = $conn->real_escape_string($_POST['rowID']);
		$sql = $conn->query("SELECT id,name,phone,email,password,type FROM user WHERE id='$rowID'");
		$data = $sql->fetch_array();
		$jsonArray = array(
			'name' => $data['name'],
			'phone' => $data['phone'],
			'email' => $data['email'],
			'password' => $data['password'],
			'type' => $data['type'],

		);

		exit(json_encode($jsonArray));
	}

	if ($_POST['key'] == 'getExistingData') {
		$start = $conn->real_escape_string($_POST['start']);
		$limit = $conn->real_escape_string($_POST['limit']);

		$sql = $conn->query("SELECT * FROM user LIMIT $start, $limit");
		if ($sql->num_rows > 0) {
			$response = "";
			while ($data = $sql->fetch_array()) {
				$hash = password_hash($data["password"], PASSWORD_DEFAULT);
				$response .= '
						<tr>
						<td id="user_name' . $data["id"] . '">' . $data["name"] . '</td>
							<td id="user_phone' . $data["id"] . '">' . $data["phone"]  . '</td>
							<td id="user_email' . $data["id"] . '">' . $data["email"] . '</td>
							<td id="user_password' . $data["id"] . '">' . $data["password"] . '</td>
							<td id="user_type' . $data["id"] . '">' . $data["type"] . '</td>
							<td id="user_date' . $data["id"] . '">' . $data["start_date"] . '</td>
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
		$conn->query("DELETE FROM user WHERE id='$rowID'");
		exit('The User Has Been Deleted!');
	}

	$name = $conn->real_escape_string($_POST['name']);
	$phone = $conn->real_escape_string($_POST['phone']);
	$type = $conn->real_escape_string($_POST['type']);
	$email = $conn->real_escape_string($_POST['email']);
	$password = $conn->real_escape_string($_POST['password']);

	if ($_POST['key'] == 'updateRow') {
		$conn->query("UPDATE user SET name='$name', phone='$phone', email='$email' ,type='$type', password='$password' WHERE id='$rowID'");
		exit('edited');
	}

	if ($_POST['key'] == 'addNew') {
		$sql = $conn->query("SELECT id,name,phone,email,password
		,type	 FROM user WHERE name = '$email' ");
		if ($sql->num_rows > 0)
			exit("User With This Name Already Exists!");
		else {
			$conn->query("INSERT INTO user (name,phone,
			email,password,type) 
			VALUES ('$name', '$phone', '$email', '$password'
			, '$type')");
			exit('inserted');
		}
	}
}
