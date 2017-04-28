<?php 

function isActive($requestUri)
{
 	$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

	if ($current_file_name == $requestUri) {
		$class="active";
	} else {
		$class="";
	} 
	echo '<li class='.$class.'><a href="../'.$requestUri.'/'.$requestUri.'.php">';
		
}

?>

<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
			<a class="navbar-brand" href="#">Logo</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<?=isActive("home")?>Home</a></li>
				<?=isActive("about")?>About</a></li>
				<?=isActive("projects")?>Projects</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			</ul>
		</div>
	</div>
</nav>
