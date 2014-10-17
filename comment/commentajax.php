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

<li class="box">

<?php 
echo $username;
echo " (";
echo date('Y-m-d H:i:s');
echo "): ";
echo $comment;

?>





<br>
</li>










