<?php

require '../includes/auth_check.php';
require '../config/database.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];
$user_id = (int) $_SESSION['user_id'];

/*
|--------------------------------------------------------------------------
| Cek apakah workspace milik user yang login
|--------------------------------------------------------------------------
*/

$check = mysqli_query(
    $conn,
    "SELECT id
     FROM workspaces
     WHERE id='$id'
     AND user_id='$user_id'"
);

if (mysqli_num_rows($check) == 0) {
    header("Location: index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| Hapus seluruh task yang berada di project workspace ini
|--------------------------------------------------------------------------
*/

mysqli_query(
    $conn,
    "DELETE tasks
     FROM tasks
     INNER JOIN projects
        ON tasks.project_id = projects.id
     WHERE projects.workspace_id='$id'"
);

/*
|--------------------------------------------------------------------------
| Hapus seluruh project
|--------------------------------------------------------------------------
*/

mysqli_query(
    $conn,
    "DELETE FROM projects
     WHERE workspace_id='$id'"
);

/*
|--------------------------------------------------------------------------
| Hapus workspace
|--------------------------------------------------------------------------
*/

mysqli_query(
    $conn,
    "DELETE FROM workspaces
     WHERE id='$id'
     AND user_id='$user_id'"
);

header("Location: index.php");
exit;