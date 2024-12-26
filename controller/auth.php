<?php
session_start();

include '../database/auth.php';

$auth = new Auth();

$action = $_GET['action'];

if ($action == "login") {
    $result = $auth->login(
        $_POST['email'],
        $_POST['password']
    );

    if ($result) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['id'] = $result['id'];
        $_SESSION['name'] = $result['name'];
        return header("location:../");
    }
    
    return header("location:../login.php");
}
else if ($action == "register") {
    $auth->register(
        $_POST['name'],
        $_POST['email'],
        $_POST['password']
    );

    return header("location:../login.php");
} 
else if ($action == "logout") {  // Add this block for logout
    session_start();
    // Menghapus semua sesi
    session_unset();
    session_destroy();
    // Redirect ke halaman login
    return header("location:../login.php");
}
