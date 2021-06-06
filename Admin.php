<?php
error_reporting(0);
session_start();

//  if (!isset($_SESSION['user']))
// {
//         echo "<br><h2>You are not Logged On Please Login to Access this Page</div></h2>";
//         echo "<a href=AdminLogin.php><h3 align=center>Click Here to Login</h3></a>";
//         exit();
// }

$con=mysqli_connect("localhost","root","","onlineadmission");
 
if($_REQUEST["srchk"]!="")
{
    $id = $_REQUEST["srchk"];
    $ra = mysqli_query($con, "select s_name from t_user_data where s_id = '$id'");
    echo mysqli_fetch_array($ra)[0];
    die();
}

if($_REQUEST["srchk1"]!="")
{
    $id1 = $_REQUEST["srchk1"];
    $ra1 = mysqli_query($con, "select s_omr from t_usermark where s_id = '$id1'");
    echo mysqli_fetch_array($ra1)[0];
    die();
}



if(!isset($con))
{
    die("Database Not Found");
}

$txtname=$_REQUEST["txtname"];
$txteml=$_REQUEST["txteml"];
$txtpwd=$_REQUEST["txtpwd"];
$txtid=$_REQUEST["txtid"];
$omarkof=$_REQUEST["omarkof"];
$markof=$_REQUEST["markof"];
$txtomr=$_REQUEST["txtomr"];
$txtmark=$_REQUEST["txtmark"];

$q=mysqli_query($con,"select ad_name from t_admin where ad_id='".$_SESSION['ad']."'");
$n=  mysqli_fetch_assoc($q);
$adname= $n['ad_name'];


$q1=mysqli_query($con,"select s_name from t_user_data where s_id='".$markof."'");
$n1=  mysqli_fetch_assoc($q1);
$usname= $n1['s_name'];


if(isset($_REQUEST["admcreate"]))
{
    if($txtid == "")
    $txtid = AdminCode();
    if($txtpwd == "")
    $txtpwd = AdminPass();
    
    $sql  = "insert into t_admin values(";
    $sql .= "'" . $txtid . "',";
    $sql .= "'" . $txtname . "',";
    $sql .= "'" . $txtpwd . "',";
    $sql .= "'" . $txteml . "')";
  
    
    
    mysqli_query($con, $sql);
    echo "Your ID is ".$txtid;
     
}


if(isset($_REQUEST["submitomr"]))
{
    $sql  = "insert into t_usermark (s_id,s_omr) values(";
    $sql .= "'" . $omarkof . "',";
    $sql .= "'" . $txtomr . "')";
    
    mysqli_query($con, $sql);
    
}


if(isset($_REQUEST["submitmarks"]))
{
    
    $sql  = "update t_usermark set s_mark=";
    $sql .= "'" . $txtmark . "'";
    $sql .= "where s_id='" . $markof . "'";
    
    mysqli_query($con, $sql);
    
}



 function AdminCode()
  {
      $con = mysqli_connect("localhost", "root", "", "onlineadmission");
      $rs  = mysqli_query($con,"select CONCAT('AD',LPAD(RIGHT(ifnull(max(ad_id),'AD00000'),5) + 1,5,'0')) from t_admin");
      return mysqli_fetch_array($rs)[0];
  }
  
  function AdminPass()

  {
      $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
      $pass = array();
      $alphaLength = strlen($alphabet) - 1;
      for($i=0;$i<8;$i++)
      {
          $n=rand(0,$alphaLength);
          $pass[]=$alphabet[$n];
      }
      return implode($pass);
  }
  

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
    <script src="bootstrap/jquery.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="css/admform.css">
    </link>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="jquery/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="jquery/jquery-ui-1.8.2.custom.min.js"></script>
    <link href="css/css.css" rel="stylesheet" type="text/css" />

    <!--search table-->
    <script>
    $(document).ready(function() {
        $("#search-box").keyup(function() {
            $.ajax({
                type: "POST",
                url: "readID.php",
                data: 'keyword=' + $(this).val(),
                beforeSend: function() {
                    $("#search-box").css("background",
                        "#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function(data) {
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data);
                    $("#search-box").css("background", "#FFF");
                }
            });
        });
    });

    function selectid(val) {
        $("#search-box").val(val);
        $("#suggesstion-box").hide();
    }
    </script>


    <script>
    $(document).ready(function() {
        $('#searchtb').keyup(function() {
            searchTable($(this).val());
        });
    });

    function searchTable(inputVal) {
        var table = $('#tblData');
        table.find('tr').each(function(index, row) {
            var allCells = $(row).find('td');
            if (allCells.length > 0) {
                var found = false;
                allCells.each(function(index, td) {
                    var regExp = new RegExp(inputVal, 'i');
                    if (regExp.test($(td).text())) {
                        found = true;
                        return false;
                    }
                });
                if (found == true) $(row).show();
                else $(row).hide();
            }
        });
    }
    </script>

    <script type="text/javascript">
    $(function() {

        $("#search1").autocomplete({
            source: "global_search.php",
            minLength: 2,
            select: function(event, ui) {
                var getUrl = ui.item.id;
                if (getUrl != '#') {

                    var kk = $("#search1").val();
                    $.ajax({
                        type: "GET",
                        cache: false,
                        url: "admin.php",
                        data: {
                            srchk: kk
                        },
                        success: function(response) {
                            // alert(response);
                            $("#searhid1").val(response);
                        }
                    });

                }
            },

            html: true,
        });

    });
    </script>


    <script type="text/javascript">
    $(function() {

        $("#search2").autocomplete({
            source: "global_search.php",
            minLength: 2,
            select: function(event, ui) {
                var getUrl = ui.item.id;
                if (getUrl != '#') {

                    var kk = $("#search2").val();
                    $.ajax({
                        type: "GET",
                        cache: false,
                        url: "admin.php",
                        data: {
                            srchk1: kk
                        },
                        success: function(response) {
                            // alert(response);
                            $("#showomr").val(response);
                        }
                    });

                }
            },

            html: true,
        });

    });
    </script>




</head>

<body style="background-image:url(./images/inbg.jpg) ">
    <?php  
?>
    <form id="admin" action="admin.php" method="post">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <img src="images/spit.png" width="100%" style="box-shadow: 0px 5px 5px #999999; "></img>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="dmid" style="background:#FFF">
            <div class="row">
                <div class="col-sm-12">

                    <center>
                        <font style="color:black; font-family: Verdana;  font-size:20px;">

                            <h1 style="margin-top:30px"><b>Administration Cell</b></h1>

                        </font>
                    </center>
                </div>
            </div>
        </div>

        <div class="container">
            <ul class="nav nav-tabs">

                <li class="active"><a data-toggle="tab" href="#viewapp">View Applications</a></li>
                <li><a data-toggle="tab" href="#adadmin">Add New Manager</a></li>
                <li><a href="AdminLogout.php">Logout</a></li>
                <li> <input type="text" id="searchtb" name="searchtb" placeholder="Search" class="form-control"
                        style="margin-top:5px;margin-left:250px;width:300px;"></li>
            </ul>
            <div class="tab-content">
                <div id="viewapp" class="tab-pane fade in active">

                    <?php

		$rs1 = mysqli_query($con,"select * from t_user_data");
		
                echo '<table class="table table-striped" id="tblData">';
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>NAME</th>";
                echo "<th>DATE OF BIRTH</th>";
                echo "<th>EMAIL ID</th>";
                echo "<th>CONTACT NO.</th>";
                // echo "<th>SIGNUP DATE</th>";
                echo "<tr>";
                echo "</thead>";
                echo "<tbody>";
		while($ar = mysqli_fetch_array($rs1))
                {
               echo "<tr>";
              
               echo "<td><a href='viewform.php?id=".$ar[0]."'>" . $ar[0] . "</a></td>";
                echo "<td>" . $ar[3] . "</td>";
                echo "<td>" . $ar[2] . "</td>";
                echo "<td>" . $ar[4] . "</td>";
                echo "<td>" . $ar[5] . "</td>";  
                } 
                echo "</tbody>";
                echo "</table>";
	?>

                </div>



                <div id="adomr" class="tab-pane fade">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <br>

                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-12">
                                <div class="container">
                                    <center>
                                        <div class="jumbotron"
                                            style="width:50%; box-shadow: -3px 3px 10px #999999;   margin-top:10px;">
                                            <div class="row">
                                                <div class="col-sm-6">

                                                    <input type="text" name="omarkof" id="search1" class="form-control"
                                                        placeholder="Application ID" style="width:200px;" />


                                                </div>

                                                <div class="col-sm-6">

                                                    <input type="text" id="searhid1" value="<?php echo $usname ?>"
                                                        class="form-control" style="width:200px;" /><br />
                                                    <input type="text" name="txtomr" placeholder="Enter OMR No."
                                                        class="form-control" style="width:200px;" />

                                                </div>
                                            </div><br>
                                            <input type="submit" value="Submit" name="submitomr"
                                                class="toggle btn btn-primary" />
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div id="admarks" class="tab-pane fade">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <br>

                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-12">
                                <div class="container">
                                    <center>
                                        <div class="jumbotron"
                                            style="width:50%; box-shadow: -3px 3px 10px #999999;   margin-top:10px;">
                                            <div class="row">
                                                <div class="col-sm-6">

                                                    <input type="text" name="markof" id="search2" class="form-control"
                                                        placeholder="Application ID" style="width:200px;" />


                                                </div>

                                                <div class="col-sm-6">

                                                    <input type="text" name="showomr" id="showomr" placeholder="Omr"
                                                        class="form-control" style="width:200px;" /><br>
                                                    <input type="text" name="txtmark" placeholder="Enter Marks"
                                                        class="form-control" style="width:200px;" />

                                                </div>
                                            </div><br>
                                            <input type="submit" value="Submit" name="submitmarks"
                                                class="toggle btn btn-primary" />
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div id="adadmin" class="tab-pane fade">
                    <div class="row">
                        <div class="col-sm-12">

                            <h3>New Manager Details</h3>
                            <input type="text" id="txtname" name="txtname" class="form-control"
                                style="width:200px;margin-left:32px;" placeholder="Name"><br><br>
                            <input type="text" id="txteml" name="txteml" class="form-control"
                                style="width:200px;margin-left:32px;" placeholder="Email ID"><br>
                            <input type="submit" value="Create" name="admcreate" class="toggle btn btn-primary"
                                style="margin-left:102px;" /> <br>
                            <hr>
                            <hr>
                            <h3>Existing Managers</h3>

                            <?php
	
		
		
		$rs2 = mysqli_query($con,"select * from t_admin");
		
           
                echo '<table class="table table-striped">';
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>NAME</th>";
                echo "<th>EMAIL ID</th>";
                
                echo "<tr>";
                echo "</thead>";
                echo "<tbody>";
		while($ar = mysqli_fetch_array($rs2))
		{
                       echo "<tr>";
                        echo "<td>" . $ar[0] . "</td>";
			echo "<td>" . $ar[1] . "</td>";
                        echo "<td>" . $ar[3] . "</td>";
			
                      echo "</tr>";
		}
                
                echo "</tbody>";
                echo "</table>";
	?>



                            <input type="hidden" id="txtid" name="txtid">
                            <input type="hidden" id="txtpwd" name="txtpwd">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="signup" action="status.php" method="post">
        <center>
            <table id="tabintro">
                <tr>
                    <td colspan="4">
                        <input type="text" id="s_id" name="s_id" class="form-control" required="true"
                            style="width:300px;margin-bottom:20px;margin-left:150px;" placeholder="Enter Student ID">

                        <input type="submit" id="acp" name="acp" value="Accept" class="toggle btn btn-success"
                            style="width:300px;margin-bottom:10px">

                        <input type="submit" id="rej" name="rej" value="Reject" class="toggle btn btn-danger"
                            style="width:300px;margin-bottom:10px">
                    </td>
                </tr>
            </table>
        </center>
        </div>
        </div>
    </form>
</body>

</html>