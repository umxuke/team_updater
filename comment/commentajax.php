<?php 
include('../config/db1.php');
session_start(); 


if($_POST)
{
 
$username=mysql_real_escape_string($_SESSION["user_name"]);
$comment=$_POST['comment'];
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






<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
//         if("<?php echo $timezone; ?>".length==0){
            var visitortime = new Date();
            var visitortimezone = ""+ -visitortime.getTimezoneOffset()/60;
            $.ajax({
                type: "GET",
                url: "timezone.php",
                data: 'time='+ visitortimezone,
                success: function(){
                    location.reload();
                }
            });
  //       }
    });
</script>





