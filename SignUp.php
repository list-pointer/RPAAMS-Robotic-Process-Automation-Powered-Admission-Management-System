<?php
error_reporting(0);
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
    <script src="bootstrap/jquery.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
    <script language="javascript" type="text/javascript" src="jquery/jquery-1.10.2.js"></script>
    <script language="javascript" type="text/javascript" src="jquery/jquery-ui.js"></script>
    <link href="jquery/jquery-ui.css" rel="stylesheet" type="text/css" />
    </link>

    <script type="text/javascript">
    function validate() {
        $('#signup input[type="text"]').each(function() {
            if (this.required) {
                if (this.value == "")
                    $(this).addClass("inpterr");
                else
                    $(this).addClass("inpterrc");
            }

            if ($(this).attr("VT") == "NM") {
                if ((!isAlpha(this.value)) && this.value != "") {
                    alert("Only Aplhabets Are Allowed . . .");
                    $(this).focus();
                }
            }

            if ($(this).attr("VT") == "PH") {
                if ((!isPhone(this.value)) && this.value != "") {
                    alert("Check the format . . .");
                    $(this).focus();
                }
            }

            if ($(this).attr("VT") == "EML") {
                if (!IsEmail($(this).val()) && this.value != "") {
                    alert("Invalid Email . . . .");
                    $(this).focus();
                }
            }

            if ($(this).attr("VT") == "PIN") {
                if ((!IsPin(this.value)) && this.value != "") {
                    alert("Invalid Pin Code . . . .");
                    $(this).focus();
                }
            }

        });
    }

    function isAlpha(x) {
        var re = new RegExp(/^[a-zA-Z\s]+$/);
        return re.test(x);
    }

    function isPhone(x) {

        var ph = new RegExp(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/);
        return ph.test(x);
    }

    function IsEmail(x) {
        var em = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
        return em.test(x);
    }

    function IsPin(x) {
        var pin = new RegExp(/^\d{6}$/);

        return pin.test(x);
    }
    </script>

    <style type="text/css">
    .inpterr {
        border: 1px solid red;
        background: #FFCECE;

    }

    .inpterrc {
        border: 1px solid black;
        background: white;
    }
    </style>


</head>


<body style="background-image:url('./images/inbg.jpg');">
    <form id="signup" action="signupconfirm.php" method="post">

        <div id="dvlogin" style="box-shadow: 0px 5px 10px #999999">
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <img src="images/spit.png" width="100%" style="box-shadow: 1px 5px 14px #999999; "></img>
                </div>
            </div>
        </div>
        <div id="dmid">

        </div>
        <div id="ddown">
            <br><br><br>
            <div id="dleft">
                <input type="hidden" id="stid" name="stid" value="">
                <input type="hidden" id="stpw" name="stpw" value="">
            </div>
            <div id="drig">
                <br>
                <center>
                    <ta<ble id="tabintro">
                        <tr>
                            <td style="padding-bottom: 1em;">
                                <img src="./images/login.jpg" width="100px" height="100px"
                                    style="margin-top:20px;margin-bottom:-45px;margin-left:60px;">
                            </td><br>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 1em;">
                                <input type="text" id="in_name" name="in_name" VT="NM" class="form-control"
                                    required="true" style="width:300px; margin-left: 66px; margin-top:70px;"
                                    placeholder="Enter Your Name">
                            </td><br>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 1em;">
                                <input type="email" id="in_eml" name="in_eml" VT="EML" class="form-control"
                                    required="true" style="width:300px; margin-left: 66px;"
                                    placeholder="Enter Your Email">
                            </td><br>
                        </tr>

                        <tr>
                            <td style="padding-bottom: 1em;">
                                <input type="text" id="in_dob" name="in_dob" class="form-control" required="true"
                                    style="width:300px; margin-left: 66px;" placeholder="Enter Your DOB">
                                <script type="text/javascript">
                                $(function() {
                                    $("#in_dob").datepicker({
                                        dateFormat: 'yy-mm-dd',
                                        yearRange: '-25:+0',
                                        changeYear: true,
                                        changeMonth: true
                                    });
                                });
                                </script>
                            </td><br>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 1em;">
                                <input type="text" id="in_mob" name="in_mob" VT="PH" maxlength="10" class="form-control"
                                    required="true" style="width:300px; margin-left: 66px; "
                                    placeholder="Enter Your Mobile No">
                            </td><br>
                        </tr>
                        <tr>
                            <td>

                                <input type="submit" id="in_sub" name="in_sub" onclick="validate();" value="SIGN UP"
                                    class="toggle btn btn-primary"
                                    style="width:300px; margin-left: 66px;margin-bottom:10px">
                                <br>
                                <a href="index.php" style="margin-left:50px;"> Already a User? Login </a>
                            </td>

                        </tr>
                        </table>
                </center>
            </div>
        </div>
    </form>
</body>

</html>