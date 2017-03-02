<?php
$pass = filter_input(INPUT_POST, 'password');
	$passconf = filter_input(INPUT_POST, 'passwordconf');
	$login = filter_input(INPUT_POST, 'login');
	$email = filter_input(INPUT_POST, 'email');
	if (!$pass || !$passconf || !$login || !$email) {
	    $message = "No data";
	} else if ($pass !== $passconf) {
	    $message = "incorrect password confirm";
	} else {
	    $db_connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	    if (!$db_connect) {
		$message = "db_connect error";
	    } else {
		if (user_exists($login, $db_connect)) {
		    $message = "login already exists";
		} else if (!register_user($login, $pass, $email, $db_connect)) {
		    $message = "register error:" . mysqli_error($db_connect); //выводим сообщение об ошибке СУБД
		} else {
		    $message = "register confirm";
		}
		mysqli_close($db_connect);
	    }
	}