<?php

$db = new SQLite3(__DIR__ . '/../springfield_news.db');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['visibility']) && $_GET['visibility'] === 'free') {
        $result = $db->query("SELECT * FROM articles WHERE art_visibilitat = 'public'");
    }elseif (isset($_GET['visibility']) && $_GET['visibility'] === 'premium') {
        $result = $db->query("SELECT * FROM articles WHERE art_visibilitat = 'subscriber'");
    }elseif (isset($_GET['date']) && $_GET['date'] === '2025-03-01') {
        $result = $db->query("SELECT * FROM articles WHERE art_data_publicacio >= '2025-03-01 00:00:00'");

    }
    else {
        $result = $db->query("SELECT * FROM articles");
    }

    $lista = [];

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $lista[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($lista);

} 
?>
