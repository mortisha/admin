<?php
require_once('include/bootstrap.php');
require_once('include/header.php');
is_logged_in();

$success = false;
$errors = false;
$exists = false;
$username = '';
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT username FROM users WHERE username = '" . $username . "'";

    $found_results = db_select($sql);

    if(validate_field($username) && validate_field($password)){
        if(count($found_results) == 0){
            db_insert('users', array(
                'username' => $username,
                'password' => md5($password)
            ));

            $success = true;
        } else {
            $exists = true;
        }

    } else {
        $errors = true;
    }
}

?>

    <div class="content">
        <?php if($success == true): ?>
        <div class="success">Потребителя е добавен успешно!</div>
        <?php endif; ?>

        <?php if($errors == true && $exists == false): ?>
            <div class="error">Попълнете формата правилно!</div>
        <?php endif; ?>

        <?php if($errors == false && $exists == true): ?>
            <div class="error">Този потребител вече съществува!</div>
        <?php endif; ?>

        <form action="" method="POST">
            <div>
                <label for="">Потребител:</label>
                <input type="text" name="username" id="" value="<?php echo $username;?>"/>
            </div>

            <div>
                <label for="">Парола:</label>
                <input type="password" name="password" id=""/>
            </div>

            <button type="submit">Добави</button>
        </form>
    </div>

<?php
require_once('include/footer.php');