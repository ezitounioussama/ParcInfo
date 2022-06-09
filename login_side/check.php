<?php



if (isset($_POST['submit'])) {
    $log = $_POST['name'];
    $passe = $_POST['pass'];
    // $dbh = new PDO('mysql:host=localhost;dbname=webapp', $user = "root", $pass = "");
    include '../db/db.php';
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare('SELECT * FROM users WHERE CIN=? and pass=?');
    $parametres = array($log, $passe);
    $stmt->execute($parametres);
    if ($rs = $stmt->fetch()) {
        session_start();
        $_SESSION['droit'] = $rs;
        if ($rs['function'] == "admin") {
            header('location:../admin_interface/');
        } elseif ($rs['function'] == "user") {
            header('location:../user_interface/');
        }
    } else {
        header('location:../error.php');
    }
}
