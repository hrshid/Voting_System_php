<?php 
include('connect.php');

// Collect form data
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$role = $_POST['role'];

// File upload handling
$photo = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];

// Set upload path
$upload_path = "../uploads/" . basename($photo);

// Check if passwords match
if ($password === $cpassword) {
    // Try moving the uploaded file
    if (move_uploaded_file($tmp_name, $upload_path)) {

        // Insert into database
        $insert = mysqli_query($connect, "INSERT INTO user (name, mobile, address, password, photo, role, status, votes) 
                                          VALUES ('$name', '$mobile', '$address', '$password', '$photo', '$role', 0, 0)");

        if ($insert) {
            echo '
            <script>
                alert("Registration Successful...");
                window.location = "../";
            </script>';
        } else {
            echo '
            <script>
                alert("Database insertion failed!");
                window.location = "../routes/registration.html";
            </script>';
        }

    } else {
        echo '
        <script>
            alert("Failed to upload image. Please check folder permissions.");
            window.location = "../routes/registration.html";
        </script>';
    }
} else {
    echo '
    <script>
        alert("Password and Confirm Password do not match!");
        window.location = "../routes/registration.html";
    </script>';
}
?>
