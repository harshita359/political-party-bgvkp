<?php
require_once "db/config.php";

check_login();

$fyear_iderr = $panerr = $party_nameerr = $addresserr = $cityerr = $stateerr = $pincodeerr = $receipt_amounterr = $payment_modeerr = $bank_nameerr = $ref_noerr = $trans_dateerr = '';

$fyear_id = $pan = $party_name = $address = $city = $state = $pincode = $mobile = $email = $receipt_amount = $payment_mode = $bank_name = $ref_no = $trans_date = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fyear_id = trim($_POST['fyear_id']);
    $pan = trim($_POST['pan']);
    $party_name = trim($_POST['party_name']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $pincode = trim($_POST['pincode']);
    $mobile = trim($_POST['mobile']);
    $email = trim($_POST['email']);
    $receipt_amount = trim($_POST['receipt_amount']);
    $payment_mode = trim($_POST['payment_mode']);
    $bank_name = trim($_POST['bank_name']);
    $ref_no = trim($_POST['ref_no']);
    $trans_date = trim($_POST['trans_date']);
    $user_id = $_SESSION['user']['id'];

    $errors = false;

    if (empty($fyear_id)) {
        $fyear_iderr = "Financial Year is required";
        $errors = true;
    }
    if (empty($pan)) {
        $panerr = "PAN Number is required";
        $errors = true;
    }
    if (empty($party_name)) {
        $party_nameerr = "Party Name is required";
        $errors = true;
    }
    if (empty($address)) {
        $addresserr = "Address is required";
        $errors = true;
    }
    if (empty($city)) {
        $cityerr = "City Name is required";
        $errors = true;
    }
    if (empty($state)) {
        $stateerr = "State Name is required";
        $errors = true;
    }
    if (empty($pincode)) {
        $pincodeerr = "Pincode is required";
        $errors = true;
    }
    if (empty($receipt_amount)) {
        $receipt_amounterr = "Receipt Amount is required";
        $errors = true;
    }
    if (empty($payment_mode)) {
        $payment_modeerr = "Payment Mode is required";
        $errors = true;
    }
    if (empty($bank_name)) {
        $bank_nameerr = "Bank Name is required";
        $errors = true;
    }
    if (empty($ref_no)) {
        $ref_noerr = "Reference No. is required";
        $errors = true;
    }
    if (empty($trans_date)) {
        $trans_dateerr = "Date is required";
        $errors = true;
    }

    if (!$errors) {
        $stmt = $conn->prepare("INSERT INTO receipts (user_id, fyear_id, pan, party_name, address, city, state, pincode, mobile, email, receipt_amount, payment_mode, bank_name, ref_no, trans_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssssssssss", $user_id, $fyear_id, $pan, $party_name, $address, $city, $state, $pincode, $mobile, $email, $receipt_amount, $payment_mode, $bank_name, $ref_no, $trans_date);

        if ($stmt->execute()) {
            $_SESSION['status'] = "Receipt created successfully";
            header("Location: receipts.php");
            exit();
        } else {
            $_SESSION['status'] = "Failed to create receipt";
        }
    }
}
?>

<?php
include('includes/header.php');
include('includes/topnavbar.php');
?>

<div class="wrapper">
    <main class="py-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <h2>Create Receipt</h2>
                <?php
                // if (isset($_SESSION['status'])) {
                //     echo '<h4 class="error">' . $_SESSION['status'] . '</h4>';
                //     unset($_SESSION['status']);
                // }
                ?>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="receipts.php" class="btn btn-secondary" type="button"><i class="fa-solid fa-angle-left"></i> Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" action="" method="POST">
                                <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                <div class="col-md-6">
                                    <label for="fyear_id" class="form-label">Financial Year <span class="error"><?php echo '  *' . $fyear_iderr ?></span></label>
                                    <select id="fyear_id" name="fyear_id" class="form-select">
                                        <option value="">Select Financial Year</option>
                                        <option value="2024-25" <?php echo ($fyear_id == '2024-25') ? 'selected' : '' ?>>2024-25</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="pan" class="form-label">PAN <span class="error"><?php echo '  *' . $panerr ?></span></label>
                                    <input type="text" class="form-control" id="pan" name="pan" value="<?php echo htmlspecialchars($pan); ?>" placeholder="Pan Number">
                                </div>
                                <div class="col-12">
                                    <label for="party_name" class="form-label">Party Name <span class="error"><?php echo '  *' . $party_nameerr ?></span></label>
                                    <input type="text" class="form-control" id="party_name" name="party_name" value="<?php echo htmlspecialchars($party_name); ?>" placeholder="Party Name">
                                </div>
                                <div class="col-12">
                                    <label for="address" class="form-label">Address <span class="error"><?php echo '  *' . $addresserr ?></span></label>
                                    <textarea class="form-control" id="address" name="address" style="text-transform:capitalize;" rows="2" placeholder="Address"><?php echo htmlspecialchars($address); ?></textarea>
                                </div>
                                <div class="col-md-5">
                                    <label for="city" class="form-label">City <span class="error"><?php echo '  *' . $cityerr ?></span></label>
                                    <input type="text" class="form-control" id="city" name="city" style="text-transform:capitalize;" value="<?php echo htmlspecialchars($city); ?>" placeholder="City">
                                </div>
                                <div class="col-md-4">
                                    <label for="state" class="form-label">State <span class="error"><?php echo '  *' . $stateerr ?></span></label>
                                    <select id="state" name="state" class="form-select">
                                        <option value="">Select State</option>
                                        <option value="Andhra Pradesh" <?php echo ($state == 'Andhra Pradesh') ? 'selected' : '' ?>>Andhra Pradesh</option>
                                        <option value="Andaman and Nicobar Islands" <?php echo ($state == 'Andaman and Nicobar Islands') ? 'selected' : '' ?>>Andaman and Nicobar Islands</option>
                                        <option value="Arunachal Pradesh" <?php echo ($state == 'Arunachal Pradesh') ? 'selected' : '' ?>>Arunachal Pradesh</option>
                                        <option value="Assam" <?php echo ($state == 'Assamh') ? 'selected' : '' ?>>Assam</option>
                                        <option value="Bihar" <?php echo ($state == 'Bihar') ? 'selected' : '' ?>>Bihar</option>
                                        <option value="Chandigarh" <?php echo ($state == 'Chandigarh') ? 'selected' : '' ?>>Chandigarh</option>
                                        <option value="Chhattisgarh" <?php echo ($state == 'Chhattisgarh') ? 'selected' : '' ?>>Chhattisgarh</option>
                                        <option value="Dadar and Nagar Haveli" <?php echo ($state == 'Dadar and Nagar Haveli') ? 'selected' : '' ?>>Dadar and Nagar Haveli</option>
                                        <option value="Daman and Diu" <?php echo ($state == 'Daman and Diu') ? 'selected' : '' ?>>Daman and Diu</option>
                                        <option value="Delhi" <?php echo ($state == 'Delhi') ? 'selected' : '' ?>>Delhi</option>
                                        <option value="Lakshadweep" <?php echo ($state == 'Lakshadweep') ? 'selected' : '' ?>>Lakshadweep</option>
                                        <option value="Puducherry" <?php echo ($state == 'Puducherry') ? 'selected' : '' ?>>Puducherry</option>
                                        <option value="Goa" <?php echo ($state == 'Goa') ? 'selected' : '' ?>>Goa</option>
                                        <option value="Gujarat" <?php echo ($state == 'Gujarat') ? 'selected' : '' ?>>Gujarat</option>
                                        <option value="Haryana" <?php echo ($state == 'Haryana') ? 'selected' : '' ?>>Haryana</option>
                                        <option value="Himachal Pradesh" <?php echo ($state == 'Himachal Pradesh') ? 'selected' : '' ?>>Himachal Pradesh</option>
                                        <option value="Jammu and Kashmir" <?php echo ($state == 'Jammu and Kashmir') ? 'selected' : '' ?>>Jammu and Kashmir</option>
                                        <option value="Jharkhand" <?php echo ($state == 'Jharkhand') ? 'selected' : '' ?>>Jharkhand</option>
                                        <option value="Karnataka" <?php echo ($state == 'Karnataka') ? 'selected' : '' ?>>Karnataka</option>
                                        <option value="Kerala" <?php echo ($state == 'Kerala') ? 'selected' : '' ?>>Kerala</option>
                                        <option value="Madhya Pradesh" <?php echo ($state == 'Madhya Pradesh') ? 'selected' : '' ?>>Madhya Pradesh</option>
                                        <option value="Maharashtra" <?php echo ($state == 'Maharashtra') ? 'selected' : '' ?>>Maharashtra</option>
                                        <option value="Manipur" <?php echo ($state == 'Manipur') ? 'selected' : '' ?>>Manipur</option>
                                        <option value="Meghalaya" <?php echo ($state == 'Meghalaya') ? 'selected' : '' ?>>Meghalaya</option>
                                        <option value="Mizoram" <?php echo ($state == 'Mizoram') ? 'selected' : '' ?>>Mizoram</option>
                                        <option value="Nagaland" <?php echo ($state == 'Nagaland') ? 'selected' : '' ?>>Nagaland</option>
                                        <option value="Odisha" <?php echo ($state == 'Odisha') ? 'selected' : '' ?>>Odisha</option>
                                        <option value="Punjab" <?php echo ($state == 'Punjab') ? 'selected' : '' ?>>Punjab</option>
                                        <option value="Rajasthan" <?php echo ($state == 'Rajasthan') ? 'selected' : '' ?>>Rajasthan</option>
                                        <option value="Sikkim" <?php echo ($state == 'Sikkim') ? 'selected' : '' ?>>Sikkim</option>
                                        <option value="Tamil Nadu" <?php echo ($state == 'Tamil Nadu') ? 'selected' : '' ?>>Tamil Nadu</option>
                                        <option value="Telangana" <?php echo ($state == 'Telangana') ? 'selected' : '' ?>>Telangana</option>
                                        <option value="Tripura" <?php echo ($state == 'Tripura') ? 'selected' : '' ?>>Tripura</option>
                                        <option value="Uttar Pradesh" <?php echo ($state == 'Uttar Pradesh') ? 'selected' : '' ?>>Uttar Pradesh</option>
                                        <option value="Uttarakhand" <?php echo ($state == 'Uttarakhand') ? 'selected' : '' ?>>Uttarakhand</option>
                                        <option value="West Bengal" <?php echo ($state == 'West Bengal') ? 'selected' : '' ?>>West Bengal</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="pincode" class="form-label">Pincode <span class="error"><?php echo '  *' . $pincodeerr ?></span></label>
                                    <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode" value="<?php echo htmlspecialchars($pincode); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>" placeholder="Mobile Number">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" style="text-transform:lowercase;" placeholder="Email Id">
                                </div>
                                <div class="col-md-6">
                                    <label for="receipt_amount" class="form-label">Amount <span class="error"><?php echo '  *' . $receipt_amounterr ?></span></label>
                                    <input type="text" class="form-control" id="receipt_amount" name="receipt_amount" value="<?php echo htmlspecialchars($receipt_amount); ?>" placeholder="0.00">
                                </div>
                                <div class="col-md-6">
                                    <label for="payment_mode" class="form-label">Payment Mode <span class="error"><?php echo '  *' . $payment_modeerr ?></span></label>
                                    <select id="payment_mode" name="payment_mode" class="form-select">
                                        <option value="">Select Payment Mode</option>
                                        <option value="Cheque" <?php echo ($payment_mode == 'Cheque') ? 'selected' : '' ?>>Cheque</option>
                                        <option value="NEFT" <?php echo ($payment_mode == 'NEFT') ? 'selected' : '' ?>>NEFT</option>
                                        <option value="RTGS" <?php echo ($payment_mode == 'RTGS') ? 'selected' : '' ?>>RTGS</option>
                                        <option value="IMPS" <?php echo ($payment_mode == 'IMPS') ? 'selected' : '' ?>>IMPS</option>
                                        <option value="UPI" <?php echo ($payment_mode == 'UPI') ? 'selected' : '' ?>>UPI</option>
                                        <option value="DD" <?php echo ($payment_mode == 'DD') ? 'selected' : '' ?>>DD</option>
                                        <option value="Cash" <?php echo ($payment_mode == 'Cash') ? 'selected' : '' ?>>Cash</option>
                                        <option value="Other" <?php echo ($payment_mode == 'Other') ? 'selected' : '' ?>>Other</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="bank_name" class="form-label">Bank Name <span class="error"><?php echo '  *' . $bank_nameerr ?></span></label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php echo htmlspecialchars($bank_name); ?>" style="text-transform:capitalize;" placeholder="Received from bank">
                                </div>
                                <div class="col-md-4">
                                    <label for="ref_no" class="form-label">Reference No. <span class="error"><?php echo '  *' . $ref_noerr ?></span></label>
                                    <input type="text" class="form-control" id="ref_no" name="ref_no" value="<?php echo htmlspecialchars($ref_no); ?>" placeholder="Ref. No">
                                </div>
                                <div class="col-md-4">
                                    <label for="trans_date" class="form-label">Transaction Date <span class="error"><?php echo '  *' . $trans_dateerr ?></span></label>
                                    <input type="date" class="form-control" id="trans_date" name="trans_date" value="<?php echo htmlspecialchars($trans_date); ?>">
                                </div>
                                <div class="col-12">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="receipts.php" class="btn btn-danger" type="button"><i class="fa-solid fa-xmark"></i> Cancel</a>
                                        <button type="submit" name="submit" class="btn btn-info text-light"><i class="fa-regular fa-floppy-disk"></i> Save</button>
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
</div>

<?php
include('includes/footer.php');
?>
