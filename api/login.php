<?php 
    //start the session
    session_start();

    //connect the database
    include('connect.php');

    //collect the data
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    //fire query
    $check = mysqli_query($connect, "SELECT * from user WHERE mobile='$mobile' AND password='$password' AND role='$role' ");

    //check the values and conditions 
    if(mysqli_num_rows($check) > 0)
    {
        $userdata = mysqli_fetch_array($check);
        $groups = mysqli_query($connect, "SELECT * FROM user WHERE role=2 ");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

        //create a session
        $_SESSION['userdata'] = $userdata;
        $_SESSION['groupsdata'] = $groupsdata;

            echo '
                <script>
                    window.location = "../routes/dashbord.php";
                </script>';
    }
    else
    {
        echo '
            <script>
                alert("Mobile Number Or Password Does Not Match...!");
                window.location = "../index.html";
            </script>';
    }

?>