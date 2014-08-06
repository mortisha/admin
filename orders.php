<?php
require_once('include/bootstrap.php');

$sql = 'SELECT * FROM orders';
$result = db_select($sql);

//$pages = new Pages($db_connection);
//$result = $pages->getAll();

if (isset($_GET['action'])) {

	switch ($_GET['action']) {
		case 'delete':
			db_delete('orders', $_GET['id']);
			redirect('orders.php?action=success');
		break;
		case 'success':
			$deleteMsg = 'Изтриването успешно';
			break;
		default:
			redirect('orders.php');
			break;
	}
}

require_once('include/header.php');
?>
<div class="content">
	
	<table>
		<tr>
			<th width="50%">#</th>
			<th width="10%">Дата</th>
			<th width="10%">Име</th>
			<th width="10%">Емайл</th>
			<th width="10%">Телефон</th>
			<th width="10%">Продукт</th>
			<th width="10%">Цена</th>
			<th>Действие</th>
		</tr>
		<?php foreach ($result as $key => $value) :?>
		<tr>
			<td><?=$value['id']?></td>
			<td><?=$value['date_added']?></td>
			<td><?=$value['name']?></td>
			<td><?=$value['email']?></td>
			<td><?=$value['phone']?></td>
			<td><?=$value['product_title']?></td>
			<td><?=$value['product_price']?></td>
			<td><a href="approved_orders.php?id=<?=$value['id']?>">Одобри</a> / <a href="orders.php?action=delete&id=<?=$value['id']?>">Изтрий</a></td>
		</tr>
		<?php endforeach; ?>
		<?php if (isset($deleteMsg)) : ?>
		<tr>
			<th colspan="3"><?= $deleteMsg ?></th>
		</tr>
		<?php endif; ?>
	</table>
	<br>
</div>
<?php
require_once('include/footer.php');