<?php
session_start();


if (isset($_SESSION["text"])) {
    $text = $_SESSION["text"];

    $url = explode("\r\n", $text);
} else
{
    $url = array();
$url[] = 'http://twitrss.me/twitter_user_to_rss/?user=kinopoiskru'; //адрес RSS ленты
$url[] = 'http://twitrss.me/twitter_user_to_rss/?user=fetedayy'; //адрес RSS ленты
}


echo '<p id="time">' . date("H:i:s", strtotime("+1 hour")) . '</p>';
echo '<br/>';



$count = 1;
if (isset($_SESSION["count_news"]))
{
    $count_news = $_SESSION["count_news"];

}else{
    $count_news = 25;
}



    foreach ($url AS $rss) {


        if ($count <= $count_news) {
            echo '<p id="resource-news">Ресурс новостей:</p><p id="rss-news">' . $rss . '</p><br/>';
            $rsss = simplexml_load_file($rss); //Интерпретирует XML-файл в объект
        }

//цикл для обхода всей RSS ленты

        foreach ($rsss->channel->item as $item) {

            if ($count <= $count_news) {
                echo $count;
                echo '<h1>' . $item->pubDate . '</h1>';//выводим на печать заголовок статьи

                echo $item->description; //выводим на печать текст статьи
                echo '<p id="line"></p>';
                $count = $count + 1;

            }
        }
    }
