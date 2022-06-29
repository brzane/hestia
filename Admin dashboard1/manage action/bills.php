<?php
if (isset($_POST['key'])) {

	$conn = new mysqli('localhost', 'root', '', 'restaurant_management');

	if ($_POST['key'] == 'getRowData') {
		$rowID = $conn->real_escape_string($_POST['rowID']);
		$sql = $conn->query("SELECT * FROM bills WHERE id='$rowID'");
		$data = $sql->fetch_array();
		$table_num = $data['table_number'];
		$arr = explode(":", $data['orders']);
		$orders = '';
		foreach ($arr as $t) {
			$sql1 = $conn->query("SELECT * FROM orders WHERE id='$t'");
			$data1 = $sql1->fetch_array();
			$orders .= '<h6>' . $data1['mealname'] . ' || Number: ' . $data1['numMeal'] . '</h6>'
				. '<h6>' . $data1['name_drink'] . ' || Number: ' . $data1['num_drink'] . '</h6>'
				. '<h6>' . $data1['name_snack'] . ' || Number: ' . $data1['num_snack'] . '</h6>'
				. '<h6> Price ||  ' . $data1['totalprice'] . '</h6>
				<hr>';
		}
		$total_cash = '<h6> Total Cash ||  ' . $data['totalCash'] . '</h6>';
		$jsonArray = array(
			'orders' => $orders,
			'totalCash' => $total_cash,
			'date' => $data['date']
		);

		exit(json_encode($jsonArray));
	}

	if ($_POST['key'] == 'getExistingData') {
		$start = $conn->real_escape_string($_POST['start']);
		$limit = $conn->real_escape_string($_POST['limit']);

		$sql = $conn->query("SELECT * FROM bills LIMIT $start, $limit");
		if ($sql->num_rows > 0) {
			$response = "";
			while ($data = $sql->fetch_array()) {
				$response .= '
						<tr>
						<td id="table_number' . $data["id"] . '">' . $data["table_number"] . '</td>
							<td id="waiter_phone' . $data["id"] . '">' . $data["waiter_name"]  . '</td>
							<td id="cashier_email' . $data["id"] . '">' . $data["cashier_name"] . '</td>
							<td id="total_cash' . $data["id"] . '">' . $data["totalCash"] . '</td>
							<td id="date' . $data["id"] . '">' . $data["date"] . '</td>
							<td>
								<input type="button" onclick="view(' . $data["id"] . ')" value="View" class="btn btn-success">
								<input type="button" onclick="deleteRow(' . $data["id"] . ')" value="Delete" class="btn btn-danger">
							</td>
						</tr>
					';
			}
			exit($response);
		} else
			exit('reachedMax');
	}

	if ($_POST['key'] == 'getLoyaltyData') {
		$start = $conn->real_escape_string($_POST['start']);
		$limit = $conn->real_escape_string($_POST['limit']);

		$sql = $conn->query("SELECT DISTINCT  person_name,person_phone FROM reservations  LIMIT $start, $limit");
		if ($sql->num_rows > 0) {
			$response = "";
			while ($data = $sql->fetch_array()) {
				$name = $data['person_name'];
				$phone = $data['person_phone'];
				$sql1 = $conn->query("SELECT  * FROM reservations WHERE person_name='$name' AND person_phone='$phone'");
				$num_visits = $sql1->num_rows;
				$discount = $num_visits % 3 == 0 ? 'Yes' : 'No';
				$response .= '
						<tr>
							<td>' . $data["person_name"] . '</td>
							<td >' . $data["person_phone"]  . '</td>
							<td >' . $num_visits . '</td>
							<td >' . $discount . '</td>
						</tr>
					';
			}
			exit($response);
		} else
			exit('reachedMax');
	}
	$rowID = $conn->real_escape_string($_POST['rowID']);

	if ($_POST['key'] == 'deleteRow') {
		$conn->query("DELETE FROM bills WHERE id='$rowID'");
		exit('The Bill Has Been Deleted!');
	}

	date_default_timezone_set("Asia/Damascus");
	$date = date("Y-m-d");
	$name = $conn->real_escape_string($_POST['name']);
	$cashier = $conn->real_escape_string($_POST['cashier']);
	$waiter = $conn->real_escape_string($_POST['waiter']);
	$discount = $conn->real_escape_string($_POST['discount']);
	$x = "";
	$arr = " ";
	$totalCash = 0;
	$sql = $conn->query("SELECT * FROM orders Where date='$date' and num_table='$name'");
	while ($data = $sql->fetch_array()) {
		$x = $data['id'];
		if ($data['status'] == 'no') {
			if ($arr == " ")
				$arr .= $x;
			else
				$arr .= ':' . $x;
			$totalCash += $data['totalprice'];
			$conn->query("UPDATE orders SET status='yes' Where id='$x'");
		}
	}
	$arr = ltrim($arr, ' ');

	if ($_POST['key'] == 'addNew') {
		$h1 = $h2 = 0;
		$sql = $conn->query("SELECT * FROM bills");
		while ($data = $sql->fetch_array()) {
			if ($data['waiter_name'] == $waiter) {
				$h1++;
			}
			if ($data['cashier_name'] == $cashier) {
				$h2++;
			}
		}
		$sale1 = $h1 * 0.2;
		$sale2 = $h2 * 0.1;
		$conn->query("UPDATE sales SET bills='$h1'
		, sales='$sale1' Where name='$waiter'");
		$conn->query("UPDATE sales SET bills='$h2'
		, sales='$sale2' Where name='$cashier'");

		$conn->query("UPDATE tables SET table_status='available'
		Where table_name='$name'");
		if ($discount == "yes") {
			$totalCash = $totalCash * 0.75;
		}
		$conn->query("INSERT INTO bills (table_number,waiter_name,
			cashier_name,orders,totalCash) 
			VALUES ('$name', '$cashier', '$waiter', '$arr'
			, '$totalCash')");
		exit('inserted');
	}
}
