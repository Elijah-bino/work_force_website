<?php
session_start();

// Include PHPMailer autoload file
require 'vendor/autoload.php'; // Modify this path according to your setup

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Assuming you have already set up a database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "work";

    // Create a new connection
    $connection = mysqli_connect($servername, $username, $password, $dbname);

    // Check the connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get values from the form
    
    $booking_id = $_POST['booking_id'];
    
    $user_id = $_POST['user_id'];

    // Fetch user's email from the users table
    $fetchemailofuser = "SELECT email FROM users WHERE user_id = $user_id";
    $emailResult = mysqli_query($connection, $fetchemailofuser);

    if ($emailResult) {
        // Fetch the email from the result set
        $emailData = mysqli_fetch_assoc($emailResult);

        if ($emailData) {
            // Access the email value and save it to a variable
            $userEmail = $emailData['email'];

            // Now $userEmail contains the email fetched from the database

            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            try {
                // SMTP configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'elijahbino2@gmail.com'; // Your Gmail address
                $mail->Password = 'hyye sdni lskm rboa'; // Your Gmail password or App-Specific Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587; // TCP port to connect to

                // Sender and recipient settings
                $mail->setFrom('elijahbino2@gmail.com', 'Elijah2'); // Sender's email and name
                $mail->addAddress($userEmail); // Recipient's email fetched from the database

                // Email content
                $mail->isHTML(true);
                $mail->Subject = 'Subject of the Email';
                $mail->Body = 'welcome aboard babe. <b>in bold!</b>';

                // Send email
                $mail->send();
                echo 'Email has been sent successfully!';

                // Update order request status in bookings table
                $updateOrderrequestStatusQuery = "UPDATE bookings SET order_request_status = 'rejected' WHERE booking_id = $booking_id";

                if (mysqli_query($connection, $updateOrderrequestStatusQuery)) {
                    // Redirect to test.php after successful update
                    header("Location: service_provider.php");
                } else {
                    // Handle error while updating
                    echo "Error updating order request status: " . mysqli_error($connection);
                }
            } catch (Exception $e) {
                echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            // Handle case where no email data was found for the user_id
            echo "No email found for the user.";
        }

        // Free the result set
        mysqli_free_result($emailResult);
    } else {
        // Handle query execution error
        echo "Error executing the query: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    // Handle the case where the form is not submitted
    echo "Form not submitted.";
}
?>
