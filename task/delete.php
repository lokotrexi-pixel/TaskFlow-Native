<?php

require '../includes/auth_check.php';
require '../config/database.php';


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    header("Location:index.php");
    exit;

}


$id = (int) $_GET['id'];

$user_id = (int) $_SESSION['user_id'];



/*
|--------------------------------------------------------------------------
| Hapus task hanya milik user yang login
|--------------------------------------------------------------------------
*/


$query = mysqli_query($conn, "

DELETE tasks

FROM tasks

INNER JOIN projects

ON tasks.project_id = projects.id

INNER JOIN workspaces

ON projects.workspace_id = workspaces.id


WHERE tasks.id='$id'

AND workspaces.user_id='$user_id'

");



header("Location:index.php");

exit;