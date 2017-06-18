<?php

	require_once 'todo.php';
	
	$itemsQuery = $db->prepare("
		SELECT id, name, done
		FROM items
		WHERE user = :user
		");

	$itemsQuery->execute(['user' => $_SESSION['user_id']]);

	$items = $itemsQuery->rowCount() ? $itemsQuery : [];
?>


<!DOCTYPE HTML>
<html lang = "pl">
<head>
	<meta charset = "utf-8" />
	<meta http-equiv="X-UA-Compatible" content = "IE = edge, chrome = 1" />
	<title>TODO list</title>

	<link href="css/main.css" rel="stylesheet" media="screen">
	<link href="https://fonts.googleapis.com/css?family=Just+Me+Again+Down+Here" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Patrick+Hand+SC" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 

	<script type="text/javascript">
		function refreshDiv()
		{
			var today = new Date;

			var h = today.getHours();
			var m = today.getMinutes();
			var s = today.getSeconds();

			if(h<10)
			{
				h = "0"+h;
			}
			if(m<10)
			{
				m = "0"+m;
			}
			if(s<10)
			{
				s = "0"+s;
			}

			document.getElementById("date").innerHTML = h+":"+m+":"+s;
			setTimeout("refreshDiv()", 1000);  
		}	 
	</script>

	<script type="text/javascript">
		function animate()
		{
			$(document).ready(function(){
				         $(".input").fadeTo("slow", 0.5);
				         $(".input").fadeTo("slow", 1.0);
				    });

			setTimeout("animate()", 1500);  
		}	 
	</script>

</head>
<body onload="refreshDiv(); animate();">

	<div class = "list">
		<div class="circle" id="kolo">
			<h1 class = "header">To do</h1>
		</div>

		<?php  if(!empty($items)):  ?>
		<ul class="items">
			<?php foreach ($items as $item): ?>
				<li>
					<?php if(!$item['done']): ?>
					<a href="mark.php?as=done&item=<?php echo $item['id']; ?>" >
						<span class="item<?php echo $item['done'] ? ' done' : ''  ?>"><?php echo $item['name']; ?></span>
					</a>

					<a href="delete.php?id=<?php echo $item['id'];?>" class="delete-button">x</a>
					<?php endif; ?>

			
					<?php if($item['done']): ?>
					<a href="mark.php?as=notdone&item=<?php echo $item['id']; ?>">
						<span class="item<?php echo $item['done'] ? ' done' : ''  ?>"><?php echo $item['name']; ?></span>
					</a>

					<a href="delete.php?id=<?php echo $item['id'];?>" class="delete-button">x</a>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
				
		</ul>
		<?php  else:  ?>
			<p>Lista jest pusta</p>
		<?php endif; ?>


		<form class="item-add" action="add.php" method="post">
			<input type="text" name="name" placeholder="Type a new item here." class="input" autocomplete="off" required="">
			<input type="submit" value="ADD" class="submit">
		</form>


		<div id="date"></div>
		<div style="clear:both;"></div>
	</div>
</body>
</html>