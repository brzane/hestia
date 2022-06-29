<?php
if (isset($_POST['key'])) {

    $conn = new mysqli('localhost', 'root', '', 'restaurant_management');

    if ($_POST['key'] == 'getRowData') {
        $rowID = $conn->real_escape_string($_POST['rowID']);
        $sql = $conn->query("SELECT * FROM employee WHERE id='$rowID'");
        $data = $sql->fetch_array();
        $jsonArray = array(
            'ssn' => $data['ssn'],
            'name' => $data['name'],
            'phone' => $data['phone'],
            'type' => $data['type'],
            'salary' => $data['salary']
        );

        exit(json_encode($jsonArray));
    }

    if ($_POST['key'] == 'getExistingData') {
        $start = $conn->real_escape_string($_POST['start']);
        $limit = $conn->real_escape_string($_POST['limit']);

        $sql = $conn->query("SELECT * FROM employee LIMIT $start, $limit");
        if ($sql->num_rows > 0) {
            $response = "";
            while ($data = $sql->fetch_array()) {
                $response .= '
						<tr>
					     	<td id="employee_ssn' . $data["id"] . '">' . $data["ssn"] . '</td>
							<td id="employee_name' . $data["id"] . '">' . $data["name"] . '</td>
                            <td id="employee_phone' . $data["id"] . '">' . $data["phone"] . '</td>
                            <td id="employee_type' . $data["id"] . '">' . $data["type"] . '</td>
                            <td id="employee_salary' . $data["id"] . '">' . $data["salary"] . ' $' . '</td>
                            <td id="employee_start_date' . $data["id"] . '">' . $data["start_date"] . '</td>
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

    if ($_POST['key'] == 'getSalesData') {
        $start = $conn->real_escape_string($_POST['start']);
        $limit = $conn->real_escape_string($_POST['limit']);

        $sql = $conn->query("SELECT * FROM sales LIMIT $start, $limit");
        if ($sql->num_rows > 0) {
            $response = "";
            while ($data = $sql->fetch_array()) {
                $response .= '
                            <tr>
                            <td id="sales_'.$data['name'].'">' . $data["name"] . '</td>
                                <td>' . $data["jobtype"]  . '</td>
                                <td>' . $data["bills"] . '</td>
                                <td>+' . $data["sales"] . ' $</td>
                            </tr>
                        ';
            }
            exit($response);
        } else
            exit('reachedMax');
    }

    $rowID = $conn->real_escape_string($_POST['rowID']);
    $name= $conn->real_escape_string($_POST['name']);
    if ($_POST['key'] == 'deleteRow') {
        $conn->query("DELETE FROM sales WHERE name='$name'");
        $conn->query("DELETE FROM employee WHERE id='$rowID'");
        exit('The Employee Has Been Deleted!');
    }
    $ssn = $conn->real_escape_string($_POST['ssn']);
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $type = $conn->real_escape_string($_POST['type']);
    $salary = $conn->real_escape_string($_POST['salary']);

    if ($_POST['key'] == 'updateRow') {
        $conn->query("UPDATE employee SET ssn='$ssn',name='$name', phone='$phone',type='$type', salary='$salary' WHERE id='$rowID'");
        exit('edited');
    }

    if ($_POST['key'] == 'addNew') {
        if ($type == "waiter" || $type == "cashier") {
            $conn->query("INSERT INTO sales (name, jobtype, bills,sales) 
            VALUES ('$name','$type',0, 0)");
        }
        $sql = $conn->query("SELECT * FROM employee WHERE name = '$name'");
        if ($sql->num_rows > 0)
            exit("Employee With This Name Already Exists!");
        else {
            $conn->query("INSERT INTO employee (ssn,name, phone, type,salary) 
							VALUES ('$ssn', '$name','$phone','$type', '$salary')");
            exit('inserted');
        }
    }
}
