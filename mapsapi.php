<?php
header("Access-Control-Allow-Origin: *");
$db = new SQLite3("/home/shubhang/www/BTPProject/src/db.db");
$sql2 = "SELECT * FROM edges ;";
$res2 = $db->query($sql2);
class Foo
{
    public $start_latitude;
    public $start_longitude;
	public $end_latitude;
	public $end_longitude;
}
$array = array();
while($res = $res2->fetchArray(SQLITE3_ASSOC))
{
	$a = new Foo();
	$a->start_latitude = $res['Start_Latitude'];
	$a->start_longitude = $res['Start_Longitude'];
	
	$a->end_latitude = $res['End_Latitude'];
	$a->end_longitude = $res['End_Longitude'];
	
	
	array_push($array,$a);
}
echo json_encode($array);
?>
