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

$result1 = mysqli_query($con, "SELECT * FROM login_table WHERE admin_user='$username'");

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
/**
 * Created by PhpStorm.
 * User: king
 * Date: 03/04/2017
 * Time: 12:46
 */
// including the database connection file
include_once("../connection/db.php");

if(isset($_POST['update']))
{

    $admin_id_ = mysqli_real_escape_string($con, $_POST['admin_id']);
    $admin_user_ = mysqli_real_escape_string($con, $_POST['admin_user']);

    $admin_password_ = mysqli_real_escape_string($con, $_POST['admin_password']);
    $admin_password2 = mysqli_real_escape_string($con, $_POST['admin_password2']);
    $enc = md5($admin_password_);
    //$user_lastname = mysqli_real_escape_string($con, $_POST['lname']);
    //$user_payrollnumber = mysqli_real_escape_string($con, $_POST['pnumber']);
    //$user_email = mysqli_real_escape_string($con, $_POST['email']);
    //$user_phone = mysqli_real_escape_string($con, $_POST['phone']);

    // checking empty fields
    if(empty($admin_user_) || empty($admin_password_) || ($admin_password_ !== $admin_password2)) {

        if(empty($admin_user_) || empty($admin_password_) ) {
            $msg = "<div class='alert alert-danger'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Username Required !
					</div>";
        }

        if(empty($admin_password_)) {
            $msg = "<div class='alert alert-danger'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Password Required !
					</div>";
        }
        if($admin_password_ !== $admin_password2) {
            $msg = "<div class='alert alert-danger'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Password does not Match !
					</div>";
        }
        

    } else {
        //updating the table
        $result = mysqli_query($con, "UPDATE login_table SET admin_user='$admin_user_',admin_password='$enc' WHERE admin_id='$admin_id_'");

        //redirectig to the display page. In our case, it is index.php
        
        //Javascript is on below of this file for progress bar
        
        $msg = "<div <div class='alert alert-info'>
						<progress id='progressBar' value='0' max='10'></progress> &nbsp;  Successfully registered !  system about to log you out.
                                                
					</div>";
        
        header('refresh: 10; url=../logout.php?logout');
        
    }
}
?>
<?php

//selecting data associated with this particular id
$result1 = mysqli_query($con, "SELECT * FROM login_table WHERE admin_user='$username'");

while($res = mysqli_fetch_array($result1))
{
    $admin_id_= $res['admin_id'];
    $admin_user_= $res['admin_user'];
    $admin_password_= $res['admin_password'];
    //$user_email = $res['user_email'];
    //$user_phone = $res['user_phone'];
}
?>

<?php include 'header.php'; ?>
<!-- add content here -->


<form action="" method="post">
    <!--<div class="body bg-gray">-->
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
    <div class="form-group" hidden="">
        <label>ID</label>
        <input type="text" name="admin_id" readonly="" required value="<?php echo $admin_id_;?>" class="form-control" placeholder="lastname"/>
    </div>
    <div class="form-group" >
        
        <label>Username</label>
        <input type="text" name="admin_user" readonly="" required value="<?php echo $admin_user_;?>" class="form-control" placeholder="lastname"/>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="admin_password" required value="" class="form-control" placeholder="New Password"/>
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="admin_password2" required value="" class="form-control" placeholder="Confirm Password"/>
    </div>
    <!--<div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm-password" required value="" class="form-control" placeholder="Employee Number"/>
    </div>

    <!--</div>-->
    <div class="footer">

        <button type="submit" name="update" class="btn bg-olive" value="Delete">Update Password</button>
    </div>
</form>



<script>
    <!--<progress value="0" max="10" id="progressBar"></progress>-->
                var timeleft = 10;
            var downloadTimer = setInterval(function(){
              document.getElementById("progressBar").value = 10 - --timeleft;
              if(timeleft <= 0)
                clearInterval(downloadTimer);
            },1000);
</script>

<?php include 'footer.php'; ?>