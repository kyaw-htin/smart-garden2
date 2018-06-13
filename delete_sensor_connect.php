<?php

session_start();
include 'connection.php';

$uid=$_SESSION["user_id"];
if(isset($_POST['delete']))
{
 $cnt=array();
 $cnt=count($_POST['Sensor']);
 for($i=0;$i<$cnt;$i++)
  {
     $del_id=$_POST['Sensor'][$i];
     $query="delete from sensor where sensor_id='$del_id'";
     mysql_query($query);
  }
  if($result){
  	echo "<meta http-equiv=\"refresh\" content=\"0;URL=delete_sensor.php\">";
  }
  
  mysql_close();
}

?>