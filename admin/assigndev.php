<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 01/04/2017
 * Time: 11:24
 */
// Inialize session
session_start();
include '../connection/db.php';
$username=$_SESSION['logname'];

$result1 = mysqli_query($con, "SELECT * FROM login_table WHERE login_username='$username'");

while($res = mysqli_fetch_array($result1))
{
    $name= $res['login_name'];
}

// Check, if user is already login, then jump to secured page
if (isset($_SESSION['logname']) && isset($_SESSION['rank'])) {
    switch($_SESSION['rank']) {

        case 2:
            header('location:../user/index.php');//redirect to  page
            break;

    }
}
else
{

    header('Location:index.php');
}

$username=$_SESSION['logname'];
if (isset($_SESSION['userSession'])!="") {
    header("Location: login.php");
}
require_once '../connection/db.php';

if(isset($_POST['register'])) {

    $animal_device_animal_id= $_POST['animal_device_animal_id'];
    $animal_device_device_id= $_POST['animal_device_device_id'];


    //$hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version

    $check_ = $con->query("SELECT animal_device_id FROM animal_device_table WHERE animal_device_id='$animal_device_id'");
    $count=$check_->num_rows;

    if ($count==0) {

        $query = "INSERT INTO animal_device_table(animal_device_animal_id,animal_device_device_id) VALUES('$animal_device_animal_id','$animal_device_device_id')";

        if ($con->query($query)) {
            $msg = "<div class='alert alert-success'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
					</div>";
        }else {
            $msg = "<div class='alert alert-danger'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
					</div>";
        }

    } else {


        $msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry email already taken !
				</div>";

    }

    $con->close();
}
?>

<?php include 'header.php'; ?>
    <!--********************Add content here *******************-->
    <form action="" method="post">
        <!--<div class="body bg-gray">-->
        <?php
        if (isset($msg)) {
            echo $msg;
        }
        ?>
        <div class="form-group">
            <label>Animal ID:</label>
            <select name="animal_device_animal_id" required class="form-control">
                <option selected="">...Select ID...</option>
                <?php
                //include("../connection/db.php");
                $query = "SELECT * FROM animal_table";
                $result = mysqli_query($con,$query);
                while($row = mysqli_fetch_array($result))
                {
                    $animal_id=$row[animal_id];

                    echo "<option>$animal_id</option>";
                }
                ?>
            </select>
            <a href="javascript:window.open('reganimal.php','mypopuptitle','width=600,height=400')">Add ID</a>
        </div>
        <div class="form-group">
            <label>Device ID:</label>
            <select name="animal_device_device_id" required class="form-control">
                <option selected="">...Select ID...</option>
                <?php
                //include("../connection/db.php");
                $query = "SELECT * FROM device_table  WHERE device_id NOT IN (SELECT animal_device_device_id FROM animal_device_table)";
                $result = mysqli_query($con,$query);
                while($row = mysqli_fetch_array($result))
                {
                    $device_id = $row[device_id];

                    echo "<option>$device_id</option>";
                }
                ?>
            </select>
            <a href="javascript:window.open('addevice.php','mypopuptitle','width=600,height=400')">Add Device</a>
        </div>

        <!--</div>-->
        <div class="footer">

            <button type="submit" name="register" class="Button btn bg-olive ">Register</button>
        </div>
        <br>
        <small style="color: red"><i>** You can't assign one device twice</i></small>
    </form>
    <!--********************Add content here *******************-->
<?php include 'footer.php';?>