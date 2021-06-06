<?php
define ("DB_HOST", "localhost"); 
define ("DB_USER", "root"); 
define ("DB_PASS",""); 
define ("DB_NAME","rpaams"); 

$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");

$user_input = trim($_REQUEST['term']);

// Define two array, one is to store output data and other is for display
$display_json = array();
//$fetch_json = array();
$json_arr = array();
 //$json_arr1 = array();
$user_input = preg_replace('/\s+/', ' ', $user_input);

$query = 'SELECT s_id FROM t_user_data WHERE s_id LIKE "%'.$user_input.'%" order by s_id LIMIT 5';

 
$recSql = mysql_query($query);
if(mysql_num_rows($recSql)>0){
while($recResult = mysql_fetch_assoc($recSql)) {
  
  $json_arr["value"] = $recResult['s_id'];

  
  array_push($display_json, $json_arr);

}
} 
else {
  
  $json_arr["value"] = "";

  
  array_push($display_json, $json_arr);

}
 
$jsonWrite = json_encode($display_json); 
print $jsonWrite;




?>