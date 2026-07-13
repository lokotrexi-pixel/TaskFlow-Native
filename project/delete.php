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
| Pastikan project milik user yang login
|--------------------------------------------------------------------------
*/

$check = mysqli_query(
    $conn,
    "
    SELECT
        projects.id
    FROM projects
    INNER JOIN workspaces
        ON projects.workspace_id = workspaces.id
    WHERE
        projects.id='$id'
        AND workspaces.user_id='$user_id'
    "
);

if (mysqli_num_rows($check) == 0) {
    header("Location: index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| Hapus seluruh task pada project
|--------------------------------------------------------------------------
*/

mysqli_query(
    $conn,
    "
    DELETE FROM tasks
    WHERE project_id='$id'
    "
);

/*
|--------------------------------------------------------------------------
| Hapus project
|--------------------------------------------------------------------------
*/

mysqli_query(
    $conn,
    "
    DELETE FROM projects
    WHERE id='$id'
    "
);

header("Location: index.php");
exit;