<?php
if (isset($_POST['key'])) {

	$conn = new mysqli('localhost', 'root', '', 'restaurant_management');

	if ($_POST['key'] == 'getRowData') {
		$rowID = $conn->real_escape_string($_POST['rowID']);
		$sql = $conn->query("SELECT * FROM complaint WHERE id='$rowID'");
		$data = $sql->fetch_array();
		$jsonArray = array(
			'name' => $data['name'],
			'email' => $data['email'],
			'subject' => $data['subject'],
			'message' => $data['message']
		);

		exit(json_encode($jsonArray));
	}

	if ($_POST['key'] == 'getExistingData') {
		$start = $conn->real_escape_string($_POST['start']);
		$limit = $conn->real_escape_string($_POST['limit']);

		$sql = $conn->query("SELECT * FROM complaint LIMIT $start, $limit");
		if ($sql->num_rows > 0) {
			$response = "";
			while ($data = $sql->fetch_array()) {
				$response .= '
						<tr>
						<td id="name' . $data["id"] . '">' . $data["name"] . '</td>
							<td id="email' . $data["id"] . '">' . $data["email"] .  '</td>
							<td id="subject' . $data["id"] . '">' . $data["subject"] . '</td>
							<td id="message'  . $data["id"] . '">Click on View to display</td>
							<td>
								<input type="button" onclick="view(' . $data["id"] . ')" value="View" class="btn btn-primary">
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
		$conn->query("DELETE FROM complaint WHERE id='$rowID'");
		exit('Complaint Has Been Deleted!');
	}
}

