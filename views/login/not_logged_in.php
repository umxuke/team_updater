<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <!-- webfonts -->
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
    <!-- css -->
    <link href='views/css/style.css' rel='stylesheet' type='text/css' /><!-- the path is always relative to index.php -->
    <!-- jQuery und md5 plugin (necessary to get gravatar-avatar pictures) -->
    <script src="views/js/jquery-1.8.1.min.js" type="text/javascript"></script>
    <script src="views/js/jquery.md5.min.js" type="text/javascript"></script>
    <!-- Simple PHP Login specific JavaScript (no logic stuff here, just css/layout actions) -->
    <script src="views/js/beautiful_login.js" type="text/javascript"></script>        
</head>

<body>

<div class="login_wrapper">    
    <?php

    if ($login->errors) {
        foreach ($login->errors as $error) {
            
    ?>              
    <div class="login_message error">
        <?php echo $error; ?>
    </div>            
    <?php
    
        }
    }
    
    if ($login->messages) {
        foreach ($login->messages as $message) {
    ?>
    <div class="login_message success">
        <?php echo $message; ?>
    </div>              
    <?php
    
        }
    }

    ?>             
    <form method="post" action="index.php" name="loginform" id="loginform">
    <div class="login">
        <div id="login_avatar" style="background-image: url('<?php echo $login->avatar_url; ?>');">
            <!--<img id="login_avatar" src="views/img/ani_avatar_static_01.png" style="width:125px; height:125px;" />-->
        </div>
        <div style="width: 250px; height: 125px; float:left; margin:0;">
            <div style="width: 250px; height: 62px; float:left; margin:0; border-bottom: 1px solid #e6e6e6;">
                <input id="login_input_username" class="login_input" type="text" name="user_name" value="<?php echo $login->view_user_name; ?>" />
            </div>
            <div style="width: 250px; height: 62px; float:left; margin:0;">
                <?php //if (empty($login->view_user_name)) { ?>
                <input id="login_input_password_label" class="login_input" type="text" value="Password" />
                <?php //} ?>
                <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" />
            </div>
        </div>
        <div style="width: 124px; height: 125px; float:left; margin:0; border-left: 1px solid #e6e6e6;">
            <div class="login_submit">
                <input type="submit"  name="login" style="width:124px; height:125px; padding-top: 60px;  text-align: center; font-size:11px; font-family: 'Droid Sans', sans-serif; color:#666666; border:0; background: transparent; cursor: pointer;" value="Submit" />            
            </div>        
        </div>
    </div>    
    <div style="width:500px; height: 40px; line-height: 40px; text-align: right; color:#ccc; font-size:11px; font-family: 'Droid Sans', sans-serif; ">
        <a class="login_link" href="index.php?register">Create new Account</a>
    </div>
    </form>
</div>

<!-- this is the Simple sexy PHP Login Script. You can find it on http://www.php-login.net ! It's free and open source. -->

</body>
</html>