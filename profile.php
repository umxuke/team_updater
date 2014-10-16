<?php
require_once "config/db1.php";
session_start(); 

if (!$_SESSION){
	header('Location: index.php');
}

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
  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700' rel='stylesheet' type='text/css'>
</head>

<body>

<!-- <div class="blacktopbar"></div> -->

    

<div class="header"> 
<!-- 	<img id="logo" src="views/img/logo.png" width="120" height="100"> -->
	<div class="loginname">
		<span class="avatar"><img src="views/img/avatar_standard.jpg" width="50" height="50"></span>
		<span class="account"><a href="dashboard.php" >My Dashboard</a></span><br>
		<span class="user"><a href="profile.php" ><?php echo $_SESSION['user_name']; ?></a></span><br>
		<a class="logout" href="index.php?logout">Logout</a>
	</div>
	
	<div class="headernavigationbar">
		<img src="views/img/teams.png" width="40" height="40"><span class="navigationtext"><a href="" >Teams</a></span>
		<img src="views/img/goals.png" width="40" height="40"><span class="navigationtext"><a href="form.php" >Goals</a></span>
		<img src="views/img/discussion.png" width="40" height="40"><span class="navigationtext"><a href="comment/comment.php" >Discussion</a></span>           
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
