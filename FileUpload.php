
<?php
session_start();
$sp=mysqli_connect("localhost","root","","rpaams");
         if($sp->connect_errno){
                echo "Error <br/>".$sp->error;
}

$picpath="studentpic/";
$docpath_aadhar="aadhar/";
$docpath_hsc="hsc/";
$docpath_ssc="ssc/";
$docpath_hsc_lc="hsc_lc/";
$docpath_ssc_lc="ssc_lc/";
$proofpath="studentproof/";
$id=$_SESSION['user'];
if(isset($_POST['fpicup']))
{
$picpath=$picpath.$_FILES['fpic']['name'];
$docpath1=$docpath_ssc.$_FILES['ftndoc']['name']; 
$docpath2=$docpath_ssc_lc.$_FILES['ftcdoc']['name'];   
$docpath3=$docpath_hsc.$_FILES['fdmdoc']['name'];  
$docpath4=$docpath_hsc_lc.$_FILES['fdcdoc']['name']; 
$proofpath1=$docpath_aadhar.$_FILES['fide']['name'];      
$proofpath2=$proofpath.$_FILES['fsig']['name']; 

if(move_uploaded_file($_FILES['fpic']['tmp_name'],$picpath)
  && move_uploaded_file($_FILES['ftndoc']['tmp_name'],$docpath1)
  && move_uploaded_file($_FILES['ftcdoc']['tmp_name'],$docpath2)
  && move_uploaded_file($_FILES['fdmdoc']['tmp_name'],$docpath3)
  && move_uploaded_file($_FILES['fdcdoc']['tmp_name'],$docpath4)
  && move_uploaded_file($_FILES['fide']['tmp_name'],$proofpath1)
  && move_uploaded_file($_FILES['fsig']['tmp_name'],$proofpath2))
{

$img=$_FILES['fpic']['name'];
$img1=$_FILES['ftndoc']['name'];
$img2=$_FILES['ftcdoc']['name'];
$img3=$_FILES['fdmdoc']['name'];
$img4=$_FILES['fdcdoc']['name'];
$img5=$_FILES['fide']['name'];
$img6=$_FILES['fsig']['name'];


$query="insert into t_userdoc (s_id,s_pic,s_tenmarkpic,s_tencerpic,
    s_twdmarkpic, s_twdcerpic, s_idprfpic, s_sigpic) values 
    ('$id','$img','$img1','$img2','$img3','$img4','$img5','$img6')";
        if($sp->query($query)){
    header('location:AdmissionReport.php');    
    }else
    {
        alert("error 1");    
    }
}
else
{
    alert("error 2");
echo "There is an error,please retry or check path";
}
}
 ?>
