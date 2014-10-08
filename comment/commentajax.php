<?php
include('config.php');
if($_POST)
{
$name=$_POST['title'];
$email=$_POST['email'];
$detail=$_POST['comment'];
$post_id=$_POST['post_id'];

$lowercase = strtolower($email);
  $image = md5( $lowercase );
  
mysql_query("insert into comment(com_name,com_email,com_detail,post_id) values ('$name','$email','$detail','$post_id')");

}

else { }

?>
<li class="box">
<img src="http://www.gravatar.com/avatar.php?gravatar_id=<?php echo $image; ?>" class="com_img"/><span  class="com_name"> <?php echo $name;?></span> <br /><br />

<?php echo $comment; ?>
</li>