<?php
include("admin_header.php");
?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Data Tables</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Data</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Datatables</h5>
          <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Mobile</th>
                <th scope="col">Location</th>
                <th scope="col">Service</th>
                <th scope="col">Experiance</th>
                <th scope="col">Image</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              <tr>
              <th scope="row">1</th>
              <td>Rahul Sharma</td>
              <td>rahul.sharma@gmail.com</td>
              <td>+91 9876543210</td>
              <td>Mumbai</td>
              <td>Plumber</td>
              <td>7</td>
              <td>rahul.jpg</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Ajay Patel</td>
                <td>ajay.patel@gmail.com</td>
                <td>+91 9876543211</td>
                <td>Ahmedabad</td>
                <td>Mechanic</td>
                <td>5</td>
                <td>ajay.jpg</td>
              </tr>
              <tr>
                  <th scope="row">3</th>
                  <td>Rohith Singh</td>
                  <td>rohith.singh@gmail.com</td>
                  <td>+91 9876543212</td>
                  <td>Delhi</td>
                  <td>Carpenter</td>
                  <td>4</td>
                  <td>rohith.jpg</td>
                </tr>
                <th scope="row">4</th>
                <td>Amit Kumar</td>
                <td>amit.kumar@gmail.com</td>
                <td>+91 9876543213</td>
                <td>Kolkata</td>
                <td>Electrician</td>
                <td>6</td>
                <td>amit.jpg</td>
              </tr>
              <tr>
                <th scope="row">5</th>
                <td>Govind Desai</td>
                <td>govind.desai@gmail.com</td>
                <td>+91 9876543214</td>
                <td>Chennai</td>
                <td>Painter</td>
                <td>3</td>
                <td>govind.jpg</td>
              </tr>
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->



<?php include("admin_footer.php"); ?>