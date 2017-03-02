<?php

$pass = filter_input(INPUT_POST, 'password');
	$login = filter_input(INPUT_POST, 'login');
	if (!$pass || !$login) {
	    $message = "No data";
	} else {
	    $db_connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	    if (!$db_connect) {
		$message = "db_connect error";
	    } else {
		if (!auth_user($login, $pass, $db_connect)) {
		    $message = "incorrect login or password";
		}
		mysqli_close($db_connect);
	    }
	}
