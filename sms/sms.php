<html>
<body>

<?php include $_SERVER['DOCUMENT_ROOT']."/common/head.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/common/navbar.php"; ?>

<div class="container-fluid text-center">    
  <div class="row content">

<?php include $_SERVER['DOCUMENT_ROOT']."/common/left.php"; ?>
<?php 
$array_get = array("to", "message", "token", "submit");

foreach ($array_get as $value){
   if(isset($_GET[$value])) { $$value = $_GET[$value];}
}
?>

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
	<form action="./sms.php" method="get">
	<input type="text" name="message" title="Type your message here" placeholder="blablabla">
	<input type="text" name="to" title="Type the phone number here" placeholder="0669671360">
	<input type="text" name="token" title="Type the secret password to send sms" placeholder="secret">
	<button type="submit" name="submit" value="1" class="btn btn-success">Validate</button>
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
<div class="col-sm-4 text-left"> 
      <h1>Debug div</h1>
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
print_r($_GET);
?>
</div>
  </div>

<?php $conn->close(); ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/common/right.php"; ?>

  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT']."/common/footer.php"; ?>

</body>
</html>

