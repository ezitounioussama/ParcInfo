<?php



if (isset($_POST['submit'])) {
    $log = $_POST['name'];
    $passe = $_POST['pass'];
    $cin = $_POST['cin'];
    // $dbh = new PDO('mysql:host=localhost;dbname=webapp', $user = "root", $pass = "");
    include 'db/db.php';
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare('SELECT * FROM users WHERE  CIN=? and username=? and pass=?');
    $parametres = array($cin, $log, $passe);
    $stmt->execute($parametres);
    if ($rs = $stmt->fetch()) {
        session_start();
        $_SESSION['droit'] = $rs;
        $_SESSION['username'] = $log;
        $_SESSION['info'] = $cin;
        if ($rs['function'] == "admin") {
            header('location:admin_interface/inc/home.php');
        } elseif ($rs['function'] == "user") {
            header('location:user_interface/inc/home.php');
        }
    } else {
        header('location:error.php');
    }
}
