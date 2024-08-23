<?php
require_once "vendor/autoload.php";
require_once "db/config.php";
check_login();

if ($_SESSION['user_role'] == 'admin') {
    if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $query = "SELECT * FROM receipts WHERE created_at BETWEEN '$from_date' AND '$to_date'";
        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            $filedata = array();
            $html = '<style>
table.dataTable {
    clear: both;
    margin-top: 6px !important;
    margin-bottom: 6px !important;
    max-width: none !important;
    border-collapse: separate !important;
    border-spacing: 0;
}
.table-bordered {
    border: 1px solid #919599;
}
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    background-color: transparent;
}
table.dataTable td, table.dataTable th {
    -webkit-box-sizing: content-box;
    box-sizing: content-box;
    
}
bordered thead th {
    border-bottom-width: 2px;
    
}
.table thead th {
    vertical-align: bottom;
    background-color: rgba(0, 0, 0, .05);
    border-bottom: 2px solid #919599;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #919599;
}
.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 1px solid #919599;
}

</style>

<div class="card-body">
<table id="example2" class="table table-bordered table-striped dataTable">
    <thead>
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
        </tr>
    </thead>
    <tbody>';
            while ($row = mysqli_fetch_assoc($query_run)) {
                $html .= '<tbody>
                
            <tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['id'] . "/" . $row['fyear_id'] . '</td>
            <td>' . $row['party_name'] . '</td>
            <td>' . $row['deposite_bank'] . '</td>
            <td>' . $row['city'] . '</td>
            <td>' . $row['mobile'] . '</td>
            <td>' . $row['pan'] . '</td>
            <td>' . $row['deposite_bank'] . '</td>
            <td>' . $row['receipt_amount'] . '</td>
            <td>' . $row['trans_date'] . '</td>
        </tr>';
            }
            $html .= '</tbody>
</table>
</div>';
            // echo $html;
        } else {
            $html .= '
        <h4 style="    text-align: center; font-size: 20px; font-weight: 500; color: #f00;">
        Sorry, your data could not be found, please select a date</h4>';
        }
    }

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $file = time() . '.pdf';
    $mpdf->Output($file, 'I');
} 

else if ($_SESSION['user_role'] == 'user') {
    $user = $_SESSION['user'];
    $user_id = $_SESSION['user']['id'];

    if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $query = "SELECT * FROM receipts WHERE user_id='$user_id' AND created_at BETWEEN '$from_date' AND '$to_date'";
        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            $filedata = array();
            $html = '<style>
table.dataTable {
    clear: both;
    margin-top: 6px !important;
    margin-bottom: 6px !important;
    max-width: none !important;
    border-collapse: separate !important;
    border-spacing: 0;
}
.table-bordered {
    border: 1px solid #919599;
}
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    background-color: transparent;
}
table.dataTable td, table.dataTable th {
    -webkit-box-sizing: content-box;
    box-sizing: content-box;
    
}
bordered thead th {
    border-bottom-width: 2px;
    
}
.table thead th {
    vertical-align: bottom;
    background-color: rgba(0, 0, 0, .05);
    border-bottom: 2px solid #919599;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #919599;
}
.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 1px solid #919599;
}

</style>

<div class="card-body">
<table id="example2" class="table table-bordered table-striped dataTable">
    <thead>
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
        </tr>
    </thead>
    <tbody>';
            while ($row = mysqli_fetch_assoc($query_run)) {
                $html .= '<tbody>
                
            <tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['id'] . "/" . $row['fyear_id'] . '</td>
            <td>' . $row['party_name'] . '</td>
            <td>' . $row['deposite_bank'] . '</td>
            <td>' . $row['city'] . '</td>
            <td>' . $row['mobile'] . '</td>
            <td>' . $row['pan'] . '</td>
            <td>' . $row['deposite_bank'] . '</td>
            <td>' . $row['receipt_amount'] . '</td>
            <td>' . $row['trans_date'] . '</td>
        </tr>';
            }
            $html .= '</tbody>
</table>
</div>';
            // echo $html;
        } else {
            $html .= '
        <h4 style="    text-align: center; font-size: 20px; font-weight: 500; color: #f00;">
        Sorry, your data could not be found, please select a date</h4>';
        }
    }

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $file = time() . '.pdf';
    $mpdf->Output($file, 'I');

}










//         $html = '<table>';
// $html .='<thead>
// <tr>
//     <th>Sr</th>
//     <th>ID</th>
//     <th>Party Name</th>
//     <th>Member</th>
//     <th>City</th>
//     <th>Mobile</th>
//     <th>Pan</th>
//     <th>Deposit Bank</th>
//     <th>Amount</th>
//     <th>Date</th>
// </tr>
// </thead>';
//         while ($row = mysqli_fetch_assoc($query_run)) {
//             $html .= '<tbody>
        
//     <tr>
//     <td>' . $row['id'] . '</td>
//     <td>' . $row['id'] . "/" . $row['fyear_id'] . '</td>
//     <td>' . $row['party_name'] . '</td>
//     <td>' . $row['deposite_bank'] . '</td>
//     <td>' . $row['city'] . '</td>
//     <td>' . $row['mobile'] . '</td>
//     <td>' . $row['pan'] . '</td>
//     <td>' . $row['deposite_bank'] . '</td>
//     <td>' . $row['receipt_amount'] . '</td>
//     <td>' . $row['trans_date'] . '</td>
// </tr>
// <tbody>';
