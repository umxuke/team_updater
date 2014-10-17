<?php 
include('../config/db1.php');
session_start(); 


if($_POST)
{
 
$username=mysql_real_escape_string($_SESSION["user_name"]);


$comment=$_POST['comment'];



//$comment=mysql_real_escape_string($comment);

//$lowercase = strtolower($email);
//$image = md5( $lowercase );
// mysql_query("insert into posts (post_dis,user_name) values ('$comment','$username')");
mysql_query("insert into posts (user_name,post_dis) values ('$username','$comment')");

}

?>


<?php 
$time = date('Y-m-d H:i:s');

echo "<div class='post'>";
echo "<img src='../views/img/avatar_standard.jpg' width='50' height='50'>";
echo "<span class='post_info'><span class='post_name'>";
echo $username, "</span><span class='post_time'> ($time)</span></span><span class='post_comment'> ";
echo $comment;
echo "</span><br>";
echo "</div>";
?>











