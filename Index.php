<html>
<meta http-equiv="Content-Type"'.' content="text/html; charset=utf8"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head>
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="style.css" rel="stylesheet">
	<style>
.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script>
function update(id)
{
    $.ajax({
          url:'flagUpdate.php',
          type:'post',
          data:{uid : BookID},
          success:function(data){
			window.location.reload();
          },
          error:function(data, textStatus, jQxhr){
            alert(jQxhr);
          }
         });
}
</script>
</head>
<body>
<?php
session_start();
	if(isset($_POST['ac'])){
		$servername = "localhost";
		$username = "root";
		$password = "";

		$conn = new mysqli($servername, $username, $password);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "USE bookstore";
		$conn->query($sql);

		$sql = "SELECT * FROM book WHERE BookID = '".$_POST['ac']."'";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()){
			$bookID = $row['BookID'];
			$quantity = $_POST['quantity'];
			$price = $row['Price'];
		}

		$sql = "INSERT INTO cart(BookID, Quantity, Price, TotalPrice) VALUES(".$bookID.", ".$quantity.", ".$price.", Price * Quantity)";
		$conn->query($sql);
	}

	if(isset($_POST['delc'])){
		$servername = "localhost";
		$username = "root";
		$password = "";

		$conn = new mysqli($servername, $username, $password);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "USE bookstore";
		$conn->query($sql);

		$sql = "DELETE FROM cart";
		$conn->query($sql);
	}

	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "USE bookstore";
	$conn->query($sql);	

	$sql = "SELECT * FROM book";
	$result = $conn->query($sql);
?>	

<?php
if(isset($_SESSION['id'])){
	echo '<header>';
	echo '<blockquote>';
	//echo '<form class="hf" action="logout.php"><input class="hi" type="submit" name="submitButton" value="Logout"></form>';
	echo '
</head>
<body>
<a href="index.php"><img src="image/logo.png"></a><table style="float:right; border-collapse:separate; border-spacing: 10px;">
 <th> <div class="dropdown"> <button class="dropbtn hi">Profile</button>
  <div class="dropdown-content">
    <a href="edituser.php">Edit Profile</a>
    <a href="logout.php">Log Out</a>

<th><form class="hf" action="cart.php"><input class="dropbtn hi" type="submit" name="submitButton" value="cart"></form></th></th></table></div>';
	echo '</blockquote>';
	echo '</header>';
}


	
if(!isset($_SESSION['id'])){
	echo '<header>';
	echo '<blockquote>';
	//echo '<form class="hf" action="logout.php"><input class="hi" type="submit" name="submitButton" value="Logout"></form>';
	echo '
</head>
<body>
<a href="index.php"><img src="image/logo.png"></a><table style="float:right; border-collapse:separate; border-spacing: 10px;">
 <th> <div class="dropdown"> <button class="dropbtn hi">Profile</button>
  <div class="dropdown-content">
    <a href="login.php">Login</a>
    <a href="register.php">Registration</a>

<th><form class="hf" action="cart.php"><input class="dropbtn hi" type="submit" name="submitButton" value="cart"></form></th></th></table></div>';
	echo '</blockquote>';
	echo '</header>';
}
echo '<blockquote>  
            <div class="row p-3">';
    while($row = $result->fetch_assoc()) {
	    
	echo ' <div class="col-lg-2 col-md-2 col-sm-2 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
								<img class="img-fluid w-100" src="'.$row["Image"].'" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">'.$row["BookTitle"].'</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>'.$row["Price"].'</h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                <a class="btn btn-sm text-dark p-0" value="'.$row['BookID'].'"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                            </div>
						</div>
			</div>';
    }
      echo '</div>';
?>
</body>
</html>