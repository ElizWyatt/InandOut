<!doctype html>
<html lang="en">
  <head>
    <title>InOut</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/inout.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Monoton&family=Righteous&display=swap" rel="stylesheet">



</head>
    <!-- Bootstrap CSS -->
  
  <body style="background-image: url(https://i.pinimg.com/originals/66/fe/3f/66fe3fb9d3f51c1a781d45a32ab39935.jpg); background-repeat: repeat; background-size: 125%; opacity: 0.8;">
      
<div class="container">
    <div class="row">
      <div class="col-md-12">
      
    <h1 class="title">Are you In or Out?</h1>

      <br>
      <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          
            <th>Employee</th>
            <th class="text-center">In</th>
            <th class="text-center">Out</th>
            <th>Message</th>
  
        </thead>
        <tbody>


<?php

$servername = "localhost";
$username = "portfolio226";
$password = "Kaizoku28";
$dbname = "portfolio226";



if(isset($_POST['message'])) {

$_POST['message'] = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE io_employees SET message ='{$_POST['message']}' WHERE userid={$_POST['userid']}";

if (mysqli_query($conn, $sql)) {

} else {
echo "Error updating record: " . mysqli_error($conn);
}
}


// Change In Out Status

if(isset($_GET['io'])) {
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE io_employees SET io ='{$_GET['io']}' WHERE userid={$_GET['userid']}";

if (mysqli_query($conn, $sql)) {

} else {
echo "Error updating record: " . mysqli_error($conn);
}
}




// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM io_employees";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($result)) {
?>
<tr>
<td class="align-middle lead"><?=$row['user']?></td>
<? if($row['io'] == '0') { ?>
<td class="text-center"><a href="index.php?userid=<?=$row['userid']?>&io=1"><img src="images/circle_green.png" class="hidden"></a></td>
<td class="text-center"><img src="images/circle_red.png"></td>
<? } else { ?>
<td class="text-center"><img src="images/circle_green.png"></td>
<td class="text-center"><a href="index.php?userid=<?=$row['userid']?>&io=0"><img src="images/circle_red.png" class="hidden"></a></td>
<? } ?>
<td>
<? if($row['message'] != '') { ?>
<a data-toggle="collapse" href="#collapse<?=$row['userid']?>" aria-expanded="false" aria-controls="collapse<?=$row['userid']?>" style="color:#000000;">
<?=$row['message']?>
</a>
<? } else {?>
<a data-toggle="collapse" href="#collapse<?=$row['userid']?>" aria-expanded="false" aria-controls="collapse<?=$row['userid']?>" class="text-muted float-right" style="text-decoration-style: dashed;font-style: italic;font-size:12px;text-decoration: underline;"><i class="far fa-edit"></i></a>
<? } ?>


</p>
<div class="collapse" id="collapse<?=$row['userid']?>">
<div>
	<form action="index.php" method="POST">
	<input type="text" name="message" value="<?=$row['message']?>">
	<input type="hidden" name="userid" value="<?=$row['userid']?>">
	<input class="btn btn-secondary btn-md" style="padding:0 4px;" type="submit" value="Submit">
	</form>
</div>
</div>



</td>
</tr>
<?
}
} else {
echo "0 results";
}

mysqli_close($conn);
?>




</tbody>
</table>
</div>
</div>
</div>
</div>
</body>
</html>
