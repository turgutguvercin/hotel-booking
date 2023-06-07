<?php
    ini_set("session.save_path", "/home/sessionData");
    session_start();

    require_once('functions.php');

    if (!isset($_SESSION['Login']) || !$_SESSION['Login']) {
        die("You need to login first!");
    }

    $conn = getConnection();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $reservationId = $_POST['reservation_id'];

        $sql = "DELETE FROM reservations WHERE reservation_id = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $reservationId);
            mysqli_stmt_execute($stmt);
        } else {
            echo "Could not prepare statement";
        }

        mysqli_close($conn);

        header('Location: myBookings.php');
        exit();
    }
?>