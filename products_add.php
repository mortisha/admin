<?php
require_once('include/bootstrap.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['title'] != '' && $_POST['content'] != '' && $_POST['price'] != '') {
		if ($_FILES['image']['tmp_name'] != '') {//tmp_name 
			$filename = rand(1, 10000).$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], 'storage/'.$filename);
		} else {
			$filename = '';
		}
			$price = $_POST['price'];
			if (strpos($price, ',')) $price = str_replace(',', '.', $price);


			db_insert('products', array(
				'title' => $_POST['title'],
				'content' => $_POST['content'],
				'price' => $_POST['price'],
				//'image' => $filename
			));
	}

	redirect('products.php');
}

require_once('include/header.php');

?>
<div class="content">

	<h2> Добави продукт </h2>
	<form action="" method="post" enctype="multipart/form-data">
		<label>
			Заглавие
			<input type="text" name="title">
		</label>
		<br>
		<label>
			Описание
			<input type="text" name="content">
		</label>
		<br>
		<label>
			Цена на продукта
			<input type="text" name="price">
		</label>
		<br>
		<label>
			Промоционален продукт:
			<input type="radio" name="promo" value="">
		</label>
		<button type="submit">Запази</button>
		<button type="reset">Изчисти</button>
	</form>
</div>

<?php
require_once('include/footer.php');