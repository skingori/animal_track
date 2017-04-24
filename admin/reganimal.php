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


$result1 = mysqli_query($con, "SELECT * FROM login_table WHERE login_username='$username'");

while($res = mysqli_fetch_array($result1))
{
    $name= $res['login_name'];
}

//Alow editing
    $isEditDisabled = true;
    $isAddDisabled= true;

    if (isset($_GET['edit'])) {
        $isEditDisabled = false;

        $edit = $_GET['edit'];
        //selecting data associated with this particular id
        $result = mysqli_query($con, "SELECT * FROM animal_table WHERE id=$edit");

        while($res = mysqli_fetch_array($result))
        {
            $id= $res['id'];
            $animal_id= $res['animal_id'];
            $animal_name= $res['animal_name'];
            $animal_description= $res['animal_description'];
        }

    }

    if (isset($_GET['add'])){
        $isAddDisabled= false;
    }

    require '../connection/db.php';



    if (isset($_POST['add'])) {

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

    }elseif (isset($_POST['edit'])){

        $animal_id_= $_POST['animal_id'];
        $animal_name_= $_POST['animal_name'];
        $animal_description_= $_POST['animal_description'];

        $result = mysqli_query($con, "UPDATE animal_table SET animal_id='$animal_id_',animal_name='$animal_name_' ,animal_description='$animal_description_' WHERE id=$edit");

        $msg = "<div class='alert alert-info'>
                    <span class='glyphicon glyphicon-edit'></span> &nbsp; Category Updated !
                </div>";
        echo '<meta content="4;report.php" http-equiv="refresh" />';


    }

?>


<?php include 'header.php'; ?>
    <!--********************Add content here *******************-->
    <div class="form-group" hidden>
        <input type="text" name="animal_id" required class="form-control" value="<?php echo $id;?>" placeholder="Animal ID"/>
    </div>
    <form action="" method="post">
        <!--<div class="body bg-gray">-->
        <?php
        if (isset($msg)) {
            echo $msg;
        }
        ?>

        <div class="form-group">
            <input type="text" name="animal_id" required class="form-control" value="<?php echo $animal_id;?>" placeholder="Animal ID"/>
        </div>
        <div class="form-group">
            <input type="text" name="animal_name" required class="form-control" value="<?php echo $animal_name;?>" placeholder="Animal Tag Name"/>
        </div>
        <div class="form-group">
            <input type="text" name="animal_description" required class="form-control" value="<?php echo $animal_description;?>" placeholder="Description"/>
        </div>

        <!--</div>-->
        <div class="form-inline">
            <button type="submit" name="add" value="" <?php echo $isAddDisabled?'disabled':'';?> class="btn btn-circle" ><i class="fa fa-plus"></i></button>
            <button type="submit" name="edit" value="" <?php echo $isEditDisabled?'disabled':''; ?> class="btn bg-red btn-circle" ><i class="fa fa-edit"></i></button>

        </div>
    </form>
    <!--********************Add content here *******************-->
<?php include 'footer.php';?>