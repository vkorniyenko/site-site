<?php

/**
 * function registration user
 * @param string $login
 * @param string $password
 * @param string $email
 * @param resource $db_connect
 * @return boolean
 */
function register_user($login, $password, $email, $db_connect) {
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (login, password, email) VALUES"
	    . "('$login', '$pass_hash', '$email')";
    $result = mysqli_query($db_connect, $query);
    return $result;
}

/**
 * ПРоверка существования пользователя в базе
 * @param string $login
 * @param resource $db_connect
 * @return boolean
 * true если пользователь найден
 */
function user_exists($login, $db_connect) {
    $query = "SELECT id FROM users WHERE login like '$login' LIMIT 1";
    $result = mysqli_query($db_connect, $query);
    if (mysqli_fetch_assoc($result)) {
	return true;
    } else {
	return false;
    }
}

/**
 * Проверяет логин пароль и записывает логин в сессию
 * @param string $login
 * @param string $password
 * @param resource $db_connect
 * @return boolean
 */
function auth_user($login, $password, $db_connect) {
    $query = "SELECT * FROM users WHERE login like '$login' LIMIT 1;";
    $result = mysqli_query($db_connect, $query);
    if (!$result) {
	return false;
    } else if (!($user = mysqli_fetch_assoc($result))) {
	return false;
    } else {
	if (password_verify($password, $user['password'])) {
	    $_SESSION['user'] = $login;
	    return true;
	} else {
	    return false;
	}
    }
}

/**
 * session destroy
 */
function logout() {
    unset($_SESSION['user']);
    session_destroy();
}

/**
 * получаем логин из сессии
 * @return boolean
 */
function get_user_login() {
    if (is_auth()) {
	return $_SESSION['user'];
    } else {
	return false;
    }
}

/**
 * Проверка пользователя в сессии
 * @return boolean
 */
function is_auth() {
    if (!empty($_SESSION['user'])) {
	return true;
    } else {
	return false;
    }
}

/**
 * 
 * @param type $db_host
 * @param type $db_user
 * @param type $db_pass
 * @param type $db_name
 * @return type
 */
function check_forms($db_host, $db_user, $db_pass, $db_name) {
    $message = null;
    if (isset($_POST['register'])) {
	include_once 'regfunc.php';
    }
    if (isset($_POST['auth'])) {
	include_once 'authfunc.php';
    }
    if(isset($_POST['logout'])){
	logout();
    }
    return $message;
}

