<?php

require_once 'todo.php';



if(isset($_GET['id']))
{
	$idd = $_GET['id'];
	try 
    {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM items WHERE id = $idd";

    // use exec() because no results are returned
    $db->exec($sql);
    echo "Record deleted successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
}

header ('Location: index.php');
exit();

