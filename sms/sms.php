<html>
<body>

<?php include $_SERVER['DOCUMENT_ROOT']."/common/head.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/common/navbar.php"; ?>

<div class="container-fluid text-center">    
  <div class="row content">

<?php include $_SERVER['DOCUMENT_ROOT']."/common/left.php"; ?>
  
  <div class="col-sm-8 text-left"> 
      <h1>SMS</h1>
      <p>Welcome to the SMS GUI</p>
	<form action="./script.php" method="get">
	<input type="text" name="message">
	<input type="text" name="number">
	<input type="text" name="token">
	<input type="submit" value="exec">
	</form>
     <div class="col-sm-6 text-left"> 
      <h1>Inbox</h1>
         <?php
              $servername = "localhost";
              $username = "smsd";
              $password = "password";
              $dbname = "smsd";
   
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }

              $sql = "SELECT ReceivingDateTime,SenderNumber,TextDecoded FROM `inbox` order by SenderNumber,ReceivingDateTime";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                      echo "[" . $row["ReceivingDateTime"]. "] [" . $row["SenderNumber"]. "]: " . $row["TextDecoded"]. "<br>";
              }
              } else {
                 echo "0 results";
              }
              $conn->close();
         ?> 
      <hr>
      </div>
     <div class="col-sm-6 text-left">
      <h1>Outbox</h1>
         <?php
              $servername = "localhost";
              $username = "smsd";
              $password = "password";
              $dbname = "smsd";

              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }

              $sql = "SELECT SendingDateTime,DestinationNumber,TextDecoded FROM `sentitems` order by DestinationNumber,SendingDateTime";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                      echo "[" . $row["SendingDateTime"]. "] [" . $row["DestinationNumber"]. "]: " . $row["TextDecoded"]. "<br>";
              }
              } else {
                 echo "0 results";
              }
              $conn->close();
         ?>
      <hr>
      </div>
  </div>

<?php
              $servername = "localhost";
              $username = "smsd";
              $password = "password";
              $dbname = "smsd";

              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }

              $sql = "SELECT DestinationNumber as number FROM `sentitems` union SELECT SenderNumber FROM `inbox`";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  // output data of each row
                while($row = $result->fetch_assoc()) {
                   $number[] = $row['number']; // Inside while loop
                }
              } else {
                 echo "0 results";
              }
              $conn->close();
foreach ($number as $value) {
	echo "Valeur : $value<br />\n";
}
?>

<?php include $_SERVER['DOCUMENT_ROOT']."/common/right.php"; ?>

  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT']."/common/footer.php"; ?>

</body>
</html>

