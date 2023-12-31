<?php
        $insert = false;
        // we will connect to the database here
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "To_Do";
        $port = 3307;

        $conn = mysqli_connect($host, $user, $password, $database, $port);

        if (!$conn){
          die("There is error while connecting to the database");
        }else{
          // echo "Database connected successfully";

          $insert = true;
          if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $title = $_POST['title'];
            $desc = $_POST['desc'];

            $sql = "INSERT INTO `notes` (`Title`, `Description`) VALUES ('$title', '$desc')";

            $result = mysqli_query($conn, $sql);
          }
          
        }
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TODO</title>
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">TO DO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <?php
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your Note has been added to the database.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>'
?>
  <div class="container my-3">
    <h2>Add a Note</h2>
    <form action="index.php" method = "post">
      <div class="mb-3">
        <label for="title" class="form-label">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
        <div id="emailHelp">
        </div>
        <div class="mb-3">
          <label for="desc" class="form-label">Example textarea</label>
          <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
  </div>
  <div class="container">
    <table class='table' id="myTable">
  <thead>
    <tr>
      <th scope='col'>Sr.No</th>
      <th scope='col'>Title</th>
      <th scope='col'>Description</th> 
      <th scope='col'>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $sql = "SELECT * FROM `notes`";

        $result = mysqli_query($conn, $sql);

        if (!$result){
          echo "Error while fetching data";
        }else{
          $num = mysqli_num_rows($result);
          $sno = 1;
          if ($num > 0){
            while ($row = mysqli_fetch_assoc($result)){
              echo " <tr>
              <td> " . $sno++ . " </td>
              <td> " . $row['Title'] . " </td>
              <td> " . $row['Description'] . " </td>
              <td> " . "Actions" . " </td>
            </tr> ";
            }
          }
        }
      ?>
      </tbody> </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js">
    </script>
    <script>
      let table = new DataTable('#myTable');
    </script>
</body>

</html>

