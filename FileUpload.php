
<?php
session_start();
$sp=mysqli_connect("localhost","root","","rpaams");
         if($sp->connect_errno){
                echo "Error <br/>".$sp->error;
}

//target directory
$picpath="Uploads/studentpic/";
$docpath_aadhar="Uploads/aadhar/";
$docpath_hsc="Uploads/hsc/";
$docpath_ssc="Uploads/ssc/";
$docpath_hsc_lc="Uploads/hsc_lc/";
$docpath_ssc_lc="Uploads/ssc_lc/";
$proofpath="Uploads/studentproof/";
$id=$_SESSION['user'];

if(isset($_POST['fpicup']))
{
$picpath1=$picpath.basename($_FILES['fpic']['name']);
$docpath1=$docpath_ssc.basename($_FILES['ftndoc']['name']); 
$docpath2=$docpath_ssc_lc.basename($_FILES['ftcdoc']['name']);   
$docpath3=$docpath_hsc.basename($_FILES['fdmdoc']['name']);  
$docpath4=$docpath_hsc_lc.basename($_FILES['fdcdoc']['name']); 
$proofpath1=$docpath_aadhar.basename($_FILES['fide']['name']);      
$proofpath2=$proofpath.basename($_FILES['fsig']['name']); 

//file extension extrcation
$picpath_ext=substr($picpath1, strripos($picpath1, '.'));
$docpath1_ext=substr($docpath1, strripos($docpath1, '.'));
$docpath2_ext=substr($docpath2, strripos($docpath2, '.'));   
$docpath3_ext=substr($docpath3, strripos($docpath3, '.'));  
$docpath4_ext=substr($docpath4, strripos($docpath4, '.')); 
$proofpath1_ext=substr($proofpath1, strripos($proofpath1, '.'));      
$proofpath2_ext=substr($proofpath2, strripos($proofpath2, '.'));


//new file names
$pic=$id."_PIC".$picpath_ext;
$ssc=$id."_SSC".$docpath1_ext;
$ssc_lc=$id."_SSC_LC".$docpath2_ext;
$hsc=$id."_HSC".$docpath3_ext;
$hsc_lc=$id."_HSC_LC".$docpath4_ext;
$aadhar=$id."_AADHAR".$proofpath1_ext;
$sign=$id."_SIGN".$proofpath2_ext;


if(move_uploaded_file($_FILES['fpic']['tmp_name'],$picpath.$pic)
  && move_uploaded_file($_FILES['ftndoc']['tmp_name'],$docpath_ssc.$ssc)
  && move_uploaded_file($_FILES['ftcdoc']['tmp_name'],$docpath_ssc_lc.$ssc_lc)
  && move_uploaded_file($_FILES['fdmdoc']['tmp_name'],$docpath_hsc.$hsc)
  && move_uploaded_file($_FILES['fdcdoc']['tmp_name'],$docpath_hsc_lc.$hsc_lc)
  && move_uploaded_file($_FILES['fide']['tmp_name'],$docpath_aadhar.$aadhar)
  && move_uploaded_file($_FILES['fsig']['tmp_name'],$proofpath.$sign))
{


$query="insert into t_userdoc (s_id,s_pic,s_tenmarkpic,s_tencerpic,
    s_twdmarkpic, s_twdcerpic, s_idprfpic, s_sigpic) values 
    ('$id','$pic','$ssc','$ssc_lc','$hsc','$hsc_lc','$aadhar','$sign')";
        if($sp->query($query)){
    header('location:AdmissionReport.php');    
    }else
    {   
        header('location:error.php'); 
    }
}
else
{
    alert("error 2");
echo "There is an error,please retry or check path";
}
}
 ?>
