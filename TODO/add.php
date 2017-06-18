<?php

require_once 'todo.php';

if(isset($_POST['name']))
{
	$name = trim($_POST['name']); //ignore space

	if(!empty($name))
	{
		$addedQuery = $db->prepare("
			INSERT INTO items(name, user, done, created)
			VALUES (:name, :user, 0, NOW())
			");

		$addedQuery->execute([
			'name' => $name,
			'user' => $_SESSION['user_id']
			]);
	}
}


if(isset($_POST['name']))
{

	if(!empty($name))
	{
		$addedQuery = $db->prepare("
			DELETE FROM items
			WHERE user_id=1 
			AND user=1
			");
	}
}

header ("Location: index.php");
exit();
