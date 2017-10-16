<?php
error_reporting(E_ALL);
require_once 'core/core.php';
$allFiles = scandir(__DIR__ . '/json');
$id = $_GET['id'];
if(!array_key_exists("$id", $allFiles)){
    header('Location: 404.php');
}else {
    $fileTest = $allFiles[$id];
    $data = file_get_contents(__DIR__ . "/json/$fileTest");
    $dataJson = json_decode($data);
    $count = 1; //счетчик у input radio
    $score = 0; //количество правильных ответов
}
noAdmin();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Тесты</title>
    <link rel=" stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <?php if(isAuthorized()){ ?>
        <p>Вы вошли как <strong><em><?= $_SESSION['user']['name']?></em></strong></p>
    <?php }?>
    <p><a href="list.php">Перейти к выбору теста</a></p>
    <h2><?php echo $dataJson[0]->title; ?></h2>
    <form action="" method="post">
        <?php foreach($dataJson as $questions):
            if(is_array($questions)): ?>
                <?php foreach($questions as $question):?>
                    <fieldset>
                        <legend><?= $question->question ?></legend>
                        <p>
                            <input type="radio" id="first" name="q<?= $count ?>" value="<?= $question->answer->ans1 ?>">
                            <label for="first"><?= $question->answer->ans1 ?></label>
                        </p>
                        <p>
                            <input type="radio" id="two" name="q<?= $count ?>" value="<?= $question->answer->ans2 ?>">
                            <label for="two"><?= $question->answer->ans2 ?></label>
                        </p>
                        <p>
                            <input type="radio" id="three" name="q<?= $count ?>" value="<?= $question->answer->ans3 ?>">
                            <label for="three"><?= $question->answer->ans3 ?></label>
                        </p>
                    </fieldset>
                    <?php if(!empty($_POST["q$count"])):
                        if($_POST["q$count"] == $question->right):
                            $score++;
                        endif;
                    endif;
                    $count++;
                endforeach ?>
            <?php endif ?>
        <?php endforeach ?>
        <input type="submit" name="submit" value="Посмотреть результат">
    </form>
    <?php
    if(!empty($_POST['submit'])){
        $_SESSION['allQuestion'] = count($questions);
        $_SESSION['rightQuestion'] = $score;
        //$_SESSION['name'] = $_POST['name'];
        ?>
        <img src="certificate.php">
    <?php } ?>

</div>
</body>
</html>