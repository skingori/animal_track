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


    $animal_id_= $_POST['animal_id'];
    $animal_name_= $_POST['animal_name'];
    $animal_description_= $_POST['animal_description'];


    //$hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version

    $check_ = $con->query("SELECT animal_id FROM animal_table WHERE animal_id='$animal_id_'");
    $count=$check_email->num_rows;

    if ($count==0) {

        $query = "INSERT INTO animal_table(animal_id,animal_name,animal_description) VALUES('$animal_id_','$animal_name_','$animal_description_')";

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
            <input type="text" name="animal_id" required class="form-control" placeholder="Animal ID"/>
        </div>
        <div class="form-group">
            <input type="text" name="animal_name" required class="form-control" placeholder="Animal Tag Name"/>
        </div>
        <div class="form-group">
            <input type="text" name="animal_description" required class="form-control" placeholder="Description"/>
        </div>

        <!--</div>-->
        <div class="footer">

            <button type="submit" name="register" class="Button btn bg-olive ">Register</button>
        </div>
    </form>
    <!--********************Add content here *******************-->
<?php include 'footer.php';?>