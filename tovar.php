<?php
$host = 'db';
$db_name = 'tovar';
$db_user = 'root';
$db_pas = '1234';
$result = '{"response":[';




try {
    $db = new PDO('mysql:host='.$host.';dbname='.$db_name,$db_user,$db_pas);
}
catch (PDOException $e) {
    print "error: " . $e->getMessage();
    die();
}

$stmt = $db->query("SELECT t.`ID`,`TITLE`,`DESCRIPTION`,`PRICE`,`COUNT`,`NAME` FROM `tovary` AS t JOIN `kateg` AS k ON t.ID_CAT=k.ID");

while ($row = $stmt->fetch()) {
    $result .= '{';
    $result .= '"id":'.$row['ID'].',"title":"'.$row['TITLE'].'","desc":"'.$row['DESCRIPTION'].'","price":'.$row['PRICE'].',"count":'.$row['COUNT'].',"kat":"'.$row['NAME'].'"';
    $result .= '},';
}

$result = rtrim($result, ",");
$result .= ']}';
echo $result;
