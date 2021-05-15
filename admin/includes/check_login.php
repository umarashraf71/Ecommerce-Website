<?php

function check_login()
{

    if(strlen($_SESSION['admin_username']) == 0 && strlen($_SESSION['admin_login']) == 0)
	{	
		$HOST = $_SERVER['HTTP_HOST'];

		$URI  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		
        $redirectPage="login.php";		
		
        $_SESSION["username"]="";
		
        header("Location: http://$HOST$URI/$redirectPage");
	}
}

?>