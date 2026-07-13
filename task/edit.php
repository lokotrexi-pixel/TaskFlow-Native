<?php

require '../includes/auth_check.php';
require '../config/database.php';

$id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];


/*
|--------------------------------------------------------------------------
| Ambil task milik user
|--------------------------------------------------------------------------
*/

$query = mysqli_query($conn, "

SELECT
    tasks.*

FROM tasks

INNER JOIN projects
ON tasks.project_id = projects.id

INNER JOIN workspaces
ON projects.workspace_id = workspaces.id

WHERE tasks.id='$id'

AND workspaces.user_id='$user_id'

");


$task = mysqli_fetch_assoc($query);


if(!$task){

    header("Location:index.php");
    exit;

}



/*
|--------------------------------------------------------------------------
| Ambil project milik user
|--------------------------------------------------------------------------
*/

$projects = mysqli_query($conn, "

SELECT

projects.*

FROM projects

INNER JOIN workspaces

ON projects.workspace_id = workspaces.id

WHERE workspaces.user_id='$user_id'

ORDER BY projects.name ASC

");




if(isset($_POST['submit'])){


    $project_id = $_POST['project_id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $status = $_POST['status'];
    $deadline = $_POST['deadline'];



    mysqli_query($conn, "

    UPDATE tasks

    SET

        project_id='$project_id',

        title='$title',

        description='$description',

        status='$status',

        deadline='$deadline'


    WHERE id='$id'

    ");



    header("Location:index.php");
    exit;


}



include '../includes/header.php';
include '../includes/sidebar.php';


?>


<div class="flex-1 flex flex-col">


<?php include '../includes/navbar.php'; ?>


<main class="flex-1 p-8 bg-background">


<div class="max-w-3xl mx-auto">


<div class="card p-8">



<h1 class="text-3xl font-bold mb-2">

Edit Task

</h1>


<p class="text-slate-400 mb-8">

Perbarui informasi task.

</p>




<form method="POST" class="space-y-6">





<div>


<label class="block mb-2 font-medium">

Project

</label>


<select

name="project_id"

class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none"

>


<?php while($project=mysqli_fetch_assoc($projects)): ?>


<option

value="<?= $project['id']; ?>"

<?= $project['id']==$task['project_id'] ? 'selected' : ''; ?>

>


<?= htmlspecialchars($project['name']); ?>


</option>


<?php endwhile; ?>


</select>


</div>






<div>


<label class="block mb-2 font-medium">

Task Title

</label>


<input

type="text"

name="title"

required

value="<?= htmlspecialchars($task['title']); ?>"

class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none"

>


</div>







<div>


<label class="block mb-2 font-medium">

Description

</label>


<textarea

name="description"

rows="5"

class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none resize-none"

><?= htmlspecialchars($task['description']); ?></textarea>


</div>






<div>


<label class="block mb-2 font-medium">

Status

</label>


<select

name="status"

class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none"

>


<option value="Todo"
<?= $task['status']=="Todo"?'selected':''; ?>>

Todo

</option>


<option value="Doing"
<?= $task['status']=="Doing"?'selected':''; ?>>

Doing

</option>


<option value="Done"
<?= $task['status']=="Done"?'selected':''; ?>>

Done

</option>


</select>


</div>







<div>


<label class="block mb-2 font-medium">

Deadline

</label>


<input

type="date"

name="deadline"

value="<?= $task['deadline']; ?>"

class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none"

>


</div>






<div class="flex gap-4">


<button

name="submit"

class="bg-primary hover:bg-indigo-700 px-6 py-3 rounded-xl font-semibold transition"

>


Update Task


</button>




<a

href="index.php"

class="bg-slate-700 hover:bg-slate-600 px-6 py-3 rounded-xl transition"

>


Cancel


</a>



</div>



</form>




</div>


</div>



</main>


</div>



<?php include '../includes/footer.php'; ?>