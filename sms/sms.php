<html>
<body>

<?php include $_SERVER['DOCUMENT_ROOT']."/common/head.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/common/navbar.php"; ?>

<div class="container-fluid text-center">    
  <div class="row content">

<?php include $_SERVER['DOCUMENT_ROOT']."/common/left.php"; ?>
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
?>  
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
         ?> 
      <hr>
      </div>
     <div class="col-sm-6 text-left">
      <h1>Outbox</h1>
         <?php
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
         ?>
      <hr>
      </div>
  </div>

<?php
              $sql = "SELECT DestinationNumber as Number FROM `sentitems` union SELECT SenderNumber as Number FROM `inbox`";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  // output data of each row
                while($row = $result->fetch_assoc()) {
                   $Number[] = $row['Number']; // Inside while loop
                }
              } else {
                 echo "0 results";
              }
foreach ($Number as $value) {
	echo "Number : $value<br />\n";
}
?>
<?php $conn->close(); ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/common/right.php"; ?>

  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT']."/common/footer.php"; ?>

</body>
</html>

