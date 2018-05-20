<?php
session_start();

//Определяем текст для сохранения в форме ввода запроса
if (isset($_POST["text"])) {

    $we1 = $_POST["text"];
    $tt1 = explode('\r\n', $we1);

    foreach ($tt1 as $qq)
       {
           $value1 = trim($qq);
       }

}else{
    $value1 = "";
}


//Определяем количество новостей
if (isset($_POST['count_news'])) {
    $value2 = 'value='.$_POST["count_news"];
    $value2 = trim($value2);
}else{
    $value2 = " ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <title>Тестовое задание Netpeak</title>
</head>

<body>

<div id="block-body">

<div id="block-header">
    <h1>Тестовое задание Netpeak</h1>

    <div id="query-rss">
    <p>Введите новостные ссылки в формате RSS c переносом строки.</p>
        <p id="note">(Новостных лент может быть от одной до не ограниченного количества разных систем)</p>
        <p id="note"><br>Для проверки работы формы, можете например скопировать и ввести ссылки:</p>
        <p id="note">http://twitrss.me/twitter_user_to_rss/?user=lepralit</p>
        <p id="note">http://twitrss.me/twitter_user_to_rss/?user=BstSongQuotes</p>

    <form method="post">
        <p><textarea name="text"
                             placeholder="Примеры указания новостных лент, которые указаны по умолчанию:
http://twitrss.me/twitter_user_to_rss/?user=kinopoiskru
http://twitrss.me/twitter_user_to_rss/?user=fetedayy
"
                ><?php echo $value1; ?></textarea></p>

<label>Количество последних отображаемых новостей  <input id="count_news" type="text" name="count_news" placeholder="25 (например)" <?php echo $value2;?>  ></label>

        <p><input id="submit" type="submit" name="submit" value="Отобразить новости"></p>

    </form>
</div>

            <?php
      if ($_POST["submit"]) {
                if ($_POST["text"]) {

                    $_SESSION["text"] = $_POST["text"];

                }

                if ($_POST["count_news"]) {
                    $_SESSION["count_news"] = $_POST["count_news"];

                }
            }
            ?>

</div>


    <div id="block-content" >


    </div>
</div>




<!--Скрипт вывода онлайн-новостей, с обновлением в 1 секунду-->
<script>
    function show()
    {
        $.ajax({
            url: "include/block-content.php",
            cache: false,
            success: function(html){
                $("#block-content").html(html);
            }
        });
    }

    $(document).ready(function(){
        show();
        setInterval('show()',1000);
    });
</script>

</body>

