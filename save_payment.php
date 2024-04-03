\<?php
date_default_timezone_set("Etc/GMT+8");
require_once 'class.php';

if (isset($_POST['save'])) {
    // Create a new instance of the db_class
    $db = new db_class();

    // Check if the connection is valid
    if ($db->conn->connect_error) {
        die("Connection failed: " . $db->conn->connect_error);
    }

    // Sanitize and validate input
    $loan_id = $db->conn->real_escape_string($_POST['loan_id']);
    $payee = $db->conn->real_escape_string($_POST['payee']);
    $penalty = floatval($_POST['penalty']); // Convert penalty to float
    $payable = floatval(str_replace(",", "", $_POST['payable'])); // Convert payable to float
    $payment = floatval($_POST['payment']); // Convert payment to float
    $month = intval($_POST['month']); // Convert month to integer

    // Calculate overdue flag
    $overdue = ($penalty == 0) ? 0 : 1;

    // Check if payment amount matches payable amount
    if ($payable != $payment) {
        echo "<script>alert('Please enter the correct amount to pay!')</script>";
        echo "<script>window.location='payment.php'</script>";
        exit; // Stop further execution
    }

    // Execute the query to save payment
    $query = "INSERT INTO `payment` (`loan_id`, `payee`, `pay_amount`, `penalty`, `overdue`) VALUES ('$loan_id', '$payee', '$payment', '$penalty', '$overdue')";

    if ($db->conn->query($query) === TRUE) {
        // Count number of payments made for the loan
        $count_pay = $db->conn->query("SELECT * FROM `payment` WHERE `loan_id`='$loan_id'")->num_rows;

        // Check if all payments have been made for the loan
        if ($count_pay === $month) {
            // Update loan status to '3' (completed) if all payments are made
            $query = "UPDATE `loan` SET `status`='3' WHERE `loan_id`='$loan_id'";
            if ($db->conn->query($query) === TRUE) {
                // Close the connection
                $db->conn->close();
                // Redirect to payment.php after processing
                header("location: payment.php");
                exit; // Stop further execution
            } else {
                echo "Error updating loan status: " . $db->conn->error;
            }
        } else {
            // Close the connection
            $db->conn->close();
            // Redirect to payment.php after processing
            header("location: payment.php");
            exit; // Stop further execution
        }
    } else {
        echo "Error saving payment: " . $db->conn->error;
    }
}
?>
