<?php
$host = 'db';
$db_name = 'tovar';
$db_user = 'root';
$db_pas = '1234';

try {
    $db = new PDO('mysql:host='.$host.';dbname='.$db_name,$db_user,$db_pas);
}
catch (PDOException $e) {
    print "error: " . $e->getMessage();
    die();
}

$result = '';
session_start();
$token = $_SESSION['token'];


if (isset($token)) {
    $sql = sprintf('SELECT `ID` FROM `users` WHERE `TOKEN` LIKE \'%s\' AND `EXPIRED` > CURRENT_TIMESTAMP', $token);
    $stmt = $db->query($sql)->fetch();
    if (isset($stmt['ID'])) {
        $id_user = $stmt['ID'];
        $result = '{"response":[';
        $sql = sprintf('SELECT t.`ID`, `TITLE`, t.`DESCRIPTION`, t.`PRICE`, k.`COUNT`, kat.`NAME` FROM `korzina` AS k JOIN `tovary` AS t ON k.`TOVAR_ID` = t.`ID` JOIN `kateg` AS kat ON t.`ID_CAT` = kat.`ID` WHERE `ID_USER` = %d', $id_user);
        $stmt = $db->query($sql);
        while ($row = $stmt->fetch()) {
            $result .= '{';
            $result .= '"id":'.$row['ID'].',"title":"'.$row['TITLE'].'","desc":"'.$row['DESCRIPTION'].'","price":'.$row['PRICE'].',"count":'.$row['COUNT'].',"kat":"'.$row['NAME'].'"';
            $result .= '},';
        }
        $result = rtrim($result, ",");
        $result .= ']}';
    }
    else {
        $result = '{"error": {"text": "Неверный или просроченный токен"}}';
    }
}
else {
    $result = '{"error": {"text": "Не передан токен"}}';
}
echo $result;
