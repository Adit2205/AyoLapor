<?php

require '../../public/app.php';

// Check if ID and status are provided
if(isset($_GET['id']) && isset($_GET['status'])) {
    $id_pengaduan = $_GET['id'];
    $status = $_GET['status'];

    // Update status in the database
    $update_query = "UPDATE pengaduan SET status = '$status' WHERE id_pengaduan = $id_pengaduan";
    $update_result = mysqli_query($conn, $update_query);

    if($update_result) {
        // Redirect back to the page where the user came from
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        echo "Failed to update status.";
    }
} else {
    echo "ID and status are required.";
}
