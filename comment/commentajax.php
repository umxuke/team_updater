<?php 
include('config.php');
if($_POST)
{
$name=$_POST['name'];
//$name=mysql_real_escape_string($name);
$email=$_POST['email'];
//$email=mysql_real_escape_string($email);
$comment=$_POST['comment'];
//$comment=mysql_real_escape_string($comment);
$post_id=$_POST['post_id']; 
//$post_id=mysql_real_escape_string($post_id);
$lowercase = strtolower($email);
$image = md5( $lowercase );
mysql_query("insert into posts (post_title,post_dis) values ('$name','$comment')");
}

?>

<li class="box">
<img src="http://www.gravatar.com/avatar.php?gravatar_id=
<?php echo $image; ?>"/>
<?php echo $name;?><br />
<?php echo $comment; ?>
</li>