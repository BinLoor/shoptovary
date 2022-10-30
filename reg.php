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
if (!empty($_GET['login']) && !empty($_GET['password'])) {
$login = $_GET['login'];
$password = $_GET['password'];

    $sql = sprintf('SELECT ID FROM users WHERE `login`=\'%s\'', $login);
    $stmt = $db->query($sql)->fetch();
    if ($stmt) {
        $result = '{"error": {"text": "Такой логин уже занят"}}';
    }
    else {
        $token = md5(time());
        $expiration = time() + 48*60*60;
        $sql = sprintf('INSERT INTO users SET `login`=\'%s\', passw=\'%s\', token=\'%s\', expired=FROM_UNIXTIME(%d)', $login, $password, $token, $expiration);
        $db->exec($sql);

        $sql = sprintf('SELECT ID FROM users WHERE `login`=\'%s\'', $login);
        $stmt = $db->query($sql);
        while ($row = $stmt->fetch()) {
            $result = '{"user": {"ID": '.$row['ID'].'"text": "OK"}}';
        }
    }
}
else {
    $result = '{"error": {"text": "Не передан логин/пароль"}}';
}
echo $result;
?>
