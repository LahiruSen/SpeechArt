<?php
/* Main page with two forms: sign up and log in */
require 'model\db.php';
if (session_status() == PHP_SESSION_NONE) {    session_start();}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign-Up/Login Form</title>
    <?php include 'css/css.html'; ?>
</head>

<?php
//if ($_SERVER['REQUEST_METHOD'] == 'POST')
//{
//    if (isset($_POST['login'])) { //user logging in
//
//        require 'login.php';
//
//    }
//
//    elseif (isset($_POST['register'])) { //user registering
//
//        require 'register.php';
//
//    }
//}
//
//
//?>
<body>

<div class="form">
    <h1  style="color:Tomato;">Speech Art</h1>
    <ul class="tab-group">
        <li class="tab"><a href="signup.php">Sign Up</a></li>
        <li class="tab active"><a href="control/login.php">Log In</a></li>
    </ul>

    <div class="tab-content">

        <div id="login">

            <div style="width: 100%; text-align: center">
                <img src="img/signup.png" style="width: 40%"></img>
            </div>


            <form action="control/register.php" method="post" autocomplete="off">

                <div class="top-row">
                    <div class="field-wrap">
                        <label>
                            First Name<span class="req">*</span>
                        </label>
                        <input pattern="[A-Za-z]+" title="Can't have numbers and special characters" type="text" required autocomplete="off" name='firstname'  />
                    </div>

                    <div class="field-wrap">
                        <label>
                            Last Name<span class="req">*</span>
                        </label>
                        <input pattern="[A-Za-z]+" type="text" required autocomplete="off" name='lastname' title="Can't have numbers and special characters" />
                    </div>
                </div>

                <div class="field-wrap">
                    <label>
                        Email Address<span class="req">*</span>
                    </label>
                    <input type="email" required autocomplete="off" name='email' />
                </div>

                <div class="field-wrap">
                    <label>
                        Set A Password<span class="req">*</span>
                    </label>

                    <input  id="password" type="password" required autocomplete="off" name='password' aria-describedby="btnGroupAddon" pattern=".{8,}" title="Should have atleast 8 charactors" />
                    <span id="passwordicon" class="fa fa-eye " style="color: white; float: right; margin-right: 10px;margin-top: -24px; position: relative;z-index: 2;" ></span>
                </div>


                <div class="field-wrap">
                    <label>
                        Enter Password Again<span class="req">*</span>
                    </label>

                    <input  id="password1" type="password" required autocomplete="off" name='password1' aria-describedby="btnGroupAddon" pattern=".{8,}" title="Should have atleast 8 charactors" />
                    <span id="passwordicon1" class="fa fa-eye " style="color: white; float: right; margin-right: 10px;margin-top: -24px; position: relative;z-index: 2;" ></span>
                </div>


                <button type="submit" class="button button-block" name="register" />Register</button>

            </form>

        </div>


        <div id="signup">
            <div style="width: 100%; text-align: center">
                <img src="img/signup.png" style="width: 40%"></img>
            </div>

            <form action="index.php" method="post" autocomplete="off">

                <div class="top-row">
                    <div class="field-wrap">
                        <label>
                            First Name<span class="req">*</span>
                        </label>
                        <input pattern="[A-Za-z]+" title="Can't have numbers and special characters" type="text" required autocomplete="off" name='firstname'  />
                    </div>

                    <div class="field-wrap">
                        <label>
                            Last Name<span class="req">*</span>
                        </label>
                        <input pattern="[A-Za-z]+" type="text" required autocomplete="off" name='lastname' title="Can't have numbers and special characters" />
                    </div>
                </div>

                <div class="field-wrap">
                    <label>
                        Email Address<span class="req">*</span>
                    </label>
                    <input type="email" required autocomplete="off" name='email' />
                </div>



                <button type="submit" class="button button-block" name="register" />Register</button>

            </form>

        </div>

    </div
    ><!-- tab-content -->



</div>


<!-- /form -->
<!--<script src='js/jquery.min.js'></script>-->
<!---->
<!--<script src="js/index.js"></script>-->

</body>
</html>
+