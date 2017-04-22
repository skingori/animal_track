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


?>

<?php include 'header.php'; ?>
    <!--********************Add content here *******************-->
    <form method="post" class="">
        <div class="input-group">
            <select name="animalid" required class="form-control">
                <option selected="">...Search</option>
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
            <span class="input-group-btn">
                                <button type='submit' name='search' id='search-btn' class="btn btn-flat btn-danger"><i class="fa fa-search"></i></button>
                            </span>
        </div>
    </form>

<?php
    if(isset($_POST['search'])) {

        $animalid_ = $_POST['animalid'];

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
        $result = mysqli_query($con, "SELECT * FROM animal_table,animal_device_table,animal_location WHERE animal_table.animal_id='$animalid_' AND animal_device_table.animal_device_animal_id='$animalid_' AND animal_location.animal_location_animal_device_id='$animalid_'"); // using mysqli_query instead


    ?>
        <table  border=0 cellpadding="1" cellspacing="1" id="" width="100%" class="table table-hover table-condensed table-striped">

        <tr bgcolor=''>
            <td>Animal ID</td>
            <td>Animal Name</td>
            <td>Animal Description</td>
            <td>Animal Device</td>
            <td>Acquisition Time</td>
            <td>X Co-ordinate</td>
            <td>Y Co-ordinate</td>
            <!--<td>Update</td>-->
        </tr>

        <?php
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
        while($res = mysqli_fetch_array($result)) {
            echo "<tr class=\"alert-info\">";
            echo "<td class=''>".$res['animal_id']."</td>";
            echo "<td>".$res['animal_name']."</td>";
            echo "<td>".$res['animal_description']."</td>";
            echo "<td>".$res['animal_device_device_id']."</td>";
            echo "<td>".$res['animal_location_acquisition_time']."</td>";
            echo "<td>".$res['animal_xcoordinate']."</td>";
            echo "<td>".$res['animal_ycoordinate']."</td>";
            //echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
        }
        ?>
        </table>




      <?php




    }
    else{
        $result = mysqli_query($con, "SELECT * FROM animal_table,animal_device_table,animal_location");

?>

        <table  border=0 cellpadding="1" cellspacing="1" id="" width="100%" class="table table-hover table-condensed table-striped">

        <tr bgcolor=''>
            <td>Animal ID</td>
            <td>Animal Name</td>
            <td>Animal Description</td>

            <!--<td>Update</td>-->
        </tr>

        <?php
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
        while($res = mysqli_fetch_array($result)) {
            echo "<tr class=\"alert-info\">";
            echo "<td class=''>".$res['animal_id']."</td>";
            echo "<td>".$res['animal_name']."</td>";
            echo "<td>".$res['animal_description']."</td>";

            //echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
        }
        ?>
        </table>

        <?php
    }
?>




    <!--********************Add content here *******************-->
<?php include 'footer.php';?>