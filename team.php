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
  <link rel="stylesheet" href="todo_list/style.css">
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
		<img src="views/img/teams.png" width="40" height="40"><span class="selectednavigationtext"><a href="team.php" >Teams</a></span>
		<img src="views/img/goals.png" width="40" height="40"><span class="navigationtext"><a href="form.php" >Goals</a></span>
		<img src="views/img/discussion.png" width="40" height="40"><span class="navigationtext"><a href="comment/comment.php" >Discussion</a></span>           
	</div>
</div>

<div class="team_member">
<?php



$user_result = mysql_query("SELECT * FROM users");
while($u=mysql_fetch_row($user_result)){
	if ($u[0]!=$userid){
		
		echo "<div class='people'>";
		echo "<img src='views/img/avatar_standard.jpg' width='50' height='50'>";
		
		$people_email=$u[3];
		echo "<span class='people_info'><span class='people_name'>";
		echo $u[1], "</span><span class='people_email'> $people_email</span></span><span class='people_comment'> ";

		echo "</span><br>";
		
		echo "<div class='todo-list'>";
		echo "Today's goals:";
		echo "<ul>";
		$team_record = mysql_query("SELECT * FROM task WHERE user_id = '$u[0]' and task_date = '$time'");	
		while($h=mysql_fetch_row($team_record)){
			echo '<li><span>'.$h[3].'</span></li>';
		}	
		echo "</ul>";
		echo "</div>";		
			
		echo "</div>";		
	


		
	
	}
}
?>

<!-- 	<p class="goal_title">Today's goals:</p> -->


</div>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>

    delete_task(); // Call the delete_task function

    function delete_task() {
        $('.delete-button').click(function(){
	    var current_element = $(this);
	    var id = $(this).attr('id');

	    $.post('todo_list/includes/delete-task.php', { task_id: id }, function() {
		current_element.parent().fadeOut("fast", function() { $(this).remove(); });
	    });
        });
    }
    


</script>


</body>
</html>
