<?php

    session_start();
    error_reporting(0);

$con=mysqli_connect("localhost","root","","rpaams");
$q=mysqli_query($con,"select s_name from t_user_data where s_id='".$_SESSION['user']."'");
$n=  mysqli_fetch_assoc($q);
$stname= $n['s_name'];
$id=$_SESSION['user'];

$result = mysqli_query($con,"SELECT * FROM t_user WHERE s_id='".$_SESSION['user']."'");
                    
                    while($row = mysqli_fetch_array($result))
                      {
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


    <script type="text/javascript">
    function printpage() {
        var printButton = document.getElementById("print");
        printButton.style.visibility = 'hidden';
        window.print()
        printButton.style.visibility = 'visible';
    }
    </script>
</head>

<body style="background-image:url(./images/inbg.jpg) ">
    <form id="admincard" action="admincard.php" method="post">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <center>
                        <table class="table table-bordered" style="font-family: Verdana">

                            <tr>
                                <td style="width:3%;">
                                    <center><img src="./images/spit_logo.jpg" width="30%" style="margin-top:40px;">
                                    </center>
                                </td>
                                <td style="width:15%;">
                                    <center>
                                        <font style="font-family:Arial Black; font-size:20px;">
                                            Bharatiya Vidya Bhavans Sardar Patel Institute of Technology
                                            Munshi Nagar,<br>
                                            Andheri (West), Mumbai 400 058.</font>
                                    </center>

                                    <center>
                                        <font style="font-family:Verdana; font-size:18px;">
                                            Phone : (91)-(022)-26707440, 26287250
                                        </font>
                                    </center>

                                    <br>
                                    <br>
                                    <center>
                                        <font style="font-family:Arial Black; font-size:20px;">
                                            ADMISSIONS (2021-22)</font>
                                    </center>
                                </td>
                                <td colspan="2" width="3%">
                                    <?php
                  
                    $picfile_path ='studentpic/';
                    
                    $result1 = mysqli_query($con,"SELECT * FROM t_userdoc where s_id='".$_SESSION['user']."'");
                        
                    
                    
                    while($row1 = mysqli_fetch_array($result1))
                      {                  
                        $picsrc=$picfile_path.$row1['s_pic'];
                        
                        echo "<img src='$picsrc.' class='img-thumbnail' width='180px' style='height:180px;'>";
                        echo"<div>";
                      }
                   ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <font style="font-family: Verdana;">Registration No. </font>
                                </td>
                                <td colspan="3">
                                    <font style="font-family: Verdana; font-weight: bold">
                                        <?php echo $id ?></font>
                                </td>
                            </tr>

                            <tr>
                                <td style="width:4%;">
                                    <font style="font-family: Verdana;">Name </font>
                                </td>
                                <td style="width:8%;" colspan="3">
                                    <font style="font-family: Verdana; font-weight: bold">
                                        <?php echo $stname;?></font>
                                </td>
                            </tr>

                            <tr>
                                <td style="width:4%;">
                                    <font style="font-family: Verdana;">Verification Center </font>
                                </td>
                                <td style="width:8%;" colspan="3">
                                    <font style="font-family: Verdana; font-weight: bold">
                                        Bharatiya Vidya Bhavans Sardar Patel Institute of Technology
                                        Munshi Nagar,<br>
                                        Andheri (West), Mumbai 400 058</font>
                                </td>
                            </tr>
                            <?php
                }
                ?>

                        </table>
                </div>
            </div>
        </div>

        <center>
            <font style="font-family: Verdana; font-weight: bold; font-size: 20px;"> Instructions to the Candidate
            </font>
        </center><br>
        <font style="font-family: Verdana;  font-size: 13px;">
            <p style="margin-left: 100px; margin-right: 100px; font-family: Verdana;">
                1. This Verification Card must be presented for verification at the time of admission, along with at
                least
                one
                original(not photocopied or scanned copy) and valid (not expired) photo identification card
                (e.g : Aadhaar Card, Voter ID).
            </p>

            <p style="margin-left: 100px; margin-right: 100px; font-family: Verdana;">
                2. This Verification Card is valid only if the candidate's photograph and signature images are <b>
                    legibly
                    printed</b>.
                Print this on an A4 sized paper using a laser printer preferably a color photo printer.
            </p>

            <p style="margin-left: 100px; margin-right: 100px; font-family: Verdana;">
                3. Candidates should occupy their alloted seats <b>25 minutes before</b> the scheduled start of the
                Admission Process.
            </p>

            <p style="margin-left: 100px; margin-right: 100px; font-family: Verdana;">
                4. Candidates will not be allowed to enter the Admission hall <b>30 minutes</b>
                after the commencement of the Admission Process
            </p>
        </font>

        <center><input type="button" id="print" class="toggle btn btn-primary" value="Print" style="margin-top:30px;:"
                onclick="printpage();">
        </center>
    </form>
</body>

</html>