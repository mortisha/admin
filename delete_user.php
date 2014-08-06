<?php
require_once('include/bootstrap.php');

$id = $_GET['id'];
db_delete('users', $id);

redirect('users.php');
