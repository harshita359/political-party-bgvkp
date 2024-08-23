<?php
require_once "db/config.php";
check_login();

// $sql = "SELECT * FROM receipts";
// $res = 

$html='<table>';
$html.='<thead>
<tr>
    <th>Sr</th>
    <th>ID</th>
    <th>Party Name</th>
    <th>Member</th>
    <th>City</th>
    <th>Mobile</th>
    <th>Pan</th>
    <th>Deposit Bank</th>
    <th>Amount</th>
    <th>Date</th>
    <th>Status</th>
</tr>
</thead>
<tbody>';
if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];
    $query = "SELECT * FROM receipts WHERE created_at BETWEEN '$from_date' AND '$to_date'";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            $html.='<tbody>
            <tr>
            <td>'. $row['id'].'</td>
            <td>'. $row['id'] . "/" . $row['fyear_id'].'</td>
            <td>'. $row['party_name'].'</td>
            <td>'. $row['deposite_bank'].'</td>
            <td>'. $row['city'].'</td>
            <td>'. $row['mobile'].'</td>
            <td>'. $row['pan'].'</td>
            <td>'. $row['deposite_bank'].'</td>
            <td>'. $row['receipt_amount'].'</td>
            <td>'. $row['trans_date'].'</td>
        </tr>
        <tbody>';
        }
    } else {
        echo "NO Record Found";
    }
}
// while($row = mysqli_fetch_assoc($res)){
    
// }
$html.='</table>';
echo $html;
// else{
//  $html.='Data not Found';
// }