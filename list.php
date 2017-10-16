<?php
error_reporting(E_ALL);
require_once 'core/core.php';
$allFiles = scandir(__DIR__ . '/json');
noAdmin();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список тестов</title>
    <link rel=" stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <?php if(isAuthorized()){ ?>
        <p>Вы вошли как <strong><em><?= $_SESSION['user']['name']?></em></strong></p>
    <?php }?>
    <?php foreach($allFiles as $id => $file):
        if($file == '.' || $file == '..'){
            continue;
        }
        ?>
        <p>
            <a href="test.php?id=<?php echo $id ?>">
                <?php  echo $file?>
            </a>
        </p>

    <?php endforeach ?>
    <?php if(isAuthorized()){ ?>
        <h3><a class="add" href="admin.php">Добавить тест</a></h3>
        <fieldset>
            <legend>Удалить тест</legend>
            <?php foreach($allFiles as $id => $file):
                if($file == '.' || $file == '..'){
                    continue;
                }
                ?>
                <p>
                    <a class="del" href="delet_test.php?id=<?php echo $id ?>">Удалить</a>
                    <?php  echo $file?>
                </p>
            <?php endforeach ?>
        </fieldset>
    <?php }?>
</div>
</body>
</html>