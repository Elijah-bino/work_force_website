<?php
// Start the session before any output
session_start();
$serviceProviderId = $_SESSION['service_provider_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            width: 10%; /* 10% width */
            min-width: 160px;
            height: 100vh; /* Full height of the viewport */
            background-color: #4B0082;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative; /* Added position */
        }

        .content {
            width: 90%; /* 90% width */
            padding: 20px;
        }

        .sidebar-button {
            display: block;
            width: 100%;
            padding: 12px 0; /* Increased padding */
            text-align: center;
            color: white;
            text-decoration: none;
            background-color: transparent;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 18px; /* Increased font size */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Different font */
        }

        .sidebar-button:hover,
        .sidebar-button.active {
            background-color: #555;
        }
        .table-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .menu-container {
            position: absolute;
            top: 10px;
            right: 10px; /* Add space at the right corner */
            display: inline-block;
            font-size: 24px;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block; /* Keep the dropdown inline */
            margin-bottom: 10px; /* Add space below the dropdown */
        }

        .menu-icon {
            color: white; /* Change to white */
            font-size: 24px; /* Adjust the size as needed */
            margin-bottom: 10px; /* Add space below the icon */
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            border-radius: 5px;
            right: 0; /* Position to the right */
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
        /* CSS for the table */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

.action-buttons {
        display: flex;
        justify-content: space-between;
        width: 200px; /* Adjust the width as needed */
        margin-top: 10px; /* Add margin for spacing */
    }

    /* Style for the accept button */
    .accept-button {
        background-color: #4B0082;
        color: white;
        padding: 8px 16px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    /* Style for the reject button */
    .reject-button {
        background-color: #FF6347;
        color: white;
        padding: 8px 16px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    /* Hover styles for buttons */
    .accept-button:hover, .reject-button:hover {
        opacity: 0.8;

/* Additional styles for buttons inside the table */
.submit-feedback {
    background-color: #4B0082;
    color: white;
    padding: 8px 16px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.submit-feedback:hover {
    background-color: #6A5ACD;
}

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Style for the user box */
        .user-box {
            display: flex;
            flex-direction: column; /* Display items in a column */
            background-color: #fff;
            padding: 20px; /* Increased padding */
            border-radius: 10px;
            margin-bottom: 20px;
            align-items: left; /* Center items horizontally */
        }

        /* Style for the user image */
        .user-image {
            width: 120px; /* Increased size */
            height: 120px; /* Increased size */
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px; /* Add space below the image */
        }

        /* Style for the user details */
        .user-details {
            display: flex;
            flex-direction: column;
            align-items: left; /* Center items horizontally */
        }

        /* Style for the labels */
        .label {
            font-size: 14px;
            color: #999;
        }

        /* Style for the username */
        .username {
            font-size: 24px; /* Increased size */
            color: #4B0082;
            margin-bottom: 10px; /* Add space below the username */
        }

        /* Style for the email */
        .email {
            font-size: 18px; /* Increased size */
            color: #555;
        }

        /* Rest of your styles */
    </style>
</head>
<body>
    <div class="sidebar">
        

        <a class="sidebar-button" href="service_provider.php">order request</a>
        <a class="sidebar-button" href="service_provider_pending_order.php">orders pending</a>
        <a class="sidebar-button" href="service_provider_order_history.php">History</a>
        <a class="sidebar-button" href="#">Notification</a>
        <a class="sidebar-button" href="logout.php">Logout</a>
    </div>

        <div class="content">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "work";
        
            $connection = mysqli_connect($servername, $username, $password, $dbname);
            // Get the service provider's ID from the session
            $serviceProviderId = $_SESSION['service_provider_id']; // Replace with the actual session variable name
        
            // Query to retrieve incomplete bookings for the service provider
            $bookingsQuery = "SELECT * FROM bookings WHERE service_provider_id = $serviceProviderId AND order_status = 'incomplete' ";
        
            // Execute the query
            $result = mysqli_query($connection, $bookingsQuery);
        
            if ($result) {
                echo "<h2>Pending Orders:</h2>";
                echo "<table>";
                echo "<tr><th>User ID</th><th>Booking ID</th><th>User Name</th><th>User Email</th><th>Booking Time</tr>";
        
                while ($row = mysqli_fetch_assoc($result)) {
                    $userId = $row['users_id'];
                    $bookingId = $row['booking_id'];
                    $bookingTime = $row['booking_time'];
        
                    // Query to retrieve user details
                    $userQuery = "SELECT * FROM users WHERE user_id = $userId";
                    $userResult = mysqli_query($connection, $userQuery);
                    
                    if ($userResult) {
                        $userData = mysqli_fetch_assoc($userResult);
        
                        echo "<tr>";
                        echo "<td>" . $userData['user_id'] . "</td>";
                        echo "<td>" . $bookingId . "</td>";
                        echo "<td>" . $userData['first_name'] . " " . $userData['last_name'] . "</td>";
                        echo "<td>" . $userData['email'] . "</td>";
                        echo "<td>" . $bookingTime . "</td>";
                        echo "</tr>";
        
                        // Free the user result set
                        mysqli_free_result($userResult);
                    } else {
                        echo "Error: " . $userQuery . "<br>" . mysqli_error($connection);
                    }
                }
        
                echo "</table>";
        
                // Free the booking result set
                mysqli_free_result($result);
            } else {
                echo "Error: " . $bookingsQuery . "<br>" . mysqli_error($connection);
            }
        
            // Close the database connection
            mysqli_close($connection);
            ?>
        </div>

</body>
</html>
