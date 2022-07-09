
<?php
$dsn="mysql:host=localhost ,db name=customer";
$userName="root";
$password="1234567";
$db=new pdo($dsn,$userName,$password);
$db->setAttribute(pDo::ATTR_ERRMODE,PDO::ERRMODE_EXEPTION);
?>