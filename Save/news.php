<?php


// Общие данные
$site = 'https://news.mail.ru/story/incident/coronavirus/';
$protocol = 'https:';
$html = file_get_contents($site);

// Документ phpQuery
$doc = phpQuery::newDocument($html);

// Главные новости
$newsItems = $doc->find('.newsitem');

// Перебираем новости, вытаскиваем заголовки и ссылки
$news = array();
foreach ($newsItems as $newsItem) {
    // Находим нужный элемент
    $newsElem = pq($newsItem)->find('a');
    $newsElemSpan = pq($newsItem)->find('a span');
    $newsElemTime = pq($newsItem)->find('.newsitem__param');
    // Вытаскиваем атрибуты
    $title = $newsElemSpan->text();
    $time = $newsElemTime->text();
    echo $newsElemTime;
    $link = $newsElem->attr('href');
    

    // Сохраняем результаты в массив
    array_push($news, array(
        'title' => $title,
        'link' => $link,
        'time' => $time
    ));
}

?>