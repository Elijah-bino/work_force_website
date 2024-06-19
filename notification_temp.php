<?php
// Start the session before any output
session_start();
$users_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Notification Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 800px;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            height:auto;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        .notification-item {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .notification-item:last-child {
            margin-bottom: 0;
        }

        .notification-item:hover {
            background-color: #f0f0f0;
        }

        .notification-content {
            font-weight: bold;
            color: #333;
            font-size: 1.1rem;
        }

        .notification-date {
            color: #888;
            font-size: 0.9rem;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            width: 70%;
            max-width: 400px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .popup-close {
            text-align: right;
            cursor: pointer;
            font-size: 1.2rem;
            color: #888;
        }

        .popup-content {
            color: #333;
            font-size: 1.1rem;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Notification Page</h1>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "work";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get the users_id from the session (Replace this with your session retrieval method)
        //$users_id = 1001;

        // Fetch messages and replies from contacts table
        $contacts_query = "SELECT ticket_no, name, email, message, reply
                           FROM contacts
                           WHERE users_id = $users_id AND reply IS NOT NULL";
        $contacts_result = mysqli_query($conn, $contacts_query);
        $contacts_data = mysqli_fetch_all($contacts_result, MYSQLI_ASSOC);

        // Fetch feeds and replies from feedback table
        $feedback_query = "SELECT feeds_id, feeds, reply
                           FROM feedback
                           WHERE users_id = $users_id AND reply IS NOT NULL";
        $feedback_result = mysqli_query($conn, $feedback_query);
        $feedback_data = mysqli_fetch_all($feedback_result, MYSQLI_ASSOC);

       // Display notification items for contacts
       foreach ($contacts_data as $contact) {
        echo '<div class="notification-item" onclick="displayPopup(`' . $contact['reply'] . '`)">';
        echo '<div class="notification-content">' . $contact['message'] . '</div>';
        //echo '<div class="notification-date">' . date("Y-m-d H:i:s") . '</div>';
        echo '</div>';
    }

    // Display notification items for feedback
    foreach ($feedback_data as $feedback) {
        echo '<div class="notification-item" onclick="displayPopup(`' . $feedback['reply'] . '`)">';
        echo '<div class="notification-content">' . $feedback['feeds'] . '</div>';
        //echo '<div class="notification-date">' . date("Y-m-d H:i:s") . '</div>';
        echo '</div>';
    }

        mysqli_close($conn);
        ?>

        <!-- Popup box for displaying message or feeds -->
        <div id="popup" class="popup">
            <div class="popup-close" onclick="closePopup()">X</div>
            <div class="popup-content">
                <h2>Reply</h2>
                <p id="content">Content will appear here...</p>
            </div>
        </div>
    </div>

    <script>
        // Function to display the popup with content
        function displayPopup(content) {
            const contentArea = document.getElementById('content');
            contentArea.innerText = content;
            document.getElementById('popup').style.display = 'block';
        }

        // Function to close the popup
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

    </script>
</body>

</html>
