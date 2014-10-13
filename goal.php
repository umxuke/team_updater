<?php

require_once "config/db1.php";
session_start();

$name = $_SESSION["user_name"];


// $result = mysql_query("SELECT user_id FROM users WHERE user_name = '$name'");
// $userid = mysql_fetch_row($result)[0];

if ( isset($_POST['date'])) {
	$time = $_POST['day'];
}
else {
$time = date('Y-m-d');
}

?>


<html>

<head>
  <meta charset="utf-8">
  <title>Goal Setting</title>
  <link type="text/css" rel="stylesheet" href="views/css/glike.css"> 
</head>

<body>

  <div class="header"> 
		<img id="logo" src="views/img/logo.png" width="120" height="100">
		<div class="loginname">
			<span class="hi">Hi,</span><span class="user"><?php echo $_SESSION['user_name']; ?></span>
			<a class="logout" href="index.php?logout">Logout</a>
		</div>
		<div class="headernavigationbar">
			<span class="selectednavigationtext">
			<img class="plusicon"align="absmiddle" src="views/img/plus icon-07.png" width="25.9" height="25.9" scr="">
			<a href="form.php" >Goal Setting</a></span>
			<span class="navigationtext"><a href="profile.php" >Profile</a></span>
			<span class="navigationtext"><a href="discussion.php" >Discussion</a></span>           
		</div>
  </div>

  <div class="whitebackgroundgroup_bigger">

          <div id="table" class="grid_16">
          		<form method="post">
          			Date (time zone): <input type="date" name="day" value="<?php echo $time; ?>" >
          			<input type="submit" value="Send" name="date">
          		</form>
          		
				<form action="form.php" method="post">
  				<table border="0" class="table_detail">
                	<tr class="table_header">
                    	<td width="11%" class="table_top_left">Name</td>
                        <td width="20%">Task</td>
                        <td width="13%">Complexion (%)</td>
                        <td width="18%">Cooperators</td>
                        <td width="25%" class="table_top_right">Comment</td>                        
                        <td width="13%" class="table_end"></td>
                    </tr>
                    
				 <?php 
					$j=0;
					$tablecolor=array('rgba(0,0,0,0)','rgba(255, 202, 0, 0.45)');
                    $result = mysql_query("SELECT * FROM users");
                    while ( $row = mysql_fetch_row($result) ) {
							 
						echo('<tr style="background:');
						if ($j%2 == 0){						
							echo(htmlentities($tablecolor[0]));
						} else {
							echo(htmlentities($tablecolor[1]));
						}
						echo(';"><td class="name_title">');
					    echo(htmlentities($row[1]));
					    
					    $userid = mysql_fetch_row(mysql_query("SELECT user_id FROM users WHERE user_name = '$row[1]'"))[0];
						
					    $result2 = mysql_query("SELECT description, complexion, comment FROM task WHERE user_id = '$userid' and task_date = '$time'");
					    $task_record = mysql_fetch_row($result2);
					    echo("</td><td> $task_record[0]");
					    echo("</td><td> $task_record[1]");
					    echo("</td><td>");
					    echo("</td><td> $task_record[2]");
					    echo('</td><td style="background:white">');
						if ($row[1] == $_SESSION['user_name'] and $time == date('Y-m-d')) {
							echo("<input type='submit' class='button' type='edit'  name='useredit' value='Edit'>");
						}
						$j=$j+1;
						echo("</td></tr>\n");						
					}
				?>

                    <tr class="table_bottom">
                    	<td class="table_bottom_left"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="table_bottom_right"></td>
                    </tr>
                    					              
                </table>             
                </form> 				
 		 </div>
                
  </div>
  	
</body>
</html>