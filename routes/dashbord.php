<?php 

    //this concept is use set a condition and condition is define a first login then open a dashbord otherwise not open so this concept in main purpuse of security.
    session_start();
    if(!isset($_SESSION['userdata']))
    {
        header("location: ../");
    }

    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];

    if($userdata['status'] == 0)
    {
        $status = '<b style="color: red;">Not Voted..</b>';
    }
    else
    {
        $status = '<b style="color: Green;">Voted..</b>';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashbord</title>
    <link rel="stylesheet" href="../css/dashbord.css">
</head>
<body>
    <div id="mainsection">
        <div id="headerselection">
            <a href="../"><button id="backbtn">BACK</button></a>
            <a href="logout.php"><button id="logoutbtn">LOGOUT</button></a>
        <h1>Online Voting System</h1>
        </div>

        <hr>

        <div id="mainpanel">
            <div id="profile">
                <center><img src="../uploads/<?php echo $userdata['photo'] ?>" height="150" width="150" ></center><br><br>
                <b>NAME : </b><?php echo $userdata['name']; ?> <br><br>
                <b>MOBILE : </b><?php echo $userdata['mobile']; ?> <br><br>
                <b>ADDRESS : </b><?php echo $userdata['address']; ?> <br><br>
                <b>ROLE : </b><?php 
                if((int)$userdata['role'] === 1)
                    {
                        echo "VOTER";
                    } 
                elseif((int)$userdata['role'] === 2)
                {
                    echo "GROUP";
                }
                else
                {
                    echo "UNKNOWN";
                }
                ?> <br><br>
                <b>STATUS : </b><?php echo $status ?> <br><br>

            </div>
            <div id="group">
                <?php 
                    if($_SESSION['groupsdata'])
                    {
                        for($i = 0; $i < count($groupsdata); $i++)
                        {
                            // stop php code and write html 
                            ?>
                            <div>
                                <img style="float: right;" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" alt="Group Images" height="100px" width="100px" > <br><br>
                                <b>group Name : </b> <?php echo $groupsdata[$i]['name']; ?> <br><br>
                                <b>Votes : </b> <?php echo $groupsdata[$i]['votes']; ?> <br><br>
                                <form action="../api/vote.php" method="POST">
                                    <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']; ?>">
                                    <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']; ?>">
                                    <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                </form>
                            </div><br>
                            <hr><br>

                            <!-- start php code and stop html code -->
                            <?php
                        }
                    }
                    else
                    {

                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>