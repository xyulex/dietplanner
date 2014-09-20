<?php

    $conn = mysql_connect("localhost", "root", "")  or die(mysql_error());
    mysql_select_db("diet", $conn) or die(mysql_error());
    $q = strtolower($_GET["term"]);

  $return = array();
    $query = mysql_query("select name from ingredients where name like '%$q%'") or die(mysql_error());
    while ($row = mysql_fetch_array($query)) {
      array_push($return,array('label'=>$row['name'],'value'=>$row['name']));
  }
  echo(json_encode($return));

?>
