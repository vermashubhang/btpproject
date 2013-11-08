<?php
header("Access-Control-Allow-Origin: *");
/*
 * Author: doug@neverfear.org
 */

require("Dijkstra.php");
function floattostr( $val )
{
    preg_match( "#^([\+\-]|)([0-9]*)(\.([0-9]*?)|)(0*)$#", trim($val), $o );
    return $o[1].sprintf('%d',$o[2]).($o[3]!='.'?$o[3]:'');
}
class Foo
{
       public $latitude;
       public $longitude;
}
function runTest() {
	$g = new Graph();
	
       $db = new SQLite3("/home/shubhang/www/BTPProject/src/db.db");
       $sql2 = "SELECT * FROM distances ;";
       $res2 = $db->query($sql2);
       $count=0;
       $array = array();
       while($res = $res2->fetchArray(SQLITE3_ASSOC))
       {
             // $key = new Foo();
              $key = $res['Start_Latitude'];
              $key2 = $res['Start_Longitude'];
              $key = floattostr($key).",".floattostr($key2);
              
              //echo $key."</br>";
              
              //$key->longitude = $res['Start_Longitude'];
              if(!array_key_exists ( $key , $array))
              {
                     $array[$key] = $count;
                     //array_push($array,$key=>$count);
                     $count++;
              }
              
              //$key1 = new Foo();
              $key1 = $res['End_Latitude'];
              //$key = $res['Start_Latitude'];
              $key2 = $res['End_Longitude'];
              $key1 = floattostr($key1).",".floattostr($key2);
              //$key1->longitude = $res['End_Longitude'];
              if(!array_key_exists ( $key1 , $array))
              {
                     $array[$key1] = $count;
                    // array_push($array,$key1=>$count);
                     $count++;
              }
              
              $g->addedge($array[$key],$array[$key1],$res['Time_0']);
              $g->addedge($array[$key1],$array[$key],$res['Time_0']);
	       //$a = new Foo();
	       //$a->start_latitude = $res['Start_Latitude'];
	       //$a->start_longitude = $res['Start_Longitude'];
	       
	       //$a->end_latitude = $res['End_Latitude'];
	       //$a->end_longitude = $res['End_Longitude'];
	       //$g->addedge();
       }
       
       
	/*
	$g->addedge("a", "b", 4.9);
	$g->addedge("b", "d", 10.1);
	$g->addedge("a", "d", 5.1);
	$g->addedge("a", "c", 5.9);
	$g->addedge("c", "d", 5.9);
	
	
	$g->addedge("b", "a", 4.9);
	$g->addedge("d", "b", 10.1);
	$g->addedge("d", "a", 5.1);
	$g->addedge("c", "a", 5.9);
	$g->addedge("d", "c", 5.9);
	
	*/
	
	
	
	/*$g->addedge("a", "b", 4);
	$g->addedge("a", "d", 1);

	$g->addedge("b", "a", 74);
	$g->addedge("b", "c", 2);
	$g->addedge("b", "e", 12);

	$g->addedge("c", "b", 12);
	$g->addedge("c", "j", 12);
	$g->addedge("c", "f", 74);

	$g->addedge("d", "g", 22);
	$g->addedge("d", "e", 32);

	$g->addedge("e", "h", 33);
	$g->addedge("e", "d", 66);
	$g->addedge("e", "f", 76);

	$g->addedge("f", "j", 21);
	$g->addedge("f", "i", 11);

	$g->addedge("g", "c", 12);
	$g->addedge("g", "h", 10);

	$g->addedge("h", "g", 2);
	$g->addedge("h", "i", 72);

	$g->addedge("i", "j", 7);
	$g->addedge("i", "f", 31);
	$g->addedge("i", "h", 18);

	$g->addedge("j", "f", 8);

       */
       //echo $count;
	//list($distances, $prev) = $g->paths_from(80);
	
	//$path = $g->paths_to($prev, 150);
	//echo($path[1]);
	//print_r($path);
	$array1 = array();
       $j=0;
	for($j=0;$j<sizeof($path);$j++)
	{
	       foreach($array as $key=>$value)
	       {
                     if($value==$path[$j])
                     {
                            $var1 = explode(",", $key);
                            $n1 = new node();
                            $n1->latitude  = $var1[0];
                            $n1->longitude = $var1[1];
                            array_push($array1,$n1);
                            break;
                     }
                     //echo $key;
              }
	}
	
	echo json_encode($array1);
	
	
}
class myedge 
{
       public $start_latitude;
       public $start_longitude;
       public $end_latitude;
       public $end_longitude;
}

class node
{
       public $latitude;
       public $longitude;
}
runTest();
?>
