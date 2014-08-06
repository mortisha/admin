<?php
require_once('include/bootstrap.php');
 $sql ='
        SELECT products.id, products.title, products.content, products.price, COUNT(images.id) as cnt
        FROM products
        LEFT JOIN images ON products.id=images.product_id
        GROUP BY products.id
    ';
    $results = db_select($sql);

if (isset($_GET['action'])) {

	switch ($_GET['action']) {
		case 'delete':
			db_delete('products', $_GET['id']);
			redirect('products.php?action=success');
		break;
		case 'success':
			$deleteMsg = 'Изтриването успешно';
			break;
		default:
			redirect('products.php');
			break;
	}
}

require_once('include/header.php');
?>
<div class="content">
	<a href="products_add.php">Добави Продукт</a>
    <br/><br/>
	<table>
		<tr>
			<th width="30%">Заглавие</th>
			<th width="30%">Описание</th>
			<th width="20%">Цена</th>
			<th width="20%">Снимки</th>
					<th>Действие</th>
		</tr>
		<?php foreach ($results as $key => $value) : ?>
		<tr>
			<td><?=$value['title']?></td>
			<td><?=$value['content']?></td>
			<td><?=$value['price']?></td>
			<td><a href="products_images.php?id=<?=$value['id']?>"><?=$value['cnt']?></a></td>
						<td><a href="products_edit.php?id=<?=$value['id']?>">Редактирай</a> / <a href="products.php?action=delete&id=<?=$value['id']?>">Изтрий</a></td>
		</tr>
		<?php endforeach; ?>
		<?php if (isset($deleteMsg)) : ?>
		<tr>
			<th colspan="4"><div class="success"><?= $deleteMsg ?></div></th>
		</tr>
		<?php endif; ?>
	</table>
	<br>
</div>
<?php
require_once('include/footer.php');