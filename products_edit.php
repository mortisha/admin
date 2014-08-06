<?php
require_once('include/bootstrap.php');
$product = products_get($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$product = array(
		'title' => $_POST['title'],
		'content' => $_POST['content'],
		'price' => $_POST['price']
	);
	db_update('products', $product, $_GET['id']);

	redirect('products.php');
}

require_once('include/header.php');

?>
<div class="content">
	<h2> Редактирай продукт: <em><?php echo $product['title']?></em> </h2>
	<form action="" method="post">
		<label>
			Заглавие
			<input type="text" name="title" value="<?php echo $product['title']?>">
		</label>
		<br>
		<label>
			Цена
			<input type="text" name="price" value="<?php echo $product['price']?>">
		</label>
		<br>
		<label>
			Описание
			<textarea name="content"><?php echo $product['content']?></textarea>
		</label>
		<label>
			Промоционален продукт:
			<input type="radio" name="promo" value="">
		</label>
		<br>
		<br>
		<button type="submit">Запази</button>
	</form>
</div>

<?php
require_once('include/footer.php');