<html>
<body>

<?php include $_SERVER['DOCUMENT_ROOT']."/common/head.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/common/navbar.php"; ?>

<div class="container-fluid text-center">    
  <div class="row content">

<?php include $_SERVER['DOCUMENT_ROOT']."/common/left.php"; ?>

<?php //Initialisation variables
if(isset($_POST['user'])) { $user = $_POST['user']; } else {$user="";}
if(isset($_POST['password'])) { $password = $_POST['password']; } else {$password="";}
if(isset($_POST['instance'])) { $instance = $_POST['instance']; } else {$instance="";}
if(isset($_POST['cmd'])) { $cmd = $_POST['cmd']; } else {$cmd="";}
?>

<center>
<h1>TSM administrative web client</h1>
<div><span class="required">*</span> : required fields</div>
</center>

<center>
<form action="test.php" method="post">

    <div class="form-group row">
        <label for="user" class="col-sm-3 form-control-label">user<span class="required"> *</span></label>
        <div class="col-sm-8">
            <input type="text" required name="user" class="form-control" id="user" title="Please enter a TSM user" value="<?php echo $user; ?>" placeholder="user" maxlength="">
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-sm-3 form-control-label">password<span class="required"> *</span></label>
        <div class="col-sm-8">
            <input type="password" required name="password" class="form-control" id="password" title="Please enter the password of your TSM user" value="<?php echo $password; ?>" placeholder="password" maxlength="">
        </div>
    </div>

    <div class="form-group row">
        <label for="instance" class="col-sm-3 form-control-label">instance <span class="required"> *</span></label>

        <div class="col-sm-8">
            <select name="instance" required class="form-control" id="instance">
                <option disabled selected>TSM instance</option>
                <?php
                    $connect->select_db($database);

                    $sql = "SELECT DISTINCT inst_nom FROM `instance` WHERE inst_status = 'ACTIF_G' and inst_acces = 'oui'";
                    $queryResult = $connect->query($sql);
                    while($row = $queryResult->fetch_row()) {
                        echo "<option" . ($instance == $row[0]? ' selected' : '') . "> $row[0] </option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="user" class="col-sm-3 form-control-label">cmd<span class="required"> *</span></label>
        <div class="col-sm-8">
            <input type="text" required name="cmd" class="form-control" id="cmd" title="Please enter a dsmadmc cmd" value="<?php echo $cmd; ?>" placeholder="cmd" maxlength="">
        </div>
    </div>

    <div id="formControl">
        <button type="submit" id="buttonValidate" class="btn btn-success">Validate</button>
        <button type="reset" id="buttonReset" class="btn btn-warning">Reset</button>
    </div>
</form>
</center>

<!-- <?php echo "dsmadmc -id=$user -pa=$password -se=$instance $cmd" ; ?> -->
<?php //Recuperation des variables
if ($user!="" && $password!="" && $instance!="" && $cmd!="") {
        $results = shell_exec("dsmadmc -id=$user -pa=$password -se=$instance \"$cmd\"");
        echo "<pre style=\"background-color:black;color:white\">".$results . "</pre>";
}
?>
<?php include $_SERVER['DOCUMENT_ROOT']."/common/right.php"; ?>

  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT']."/common/footer.php"; ?>

</body>
</html>
