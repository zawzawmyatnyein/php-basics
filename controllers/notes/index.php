<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database'], password: 'aVVrnNzcJX');

$notes = $db->query('select * from notes where user_id = 1')->get();

require view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes,
]);
