<?php
//$con = mysql_connect("exato-db-instance.cwbw53vhehej.us-west-2.rds.amazonaws.com","Zulfaqar", "94025467z");
$con = mysql_connect("localhost","root", "");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("exato_database", $con);
//mysql_select_db("energy_project", $con);

$query = mysql_query(" SELECT 
                    ifnull(round(value,2),0.00) AS api_value,
                    ifnull(DATE_FORMAT(time_stamp,'%d-%b'),0) as daily_date
                    
                FROM readings
               
                WHERE 
                    sensor = 'pool_temp'
                    -- AND time_stamp = current_time() ");
$result = array();
while($row = mysql_fetch_array($query)) {
    $result['data']= $row['api_value'];
    $result['date']= $row['daily_date'];
}


//array_push($result,);


print json_encode($result, JSON_NUMERIC_CHECK);

mysql_close($con);
?>
