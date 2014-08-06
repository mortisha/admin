<?php
require_once ('include/bootstrap.php');

$contacts = new Contacts($db_connection);
$result = $contacts->getAll();

if (isset($_GET['action'])) {

	switch ($_GET['action']) {
		case 'delete':
			$pages->delete($_GET['id']);
			redirect('pages.php?action=success');
		break;
		case 'success':
			$deleteMsg = 'Изтриването успешно';
			break;
		default:
			redirect('pages.php');
			break;
	}
}

require_once('include/header.php');
?>
<div class="content">
	
	<table>
		<tr>
			<th width="25%">Име</th>
			<th width="25%">Емайл</th>
			<th width="25%">Телефон</th>
			<th width="25%">Коментар</th>

		</tr>
		<?php foreach ($result as $key => $value) :?>
		<tr>
			<td><?=$value['name']?></td>
			<td><?=$value['email']?></td>
			<td><?=$value['phone']?></td>
			<td><?=$value['comment']?></td>
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