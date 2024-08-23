<?php
require_once "db/config.php";
check_login();

function numberToWords($num) {
    $units = [
        0 => "Zero",
        1 => "One",
        2 => "Two",
        3 => "Three",
        4 => "Four",
        5 => "Five",
        6 => "Six",
        7 => "Seven",
        8 => "Eight",
        9 => "Nine",
        10 => "Ten",
        11 => "Eleven",
        12 => "Twelve",
        13 => "Thirteen",
        14 => "Fourteen",
        15 => "Fifteen",
        16 => "Sixteen",
        17 => "Seventeen",
        18 => "Eighteen",
        19 => "Nineteen",
    ];

    $tens = [
        20 => "Twenty",
        30 => "Thirty",
        40 => "Forty",
        50 => "Fifty",
        60 => "Sixty",
        70 => "Seventy",
        80 => "Eighty",
        90 => "Ninety",
    ];

    // Handle decimal numbers
    if (strpos($num, '.') !== false) {
        list($integerPart, $decimalPart) = explode('.', $num);
        $integerWords = numberToWords((int)$integerPart);
        $decimalWords = "Point";
        for ($i = 0; $i < strlen($decimalPart); $i++) {
            $decimalWords .= " " . $units[$decimalPart[$i]];
        }
        return trim($integerWords . " " . $decimalWords);
    }

    // Handle integer numbers
    if ($num < 20) {
        return $units[$num];
    } elseif ($num < 100) {
        $tensPart = floor($num / 10) * 10;
        $unitsPart = $num % 10;
        return $tens[$tensPart] . ($unitsPart ? " " . $units[$unitsPart] : "");
    } elseif ($num < 1000) {
        $hundreds = floor($num / 100);
        $remainder = $num % 100;
        return $units[$hundreds] . " Hundred" . ($remainder ? " " . numberToWords($remainder) : "");
    } else {
        // Determine the correct "unit" for large numbers
        $powers = [
            1000 => "Thousand",
            100000 => "Lakh",
            10000000 => "Crore",
            1000000000 => "Arab",
            1000000000000 => "Kharab",
            1000000000000000 => "Padma",
            1000000000000000000 => "Padma"
        ];

        foreach (array_reverse($powers, true) as $value => $label) {
            if ($num >= $value) {
                $powerBase = floor($num / $value);
                $remainder = $num % $value;
                return numberToWords($powerBase) . " " . $label . ($remainder ? " " . numberToWords($remainder) : "");
            }
        }
    }
}



// Fetch data from the database
$id = $_GET['MST_ID'];

$sql = "SELECT receipts.*, users.name as user_name FROM receipts 
        JOIN users ON receipts.user_id = users.id WHERE receipts.id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $receipt_amount = $row["receipt_amount"];
            $num = numberToWords((float)$receipt_amount);
            $user_name = $row['user_name'];

            if ($row['status'] == 1) {
                header('Content-Type: image/jpeg');
                $font = "ARIALUNI.TTF";
                $image = imagecreatefromjpeg("img.jpg");
                $color = imagecolorallocate($image, 19, 21, 22);

                // Convert dates to desired format
                $trans_date = date("d/m/Y", strtotime($row["created_at"]));
                $date_to = date("d/m/Y", strtotime($row["trans_date"]));

                // Add text to image
                imagettftext($image, 13.5, 0, 150, 188, $color, $font, $user_name . ' / ' . $id . ' / ' . $row['fyear_id']);
                imagettftext($image, 13.5, 0, 645, 185, $color, $font, $trans_date);
                imagettftext($image, 13.5, 0, 328, 225, $color, $font, $row['party_name']);
                imagettftext($image, 13.5, 0, 100, 263, $color, $font, $row['pan']);

                // Handle address wrapping
                $address = $row['address'] . ', ' . $row['city'] . ', ' . $row['state'] . ', ' . $row['pincode'];
                $addressLines = explode("\n", wordwrap($address, 45, "\n"));
                $x = 350;
                $y = 261;
                foreach ($addressLines as $line) {
                    imagettftext($image, 13.5, 0, $x, $y, $color, $font, $line);
                    $x -= 300;
                    $y += 40; // Increment y-coordinate for next line
                }

               
                imagettftext($image, 13.5, 0, 368, 380, $color, $font, $row['payment_mode']);
                imagettftext($image, 13.5, 0, 588, 380, $color, $font, $row['ref_no']);
                imagettftext($image, 13.5, 0, 110, 418, $color, $font, $date_to);
                imagettftext($image, 13.5, 0, 510, 418, $color, $font, $row['bank_name']);
                imagettftext($image, 18, 0, 105, 488, $color, $font, $row['receipt_amount'] . '/-');
                imagettftext($image, 13.5, 0, 180, 340, $color, $font, $num . ' Only/-');

                // Save image and create PDF
                $file = time();
                $file_path = "image/" . $file . ".jpg";
                $file_path_pdf = $file . ".pdf";
                imagejpeg($image, $file_path);
                imagedestroy($image);

                require('fpdf.php');
                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->Image($file_path, 0, 0, 210, 150);
                $pdf->Output($file_path_pdf, "I");
            } else {
                echo '<h4 style="text-align: center; font-size: 20px; font-weight: 500; color: #f00; margin-top: 20%;">
            Sorry, Your ID Is Unapproved. Please Try After ID Is Approved</h4>';
            }
        }
    } else {
        echo "No data found";
    }

