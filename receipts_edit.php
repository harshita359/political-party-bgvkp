<?php
require_once "db/config.php";
check_login();

if (isset($_POST['updatereceipts'])) {

    $user_id = $_POST['user_id'];
    $fyear_id = $_POST['fyear_id'];
    $pan = $_POST['pan'];
    $party_name = $_POST['party_name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $receipt_amount = $_POST['receipt_amount'];
    // $deposite_bank = $_POST['deposite_bank'];
    $payment_mode = $_POST['payment_mode'];
    $bank_name = $_POST['bank_name'];
    $ref_no = $_POST['ref_no'];
    $trans_date = $_POST['trans_date'];

    $query = "UPDATE receipts SET fyear_id='$fyear_id', pan='$pan', party_name='$party_name', address='$address', city='$city', state='$state', pincode='$pincode', mobile='$mobile', email='$email', receipt_amount='$receipt_amount', payment_mode='$payment_mode', bank_name='$bank_name', ref_no='$ref_no', trans_date='$trans_date' WHERE id='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['status'] = "User Update Successfully";
        header("Location: receipts.php");
    } else {
        $_SESSION['status'] = "User Update failed!";
        header("Location: receipts.php");
    }
}
?>
<!--  -->

<?php
include('includes/header.php');
include('includes/topnavbar.php');

?>

<main class="py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h2>Edit Receipt</h2>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="receipts.php" class="btn btn-secondary" type="button"><i class="fa-solid fa-angle-left"></i> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3" action="" method="POST">

                            <?php
                            if (isset($_GET['user_id'])) {
                                $user_id = $_GET['user_id'];
                                $query = "SELECT * FROM receipts WHERE id='$user_id' LIMIT 1";
                                $query_run = mysqli_query($conn, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                            ?>

                                        <input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
                                        <div class="col-md-6">
                                            <label for="fyear_id" class="form-label">Financial Year</label>
                                            <select id="fyear_id" name="fyear_id" class="form-select">
                                                <option value="">Select Financial Year</option>
                                                <!-- <option value="2022-23" <?php //if($row['fyear_id'] == '2022-23'){ echo "selected"; } 
                                                                                ?>>2022-23</option>
                                                <option value="2023-24" <?php //if($row['fyear_id'] == '2023-24'){ echo "selected"; } 
                                                                        ?>>2023-24</option> -->
                                                <option value="2024-25" <?php if ($row['fyear_id'] == '2024-25') {
                                                                            echo "selected";
                                                                        } ?>>2024-25</option>
                                                <!-- <option value="1" selected>2022-2023</option> -->
                                            </select>
                                        </div>
                                        <!-- <div class="col-md-6">
                                        <label for="user" class="form-label">Member</label>
                                        <select id="user_id" name="user_id" class="form-select">
                                            <option value="1" selected>Member 1</option>
                                            <option value="2" selected>Member 2</option>
                                        </select>
                                    </div> -->
                                        <div class="col-md-6">
                                            <label for="pan" class="form-label">PAN</label>
                                            <input type="text" class="form-control" id="pan" name="pan" value="<?php echo $row['pan'] ?>" placeholder=" Pan Number" oninput="handlePanInput(event)">
                                        </div>
                                        <div class="col-12">
                                            <label for="party_name" class="form-label">Party Name</label>
                                            <input type="text" class="form-control" id="party_name" name="party_name" value="<?php echo $row['party_name'] ?>" placeholder="Party Name" oninput="handlePanInput(event)" requred>
                                        </div>
                                        <div class="col-12">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="address" name="address" style="text-transform:capitalize;" placeholder="Address"><?php echo $row['address'] ?></textarea>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" id="city" name="city" style="text-transform:capitalize;" value="<?php echo $row['city'] ?>" placeholder="City">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="state" class="form-label">State</label>
                                            <select id="state" name="state" class="form-select">
                                                <option value="">Select State</option>
                                                <option value="Andhra Pradesh" <?php if ($row['state'] == 'Andhra Pradesh') {
                                                                                    echo "selected";
                                                                                } ?>>Andhra Pradesh</option>
                                                <option value="Andaman and Nicobar Islands" <?php if ($row['state'] == 'Andaman and Nicobar Islands') {
                                                                                                echo "selected";
                                                                                            } ?>>Andaman and Nicobar Islands</option>
                                                <option value="Arunachal Pradesh" <?php if ($row['state'] == 'Arunachal Pradesh') {
                                                                                        echo "selected";
                                                                                    } ?>>Arunachal Pradesh</option>
                                                <option value="Assam" <?php if ($row['state'] == 'Assam') {
                                                                            echo "selected";
                                                                        } ?>>Assam</option>
                                                <option value="Bihar" <?php if ($row['state'] == 'Bihar') {
                                                                            echo "selected";
                                                                        } ?>>Bihar</option>
                                                <option value="Chandigarh" <?php if ($row['state'] == 'Chandigarh') {
                                                                                echo "selected";
                                                                            } ?>>Chandigarh</option>
                                                <option value="Chhattisgarh" <?php if ($row['state'] == 'Chhattisgarh') {
                                                                                    echo "selected";
                                                                                } ?>>Chhattisgarh</option>
                                                <option value="Dadar and Nagar Haveli" <?php if ($row['state'] == 'Dadar and Nagar Haveli') {
                                                                                            echo "selected";
                                                                                        } ?>>Dadar and Nagar Haveli</option>
                                                <option value="Daman and Diu" <?php if ($row['state'] == 'Daman and Diu') {
                                                                                    echo "selected";
                                                                                } ?>>Daman and Diu</option>
                                                <option value="Delhi" <?php if ($row['state'] == 'Delhi') {
                                                                            echo "selected";
                                                                        } ?>>Delhi</option>
                                                <option value="Lakshadweep" <?php if ($row['state'] == 'Lakshadweep') {
                                                                                echo "selected";
                                                                            } ?>>Lakshadweep</option>
                                                <option value="Puducherry" <?php if ($row['state'] == 'Puducherry') {
                                                                                echo "selected";
                                                                            } ?>>Puducherry</option>
                                                <option value="Goa" <?php if ($row['state'] == 'Goa') {
                                                                        echo "selected";
                                                                    } ?>>Goa</option>
                                                <option value="Gujarat" <?php if ($row['state'] == 'Gujarat') {
                                                                            echo "selected";
                                                                        } ?>>Gujarat</option>
                                                <option value="Haryana" <?php if ($row['state'] == 'Haryana') {
                                                                            echo "selected";
                                                                        } ?>>Haryana</option>
                                                <option value="Himachal Pradesh" <?php if ($row['state'] == 'Himachal Pradesh') {
                                                                                        echo "selected";
                                                                                    } ?>>Himachal Pradesh</option>
                                                <option value="Jammu and Kashmir" <?php if ($row['state'] == 'Jammu and Kashmir') {
                                                                                        echo "selected";
                                                                                    } ?>>Jammu and Kashmir</option>
                                                <option value="Jharkhand" <?php if ($row['state'] == 'Jharkhand') {
                                                                                echo "selected";
                                                                            } ?>>Jharkhand</option>
                                                <option value="Karnataka" <?php if ($row['state'] == 'Karnataka') {
                                                                                echo "selected";
                                                                            } ?>>Karnataka</option>
                                                <option value="Kerala" <?php if ($row['state'] == 'Kerala') {
                                                                            echo "selected";
                                                                        } ?>>Kerala</option>
                                                <option value="Madhya Pradesh" <?php if ($row['state'] == 'Madhya Pradesh') {
                                                                                    echo "selected";
                                                                                } ?>>Madhya Pradesh</option>
                                                <option value="Maharashtra" <?php if ($row['state'] == 'Maharashtra') {
                                                                                echo "selected";
                                                                            } ?>>Maharashtra</option>
                                                <option value="Manipur" <?php if ($row['state'] == 'Manipur') {
                                                                            echo "selected";
                                                                        } ?>>Manipur</option>
                                                <option value="Meghalaya" <?php if ($row['state'] == 'Meghalaya') {
                                                                                echo "selected";
                                                                            } ?>>Meghalaya</option>
                                                <option value="Mizoram" <?php if ($row['state'] == 'Mizoram') {
                                                                            echo "selected";
                                                                        } ?>>Mizoram</option>
                                                <option value="Nagaland" <?php if ($row['state'] == 'Nagaland') {
                                                                                echo "selected";
                                                                            } ?>>Nagaland</option>
                                                <option value="Odisha" <?php if ($row['state'] == 'Odisha') {
                                                                            echo "selected";
                                                                        } ?>>Odisha</option>
                                                <option value="Punjab" <?php if ($row['state'] == 'Punjab') {
                                                                            echo "selected";
                                                                        } ?>>Punjab</option>
                                                <option value="Rajasthan" <?php if ($row['state'] == 'Rajasthan') {
                                                                                echo "selected";
                                                                            } ?>>Rajasthan</option>
                                                <option value="Sikkim" <?php if ($row['state'] == 'Sikkim') {
                                                                            echo "selected";
                                                                        } ?>>Sikkim</option>
                                                <option value="Tamil Nadu" <?php if ($row['state'] == 'Tamil Nadu') {
                                                                                echo "selected";
                                                                            } ?>>Tamil Nadu</option>
                                                <option value="Telangana" <?php if ($row['state'] == 'Telangana') {
                                                                                echo "selected";
                                                                            } ?>>Telangana</option>
                                                <option value="Tripura" <?php if ($row['state'] == 'Tripura') {
                                                                            echo "selected";
                                                                        } ?>>Tripura</option>
                                                <option value="Uttar Pradesh" <?php if ($row['state'] == 'Uttar Pradesh') {
                                                                                    echo "selected";
                                                                                } ?>>Uttar Pradesh</option>
                                                <option value="Uttarakhand" <?php if ($row['state'] == 'Uttarakhand') {
                                                                                echo "selected";
                                                                            } ?>>Uttarakhand</option>
                                                <option value="West Bengal" <?php if ($row['state'] == 'West Bengal') {
                                                                                echo "selected";
                                                                            } ?>>West Bengal</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="pincode" class="form-label">Pincode</label>
                                            <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode" value="<?php echo $row['pincode'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="mobile" class="form-label">Mobile</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $row['mobile'] ?>" placeholder="Mobile Number">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $row['email'] ?>" style="text-transform:lowercase;" placeholder="Email Id">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="receipt_amount" class="form-label">Amount</label>
                                            <input type="text" class="form-control" id="receipt_amount" name="receipt_amount" value="<?php echo $row['receipt_amount'] ?>" placeholder="0.00">
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <label for="deposite_bank" class="form-label">Deposit Bank</label>
                                            <select id="deposite_bank" name="deposite_bank" class="form-select">
                                                <option value="Axis Bank" <?php if ($row['deposite_bank'] == 'Axis Bank') {
                                                                                echo "selected";
                                                                            } ?>>Axis Bank</option>
                                            </select>
                                        </div> -->
                                        <div class="col-md-6">
                                            <label for="payment_mode" class="form-label">Payment Mode</label>
                                            <select id="payment_mode" name="payment_mode" class="form-select">
                                                <option value="">Select Payment Mode</option>
                                                <option value="Cheque" <?php if ($row['payment_mode'] == 'Cheque') {
                                                                            echo "selected";
                                                                        } ?>>Cheque</option>
                                                <option value="NEFT" <?php if ($row['payment_mode'] == 'NEFT') {
                                                                            echo "selected";
                                                                        } ?>>NEFT</option>
                                                <option value="RTGS" <?php if ($row['payment_mode'] == 'RTGS') {
                                                                            echo "selected";
                                                                        } ?>>RTGS</option>
                                                <option value="IMPS" <?php if ($row['payment_mode'] == 'IMPS') {
                                                                            echo "selected";
                                                                        } ?>>IMPS</option>
                                                <option value="UPI" <?php if ($row['payment_mode'] == 'UPI') {
                                                                        echo "selected";
                                                                    } ?>>UPI</option>
                                                <option value="DD" <?php if ($row['payment_mode'] == 'DD') {
                                                                        echo "selected";
                                                                    } ?>>DD</option>
                                                <option value="Cash" <?php if ($row['payment_mode'] == 'Cash') {
                                                                            echo "selected";
                                                                        } ?>>Cash</option>
                                                <option value="Other" <?php if ($row['payment_mode'] == 'Other') {
                                                                            echo "selected";
                                                                        } ?>>Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="bank_name" class="form-label">Bank Name</label>
                                            <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php echo $row['bank_name'] ?>" style="text-transform:capitalize;" placeholder="Received from bank">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="ref_no" class="form-label">Referance No.</label>
                                            <input type="text" class="form-control" id="ref_no" name="ref_no" value="<?php echo $row['ref_no'] ?>" placeholder="Ref. No">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="trans_date" class="form-label">Transaction Date</label>
                                            <input type="date" class="form-control" id="trans_date" name="trans_date" value="<?php echo $row['trans_date'] ?>">
                                        </div>

                            <?php
                                    }
                                } else {
                                    echo "<h4>NO Record Found!</h4>";
                                }
                            }


                            ?>


                            <div class="col-12">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                    <button type="submit" name="updatereceipts" class="btn btn-info text-light"><i class="fa-solid fa-pen-to-square"></i>
                                        Update</button>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>





<?php
include('includes/footer.php');
?>