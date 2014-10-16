<?php
require_once "../config/db1.php";
session_start(); 

# Insert a task
$name = $_SESSION["user_name"];
$time = date('Y-m-d');

$result = mysql_query("SELECT user_id FROM users WHERE user_name = '$name'");
$userid = mysql_fetch_row($result)[0];

$task_record = mysql_query("SELECT * FROM task WHERE user_id = '$userid' and task_date = '$time'");
$task_record_row = mysql_fetch_row($task_record);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Discussion</title>
<meta charset="utf-8">
<link type="text/css"  rel="stylesheet" href="../views/css/glike.css">
<link type="text/css"  rel="stylesheet" href="../views/css/profile.css">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700' rel='stylesheet' type='text/css'>
  
 <script type="text/javascript" src="jquery.js"></script>
 <script type="text/javascript">
$(function() {

$(".submit").click(
function() {

var name = $("#name").val();
var email = $("#email").val();
	var comment = $("#comment").val();
		var post_id = $("#post_id").val();
    var dataString = 'name='+ name + '&email=' + email + '&comment=' + comment + '&post_id=' + post_id;
	
	if(name=='' || email=='' || comment=='')
     {
    alert('Please Give Valide Details');
     }
	else
	{
	$("#flash").show();
	$("#flash").fadeIn(400).html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Loading Comment...</span>');
$.ajax({
		type: "post",
  url: "commentajax.php",
   data: dataString,
  cache: false,
  success: function(html){
 
  $("ol#update").append(html);
  $("ol#update li:last").fadeIn("slow");
//   document.getElementById('email').value='';
//    document.getElementById('name').value='';
    document.getElementById('comment').value='';
	$("#name").focus();
 
  $("#flash").hide();
	
  }
 }
);
}
return false;
});



});


</script>
<style type="text/css">
/* 
body
{
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
}
 */
.comment_box
{
background-color:#D3E7F5; border-bottom:#ffffff solid 1px; padding-top:3px
}
a
	{
	text-decoration:none;
	color:#d02b55;
	}
	a:hover
	{
	text-decoration:underline;
	color:#d02b55;
	}
	*{margin:0;padding:0;}
	
	
	ol.timeline
	{list-style:none;
	font-size:1.2em;
	margin-bottom:20px;
	margin-top:-20px;
	margin-left:-50px;
	float:left;
	}
	
	ol.timeline li{ 
		display:none;
/* 		position:relative; */
		padding:.7em 0 .6em 0;
		
	}
	
	ol.timeline li:first-child{}
	
	#main
	{
	width:500px; margin-top:20px; margin-left:100px;
	font-family:"Trebuchet MS";
	}
	#flash
	{
	margin-left:100px;
	
	}
	.box
	{
	height:85px;
	border-bottom:#dedede dashed 1px;
	margin-bottom:20px;
	}
		input
	{
	color:#000000;
	font-size:14px;
	border:#666666 solid 2px;
	height:24px;
	margin-bottom:10px;
	width:200px;
	
	
	}
	textarea
	{
	color:#000000;
	font-size:14px;
	border:#FAFAFA solid 2px;
	height:124px;
	margin-bottom:10px;
	width:300px;
	border-radius:5px;
	box-shadow:#DDDDDD 2px 2px 2px 2px;
	}
	.titles{
	font-size:13px;
	padding-left:10px;
	
	
	}
	.star
	{
	color:#FF0000; font-size:16px; font-weight:bold;
	padding-left:5px;
	}
	
	.com_img
	{
	float: left; width: 80px; height: 80px; margin-right: 20px;
	}
	.com_name
	{
	font-size: 16px; color: rgb(102, 51, 153); font-weight: bold;
	}
	
	#post_form
	{
	margin-top:30px;
	margin-left:30px;
	float:left;
	width:700px;
	}
	.submit
	{
	background-color:rgba(46,226,255,0.4);
	width:200px;
	height:35px;
	border-radius:8px;
/* 	margin-left:30px; */
	border:0px;	
	font-size:14px	
	}
	.submit:hover
	{
	background-color:rgba(46,226,255,0.7);
	}
</style>
</head>

<body>
<div class="header"> 
<!-- 	<img id="logo" src="views/img/logo.png" width="120" height="100"> -->
	<div class="loginname">
		<span class="avatar"><img src="../views/img/avatar_standard.jpg" width="50" height="50"></span>
		<span class="account"><a href="../dashboard.php" >My Dashboard</a></span><br>
		<span class="user"><a href="../profile.php" ><?php echo $_SESSION['user_name']; ?></a></span><br>
		<a class="logout" href="../index.php?logout">Logout</a>
	</div>
	
	<div class="headernavigationbar">
		<img src="../views/img/teams.png" width="40" height="40"><span class="navigationtext"><a href="" >Teams</a></span>
		<img src="../views/img/goals.png" width="40" height="40"><span class="navigationtext"><a href="form.php" >Goals</a></span>
		<img src="../views/img/discussion.png" width="40" height="40"><span class="navigationtext"><a href="comment/comment.php" >Discussion</a></span>           
	</div>
</div>

<div class="whitebackgroundgroup_bigger">


<div id="main">

<ol  id="update" class="timeline">

<?php
include('config.php');
//$post_id value comes from the POSTS table

$sql=mysql_query("select * from posts");
while($row=mysql_fetch_array($sql))
{

// $name=$row['com_name'];
// $email=$row['com_email'];
$post_dis=$row['post_dis'];

echo "$post_dis";
echo "<br>";
$lowercase = strtolower($email);
$image = md5( $lowercase );

?>





<li class="box">
<img src="http://www.gravatar.com/avatar.php?gravatar_id=<?php echo $image; ?>" class="com_img">
<span class="com_name"> <?php echo $post_dis; ?></span> <br />
My Comment
</li>

<?php
}
?>

</ol>

</div>
</div>
<div id="flash" align="left"  ></div>

<div id="post_form">
<form action="#" method="post">
<input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id; ?>"/>
<!-- 
<input type="text" name="name" id="name"/><span class="titles">Name</span><span class="star">*</span><br />

<input type="text" name="email" id="email"/><span class="titles">Email</span><span class="star">*</span><br />
 -->

<textarea name="comment" id="comment" placeholder="Please enter you comment..."></textarea><br />

<input type="submit" class="submit" value=" Submit Comment " />
</form>
</div>




</div>

</body>
</html>
