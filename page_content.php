<?php
require_once('include/bootstrap.php');
require_once('include/header.php');
$sql = 'SELECT * FROM page';
$result = db_select($sql);


$res = new Pages($db_connection);
$data = $res -> get($_GET['id']);


?>
<div class="content">
	                   
	<div>
		<h2><?php echo $data['title'];?></a></h2>
		<br>
		<?php echo $data['content'];?></a>
	</div>
</div>

<?php
require_once('include/footer.php');    


	
			
			

