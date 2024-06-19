<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <title>Services</title>
  <style>
    body {
      background-color: #222222;
      color: #fff;
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    .service-category {
      margin-bottom: 20px;
    }

    .account-icon {
      text-align: right;
      margin-top: 0px; /* Add some top margin to separate it from the heading */
      display: inline-block; /* Display the icon inline with the search form */
    }

    .account-icon a {
      color: white;
      text-decoration: none;
      font-size: 44px;
      margin-left: 0px; /* Add some space between the heading and the icon */
      
    }

    .account-icon a:hover {
      color: #c0392b; /* Change color on hover */
    }

    .service-category h3 {
      margin: 10px 0;
      color: #3498db;
      font-size: 35px;
      text-transform: capitalize;
    }

    .service-cards {
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-start;
      gap: 20px; /* Adjust the spacing between cards */
    }

    .service-card {
      background-color: #c10e0e;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
      flex-basis: calc(33.33% - 20px);
      box-sizing: border-box;
      position: relative;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .service-card:hover {
      transform: scale(1.05);
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
    }

    .service-card h3 {
      margin-top: 0;
      color: #fff;
      font-family: "Arial", sans-serif;
      font-weight: bold;
      text-align: center;
    }

    .service-card p {
      margin-bottom: 10px;
      color: #ccc;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .search-form {
      
      align-items: center;
      display: flex;
      
    }

    .search-form input[type="text"] {
      width: 300px;
      padding: 10px;
      border: none;
      border-radius: 5px 0 0 5px;
      height: 25px;
      margin-bottom: 10px;
    }

    .search-form button[type="submit"] {
      display: inline-block;
      background-color: #e74c3c;
      color: #fff;
      font-size: 18px;
      padding: 8px 20px; /* Adjust the button padding */
      border: none;
      border-radius: 0 5px 5px 0;
      text-decoration: none;
      transition: background-color 0.3s ease;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      height: 45px; /* Adjust the button height to match the input field */
      
    }

    .search-form button[type="submit"]:hover {
      background-color: #c0392b;
    }

    .search-form button[type="submit"]:active {
      transform: translateY(2px);
      box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.2);
    }

    .image-circle {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      overflow: hidden;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #fff;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    }

    .image-circle img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

    .book-service-button {
      display: inline-block;
      background-color: #e74c3c;
      color: #fff;
      font-size: 16px;
      padding: 10px 20px;
      border: none;
      border-radius: 50px;
      text-decoration: none;
      transition: background-color 0.3s ease;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
      cursor: pointer;
    }

    .book-service-button:hover {
      background-color: #c0392b;
    }

    .book-service-button:active {
      transform: translateY(2px);
      box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.2);
    }

    .search-suggestions {
      width: 300px; /* Set the width of the suggestion box */
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 5px;
      position: absolute;
      z-index: 1;
      max-height: auto;
      display: none; /* Initially hide the suggestions */
      margin-top: 100px;
    }

    

    .search-suggestions p {
      margin: 5px 0;
      padding: 5px;
      color: black;
      cursor: pointer;
    }

    .search-suggestions p:hover {
      background-color: #e9e9e9;
    }
  </style>

<script>
  function redirectToBookingPage(serviceProviderId) {
    window.location.href = 'booking.php?service_provider_id=' + serviceProviderId; 
  }

  function showSuggestions(str) {
      if (str.length == 0) {
        document.getElementById("searchSuggestions").innerHTML = "";
        document.getElementById("searchSuggestions").style.display = "none";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("searchSuggestions").innerHTML = this.responseText;
            document.getElementById("searchSuggestions").style.display = "block";
          }
        };
        xmlhttp.open("GET", "live-suggestions.php?q=" + str, true);
        xmlhttp.send();
      }
    }

    function selectSuggestion(value) {
      document.getElementById("searchQuery").value = value;
      document.getElementById("searchSuggestions").innerHTML = "";
      document.getElementById("searchSuggestions").style.display = "none";
    }

</script>


</head>

<body>
  <div class="container">
    

    <div class="container">
    <h2>Services</h2>
    <div class="header">
    <div class="search-form">
      <form action="services.php" method="GET">
        <input type="text" id="searchQuery" name="search_query" placeholder="Search by service name" onkeyup="showSuggestions(this.value)">
        <button type="submit">Search</button>
      </form>
      <div class="search-suggestions" id="searchSuggestions"></div>
    </div>

    <div class="account-icon">
      <a href="account.php">
        <i class="fas fa-user-circle"></i>
      </a>
    </div>
  </div>

    <?php
    
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

    // Query the database to retrieve service names
    $query = "SELECT DISTINCT service_name FROM service_providers where status = 'active'";
    $result = mysqli_query($connection, $query);
    //$serviceNames = mysqli_fetch_assoc($result);
    $serviceNames = array();

while ($row = mysqli_fetch_assoc($result)) {
  $serviceNames[] = $row; 
}
    // Search functionality
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      $searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';

      // Modify your query to search for service providers based on the search query
      $searchQuery = mysqli_real_escape_string($connection, $searchQuery);
      $searchQuery = '%' . $searchQuery . '%';
      $query = "SELECT * FROM service_providers WHERE service_name LIKE '$searchQuery' and status = 'active'";
      $result = mysqli_query($connection, $query);
      $serviceProviders = array();

while ($row = mysqli_fetch_assoc($result)) {
  $serviceProviders[] = $row;
}
}
if (empty($serviceNames)) {
  echo "<p>All of our service providers are bussy please try again later.</p>";
} else {
  foreach ($serviceNames as $serviceName) :
    if (isset($serviceProviders) && count($serviceProviders) > 0) :
      $hasResults = false;
      foreach ($serviceProviders as $serviceProvider) :
        if ($serviceProvider['service_name'] === $serviceName['service_name']) :
          if (!$hasResults) :
  ?>
            <div class="service-category">
              <h3><?php echo ucfirst(str_replace('_', ' ', $serviceName['service_name'])); ?></h3>
              <div class="service-cards">
                <?php $hasResults = true; ?>
              <?php endif; ?>
              <div class="service-card">
                <!-- ... rest of your code for service cards ... -->
                <div class="image-circle">
              <img src="<?php echo $serviceProvider['image']; ?>" alt="Service Provider Image">
            </div>
            <h3><?php echo $serviceProvider['company_name']; ?></h3>
            <p><strong>Location:</strong> <?php echo $serviceProvider['location']; ?></p>
            <p><strong>Working Hours:</strong> <?php echo $serviceProvider['working_start_time'] . ' - ' . $serviceProvider['working_end_time']; ?></p>
            <p><strong>Minimum Charge:</strong> <?php echo $serviceProvider['minimum_charge']; ?></p>
            <p><strong>Experience:</strong> <?php echo $serviceProvider['experience']; ?></p>
            <button class="book-service-button" onclick="redirectToBookingPage(<?php echo $serviceProvider['service_provider_id']; ?>)">Book Service</button>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
          <?php if ($hasResults) : ?>
            </div>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    <?php endforeach; ?>
<?php } ?>


  </div>
</body>
</html>