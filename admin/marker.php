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

    $name= $_POST['name'];
    $address= $_POST['address'];
    $lat= $_POST['lat'];
    $lng= $_POST['lng'];
    $type= $_POST['type'];


    //$hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version

    $check_ = $con->query("SELECT animal_device_id FROM animal_device_table WHERE animal_device_id='$animal_device_id'");
    $count=$check_->num_rows;

    if ($count==0) {

        $query = "INSERT INTO markers(name,address,lat,lng,type) 
VALUES('$name','$address','$lat','$lng','$type')";

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
            <label>Animal tag-name:</label>
            <select name="name" required class="form-control">
                <option selected="">...Select ID...</option>
                <?php
                //include("../connection/db.php");
                $query = "SELECT * FROM animal_table";
                $result = mysqli_query($con,$query);
                while($row = mysqli_fetch_array($result))
                {
                    $animal_name=$row[animal_name];

                    echo "<option>$animal_name</option>";
                }
                ?>
            </select>
            <a href="javascript:window.open('reganimal.php','mypopuptitle','width=600,height=400')">.....add</a>
        </div>
        <div class="form-group">
            <label>Location Address:</label>
            <input type="text" style="color: rebeccapurple" class="form-control" name="address">
        </div>
        <div class="form-group">
            <label>Type:</label>
            <select style="color: rebeccapurple" class="form-control" name="type" required>
                <option> </option>
                <option> Mammals</option>
                <option> Reptiles</option>
                <option> Birds</option>
                <option> Insects</option>
                <option> Aquatic_Animals</option>
            </select>
        </div>
        <div class="form-group">
            <label>Latitude:</label>
            <input type="text" style="color: rebeccapurple" class="form-control" name="lat">
        </div>
        <div class="form-group">
            <label>Langitude:</label>
            <input type="text" style="color: rebeccapurple" class="form-control" name="lng">
        </div>

        <!--</div>-->
        <div class="footer">

            <button type="submit" name="register" class="Button btn bg-olive ">Register</button>
        </div>
        <br>
        <small style="color: red"><i>** Use accurate figures for better output</i></small>
    </form>
    <!--********************Add content here *******************-->
<?php include 'footer.php';?>