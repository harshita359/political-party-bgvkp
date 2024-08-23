<?php
require_once "db/config.php";
check_login();
if ($_SESSION['user_role'] == 'admin') {
if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];
    $query = "SELECT * FROM receipts WHERE created_at BETWEEN '$from_date' AND '$to_date'";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        $html = '<table border="1">
                  <tr>
                       <th>Sr</th>
                       <th>ID</th>
                       <th>Party Name</th>
                       <th>Member</th>
                       <th>City</th>
                       <th>Mobile</th>
                       <th>Pan</th>
                       <!-- <th>Deposit Bank</th> -->
                       <th>Amount</th>
                       <th>Date</th>
                   </tr>';
        while ($row = mysqli_fetch_assoc($query_run)) {
            $html .= '<tr>
                          <td>' . $row['id'] . '</td>
                          <td>' . $row['id'] . "/" . $row['fyear_id'] . '</td>
                          <td>' . $row['party_name'] . '</td>
                          <td>' . $row['bank_name'] . '</td>
                          <td>' . $row['city'] . '</td>
                          <td>' . $row['mobile'] . '</td>
                          <td>' . $row['pan'] . '</td>
                             <!-- <td>'  //. $row['deposite_bank']
                           . '</td> -->
                          <td>' . $row['receipt_amount'] . '</td>
                          <td>' . $row['trans_date'] . '</td>
                      </tr>';
        }
        $html .= '</table>';
        $filename = "data" . date('Ymdhis') . ".xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        echo $html;
        exit;
    } else {
        echo "NO Record Found";
    }
}
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
            $html = '<table border="1">
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
                       </tr>';
            while ($row = mysqli_fetch_assoc($query_run)) {
                $html .= '<tr>
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
            $html .= '</table>';
            $filename = "data" . date('Ymdhis') . ".xls";
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$filename\"");
            echo $html;
            exit;
        } else {
            echo "NO Record Found";
        }
    }
}

include('includes/header.php');
include('includes/topnavbar.php');
?>

<div class="wrapper">
    <main class="py-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8 col-8">

                    <div class="card">
                        <div class="card-header">
                            Data Report Export
                        </div>

                        <div class="card-body">
                            <form method="GET" action="">
                                <input type="hidden" name="_token" value="3f0DsFdDJj9sPO32Xws8kCljr1VkCNqiCKOqBR8W">
                                <div class="row mb-3">
                                    <div class="col-md-4 mx-auto">
                                        <label for="from_date" class="form-label">From Date</label>
                                        <input type="date" class="form-control" id="from_date" name="from_date" value="">
                                    </div>
                                    <div class="col-md-4 mx-auto">
                                        <label for="to_date" class="form-label">To Date</label>
                                        <input type="date" class="form-control" id="to_date" name="to_date" value="">
                                    </div>
                                </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 mx-auto">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <button type="submit" class="btn btn-success" name="export">
                                        Excel  <i class="fa-solid fa-right-to-bracket"></i></button>
                                    <!--<button type="submit" class="btn btn-danger text-light" name="pdf" formaction="pdf.php" target="_blank">-->
                                    <!--    PDF</button>-->


                                </div>
                            </div>
                        </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>

    </main>
</div>

<?php
include('includes/footer.php');
?>