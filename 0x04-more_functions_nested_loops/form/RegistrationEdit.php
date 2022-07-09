<?php
session_start();
include_once("connection.php");
if(isset($_SESSION['id']))
$query="SELECT * FROM user where id=$mid";
$result=$db->query($query);
}
function setValue($feildVAlue)
{
    if($_POST[$feildVAlue])
    {
        echo $_POST[$feildVAlue];
    }
    if($result)
    {
        echo $result[$feildVAlue]
    }
}
?>
?>