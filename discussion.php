<?php
require_once "config/db1.php";
session_start(); 

# Update user's profile and standard
$name = $_SESSION["user_name"];
if ( isset($_POST['usersave'])) {
 $n = $_POST['name'];
 $e = $_POST['email'];
 $sql = "UPDATE users SET user_name='$n', user_email='$e' WHERE user_name = '$name'";
 mysql_query($sql);
}

# Get user's current profile
$result = mysql_query("SELECT * FROM users WHERE user_name = '$name'");
$row = mysql_fetch_row($result);
$n = htmlentities($row[1]);
$e = htmlentities($row[3]);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- head -->
<head>
  <title>Goal Setting</title>
  <meta charset="utf-8">
  <link type="text/css"  rel="stylesheet" href="views/css/glike.css">
  <link type="text/css"  rel="stylesheet" href="views/css/profile.css">
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
</head>

<body>

<!-- <div class="blacktopbar"></div> -->

    

  <div class="header"> 
        <img id="logo" src="views/img/logo.png" width="120" height="100">
		<div class="loginname">
        	<span class="hi">Hi,</span><span class="user"><?php echo $_SESSION['user_name']; ?></span>
        	<a class="logout" href="index.php?logout">Logout</a>
        </div>
        <div class="headernavigationbar">
        	<span class="navigationtext">
            <a href="goal.php" >Goal Setting</a></span>
            <span class="selectednavigationtext">
            <img class="plusicon"align="absmiddle" src="views/img/plus icon-07.png" width="25.9" height="25.9" scr="">
            <a href="goal.php" >Profile</a></span>
            <span class="navigationtext"><a href=# >Community</a></span>           
        </div>
  </div>

<!-- 
        <div class="whitebackgroundgroup_bigger">
             
            <div class="whitebackground1_bigger"> </div>
            <div class="whitebackground2_bigger"> </div>
                
        </div>
 -->

<div class="whitebackgroundgroup_bigger">
         <div class="photo_group">
          	<div id="profile" width="170" height="170">
          	<img src="views/img/avatar_standard.jpg" width="170" height="170">
            </div>
            <br>
            <h1 id="profile_title" ><?php echo $name; ?></h1>
         </div>
	<!-- User profile form, show current record-->

  <div class="profile_group">
   <h1 class="content_title">Profile</h1>
   <form method="post">
	 <label class="profile_label">Username</label><input type="text" class="profile_input" name="name" value="<? echo $n; ?>"/>
	 <br>
     <br>
	 <label class="profile_label">Email</label><input type="text" class="profile_input" name="email" value="<? echo $e; ?>"/>
	 <br>
     <br>
     <div id="button_group">
	 <input type="submit" value="Update" class="button" name="usersave"/>
	 <input type="submit" class="button" type="reset"  name="userreset" value="Reset">
	 </div>
   </form>
  </div>

</div> <!--   whitebackgroundgroup_bigger -->


</body>
</html>
