<?php
if (isset($_POST['key'])) {

	$conn = new mysqli('localhost', 'root', '', 'restaurant_management');

	if ($_POST['key'] == 'getRowData') {
		$rowID = $conn->real_escape_string($_POST['rowID']);
		$sql = $conn->query("SELECT id,table_name,capacity,table_status  FROM tables WHERE id='$rowID'");
		$data = $sql->fetch_array();
		$jsonArray = array(
			'tableName' => $data['table_name'],
			'capacity' => $data['capacity'],
			'status' => $data['table_status']
		);

		exit(json_encode($jsonArray));
	}

	if ($_POST['key'] == 'getExistingData') {
		$start = $conn->real_escape_string($_POST['start']);
		$limit = $conn->real_escape_string($_POST['limit']);

		$sql = $conn->query("SELECT * FROM tables LIMIT $start, $limit");
		if ($sql->num_rows > 0) {
			$response = "";
			while ($data = $sql->fetch_array()) {
				$response .= '
						<tr>
						<td id="table_name' . $data["id"] . '">' . $data["table_name"] . '</td>
							<td id="table_capacity' . $data["id"] . '">' . $data["capacity"] . '</td>
							<td id="table_status' . $data["id"] . '">' . $data["table_status"] . '</td>
							<td>
								<input type="button" onclick="edit(' . $data["id"] . ')" value="Edit" class="btn btn-primary">
								<input type="button" onclick="deleteRow(' . $data["id"] . ')" value="Cancel it" class="btn btn-danger">
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
		$conn->query("DELETE FROM tables WHERE id='$rowID'");
		exit(' The Table has been Deleted');
	}

	$name = $conn->real_escape_string($_POST['name']);
	$capacity = $conn->real_escape_string($_POST['capacity']);
	$status = $conn->real_escape_string($_POST['status']);

	if ($_POST['key'] == 'updateRow') {
		$conn->query("UPDATE tables SET table_name='$name', capacity='$capacity', table_status='$status' WHERE id='$rowID'");
		exit('edited');
	}

	if ($_POST['key'] == 'addNew') {
		$sql = $conn->query("SELECT * FROM tables WHERE table_name = '$name'");
		if ($sql->num_rows > 0)
			exit("Table With This Name Already Taken!");
		else {
			$conn->query("INSERT INTO tables (table_name, capacity,
			 table_status) 
							VALUES ('$name', '$capacity', '$status')");
			exit('inserted');
		}
	}
}
