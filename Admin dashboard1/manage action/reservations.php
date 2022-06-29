<?php
if (isset($_POST['key'])) {

	$conn = new mysqli('localhost', 'root', '', 'restaurant_management');

	if ($_POST['key'] == 'getRowData') {
		$rowID = $conn->real_escape_string($_POST['rowID']);
		$sql = $conn->query("SELECT * FROM reservations WHERE id='$rowID'");
		$data = $sql->fetch_array();
		$jsonArray = array(
			'personName' => $data['person_name'],
			'personPhone' => $data['person_phone'],
			'personsNumber' => $data['persons_number'],
			'tableNumber' => $data['table_number'],
			'date' => $data['date'],
			'time' => $data['time']

		);

		exit(json_encode($jsonArray));
	}

	if ($_POST['key'] == 'getExistingData') {
		$start = $conn->real_escape_string($_POST['start']);
		$limit = $conn->real_escape_string($_POST['limit']);

		$sql = $conn->query("SELECT * FROM reservations LIMIT $start, $limit");
		if ($sql->num_rows > 0) {
			$response = "";
			while ($data = $sql->fetch_array()) {
				$response .= '
						<tr>
						<td id="res_name' . $data["id"] . '">' . $data["person_name"] . '</td>
							<td id="res_phone' . $data["id"] . '">' . $data["person_phone"] . '</td>
							<td id="res_table' . $data["id"] . '">' . $data["table_number"] . '</td>
							<td id="res_number' . $data["id"] . '">' . $data["persons_number"] . '</td>
							<td id="res_date' . $data["id"] . '">' . $data["date"] . '</td>
							<td id="res_time' . $data["id"] . '">' . $data["time"] . '</td>
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
	if ($_POST['key'] == 'getTableData') {

		$sql = $conn->query("SELECT * FROM tables");
		if ($sql->num_rows > 0) {
			$response = "";
			while ($data = $sql->fetch_array()) {
				$response .= '
				<div class="col-md-2">
				<img src="assets/img/restaurant-table.png"  class="table-icon"
				alt="">
				<h6 class="table-name ">Table ' . $data['table_name'] . '</h6>
				<span class="table-sets">' . $data['capacity'] . ' Sets</span>
				<br>
				<span class=" ' . $data['table_status'] . '">' . $data['table_status'] . '</span>
			</div>
					';
			}
			exit($response);
		}
	}
	$rowID = $conn->real_escape_string($_POST['rowID']);

	if ($_POST['key'] == 'deleteRow') {
		$conn->query("DELETE FROM reservations WHERE id='$rowID'");
		exit('Reservation Has Been Deleted!');
	}

	$name = $conn->real_escape_string($_POST['name']);
	$phone = $conn->real_escape_string($_POST['phone']);
	$sets = $conn->real_escape_string($_POST['sets']);
	$table =  empty($_POST['table']) ? "pending" : $_POST['table'];
	$date = $conn->real_escape_string($_POST['date']);
	$time = $conn->real_escape_string($_POST['time']);

	if ($_POST['key'] == 'updateRow') {
		$x=true;
		if($table !="pending"){
		$sql = $conn->query("SELECT * FROM tables");
		$x=false;
		while ($data = $sql->fetch_array()) {
			if ($data['table_name'] == $table && $data['table_status']=="available")  {
				$conn->query("UPDATE tables SET table_status='booked' WHERE table_name='$table'");
				$x=true;
			}
		}}
		if($x){
		$conn->query("UPDATE reservations SET person_name='$name', person_phone='$phone',table_number='$table', persons_number='$sets' , date='$date',time='$time'  WHERE id='$rowID'");
		exit('edited');}
		else exit('error');
	}

	if ($_POST['key'] == 'addNew') {
		$x=true;
		if($table !="pending"){
		$sql = $conn->query("SELECT * FROM tables");
		$x=false;
		while ($data = $sql->fetch_array()) {
			if ($data['table_name'] == $table && $data['table_status']=="available")  {
				$conn->query("UPDATE tables SET table_status='booked' WHERE table_name='$table'");
				$x=true;
			}
		}}
		if($x){
		$conn->query("INSERT INTO reservations (person_name,person_phone,
			 table_number,persons_number, date,time) 
							VALUES ('$name', '$phone', '$table'
							, '$sets', '$date', '$time')");
		exit('inserted');}
		else exit('error');
	}
}
