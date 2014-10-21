<?php
require_once "config/db1.php";
session_start(); 

if (!$_SESSION){
	header('Location: index.php');
}

# Insert a task
$name = $_SESSION["user_name"];
$time = date('Y-m-d');

$result = mysql_query("SELECT user_id FROM users WHERE user_name = '$name'");
$userid = mysql_fetch_row($result)[0];

$task_record = mysql_query("SELECT * FROM task WHERE user_id = '$userid' and task_date = '$time'");
$numrows = mysql_num_rows($task_record);

if ( isset($_POST['goalsave'])) {
 $_SESSION['goal_message'] = 'Nice! Now let’s get to achieve them.';
 $goal1 = $_POST['goal1'];
 $goal2 = $_POST['goal2'];
 $goal3 = $_POST['goal3'];
 $goal_array = array($goal1,$goal2,$goal3);
 $i = 0;
 if ($numrows>0) {
    while($h=mysql_fetch_row($task_record)){
 		mysql_query("UPDATE task SET goal='$goal_array[$i]' WHERE task_id = '$h[0]' and user_id = '$userid' and task_date = '$time'");  
 		$i++;
 	}
 } else {
 	mysql_query("INSERT INTO task (user_id, task_date, goal) VALUES ('$userid', '$time', '$goal1')");
 	mysql_query("INSERT INTO task (user_id, task_date, goal) VALUES ('$userid', '$time', '$goal2')");
 	mysql_query("INSERT INTO task (user_id, task_date, goal) VALUES ('$userid', '$time', '$goal3')");
 }
 header( 'Location: dashboard.php' );
}

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
		<img src="views/img/teams.png" width="40" height="40"><span class="navigationtext"><a href="team.php" >Teams</a></span>
		<img src="views/img/goals.png" width="40" height="40"><span class="selectednavigationtext"><a href="form.php" >Goals</a></span>
		<img src="views/img/discussion.png" width="40" height="40"><span class="navigationtext"><a href="comment/comment.php" >Discussion</a></span>           
	</div>
</div>


<div class="whitebackgroundgroup_bigger">

  <div class="goal_set">
   <h1 class="content_title">What are your 3 goals of the day?</h1>
   <form method="post">
   <?php
   	 $task_record = mysql_query("SELECT * FROM task WHERE user_id = '$userid' and task_date = '$time'");
   	 $i = 1;
     if ($numrows>0) {
     	while($h=mysql_fetch_row($task_record)){
     		if ($h[4]==100){
				echo ("<label class='goal_label'>Goal $i</label><input type='text' class='goal_input' name='goal$i' value='$h[3]' disabled/><span class='finish_status'>Finished</span><br><br>");
     		}
     		else{     		
     			echo ("<label class='goal_label'>Goal $i</label><input type='text' class='goal_input' name='goal$i' value='$h[3]'/><br><br>");
     		}
     		$i++;	
		}     	     	
     } else {

     	echo ("<label class='goal_label'>Goal 1</label><input type='text' class='goal_input' name='goal1' placeholder='Enter goal1'/><br><br>");
     	echo ("<label class='goal_label'>Goal 2</label><input type='text' class='goal_input' name='goal2' placeholder='Enter goal2'/><br><br>");
     	echo ("<label class='goal_label'>Goal 3</label><input type='text' class='goal_input' name='goal3' placeholder='Enter goal3'/><br><br>");
     }
	 
	 ?>
	 

	 <p class="note">Note: Be precise and relevant. Avoid being vague and don’t
consider a goal like “Survive”. We know it’s important! But give
yourself the opportunity to focus on goals that can make you
better and stress you out. Example: Finish my job application. </p>
	 
     <br>
     <div id="button_group">
	 <input type="submit" value="Update" class="button" name="goalsave"/>
	 <input class="button" type="reset"  name="goalreset" value="Reset">
	 </div>
   </form>
  </div>

</div> <!--   whitebackgroundgroup_bigger -->


</body>
</html>
