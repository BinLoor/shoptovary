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


$token = '';
session_start();
$token = $_SESSION['token'];

if (isset($token)) {
    $tovar_id = $_GET['id_tovara'];
    $count = $_GET['count'];
    $sql = sprintf('SELECT `ID` FROM `users` WHERE `TOKEN` LIKE \'%s\' AND `EXPIRED` > CURRENT_TIMESTAMP', $token);
    $stmt = $db->query($sql)->fetch();
    if (isset($stmt['ID'])) {
        $id_user = $stmt['ID'];

        $sql = sprintf('INSERT INTO `korzina` (`ID_USER`,`TOVAR_ID`,`COUNT`) VALUES (%d,%d,%d);', $id_user,$tovar_id,$count);
        $db->query($sql);
        $result = '{"response":{"text": "OK"}}';
    }
    else {
        $result = '{"error": {"text": "Неверный токен или просроченный токен"}}';
    }
}
else {
    $result = '{"error": {"text": "Не передан токен"}}';
}
echo $result;
