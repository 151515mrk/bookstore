
<?php 

    $id = $_POST['uid'];
    $servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "USE bookstore";
	$conn->query($sql);	
----------------------------------
	  $sql = "UPDATE account set flag ='1' WHERE id = ? ";

	  // Prepare statement
	  $stmt = $conn->prepare($sql);

	  // execute the query
	  $stmt->bind_param("i", $id);
		$stmt->execute();
	  

	mysqli_close($conn);
?>
