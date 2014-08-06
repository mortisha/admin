<?php
require_once('include/bootstrap.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//да се провери дали не може двете заявки да се обединят в 1

	if ($_FILES['image']['tmp_name'] != '') {
		//старата картинка да се изтрие

		$filename = rand(1, 10000).$_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'], 'storage/'.$filename);

		db_update('news', array('image' => $filename), $_GET['id']);

	}

	db_update('news', array(
		'title' => $_POST['title'],
		'content' => $_POST['content']
	),$_GET['id']);

	redirect('news.php');
}

$data = news_get($_GET['id']);

require_once('include/header.php');

?>
<div class="content">

	<h2> Редактирай новина: <em><?php echo $data['title']?></em> </h2>
	<form action="" method="post" enctype="multipart/form-data">
		<label>
			Заглавие
			<input type="text" name="title" value="<?php echo $data['title']?>">
		</label>
		<br>
		<label>
			Съдържание
			<textarea name="content"><?php echo $data['content']?></textarea>
		</label>
		<br>
		<?php if ($data['image'] != '') { ?>
		<img src="storage/<?php echo $data['image']?>" width="100">
		<br>
		<?php } ?>
		<label>
			Качете нова картинка
			<input type="file" name="image">
		</label>
		<br>
		<button type="submit">Запази</button>
		<button type="reset">Изчисти</button>
	</form>
</div>

<?php
require_once('include/footer.php');