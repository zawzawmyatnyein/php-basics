<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database'], password: 'aVVrnNzcJX');

$currentUserId = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note = $db->query('select * from notes where id = :id', [
        'id' => $_POST['id']
    ])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    $db->query('delete from notes where id = :id', [
        'id' => $_POST['id']
    ]);

    header('location: /notes');
    exit();

} else {
    $note = $db->query('select * from notes where id = :id', [
        'id' => $_GET['id']
    ])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    require view("notes/show.view.php", [
        'heading' => 'Note',
        'note' => $note,
    ]);
}
