<?php
extract($_POST);
$sid=$_REQUEST["s_id"];

$con=mysqli_connect("localhost","root","","onlineadmission");
if(!isset($con))
{
    die("Database Not Found");
}

if(isset($_REQUEST["acp"]))
{        $sql  = "update t_status set s_stat=";
    $sql .= "'Approved'";
    $sql .= " where s_id='" . $sid . "'";
    mysqli_query($con, $sql);
header('location:VerificationCard.php');
}
         
    if(isset($_REQUEST["rej"]))
{ $sql  = "update t_status set s_stat=";
    $sql .= "'Rejected'";
    $sql .= " where s_id='" . $sid . "'";
mysqli_query($con, $sql);
header('location:admin.php');}

?>