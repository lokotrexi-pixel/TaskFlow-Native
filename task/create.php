<?php

require '../includes/auth_check.php';
require '../config/database.php';

$user_id = $_SESSION['user_id'];

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

    INSERT INTO tasks

    (
        project_id,
        title,
        description,
        status,
        deadline
    )

    VALUES

    (
        '$project_id',
        '$title',
        '$description',
        '$status',
        '$deadline'
    )

    ");


    header("Location:index.php");
    exit;

}


include '../includes/header.php';
include '../includes/sidebar.php';

?>

<style>
html{
    scroll-behavior:smooth;
}

main{
    animation:fadePage .35s ease;
}

.form-card{
    opacity:0;
    transform:translateY(40px) scale(.98);
    animation:fadeUp .45s ease forwards;
    animation-delay:.15s;
}

@keyframes fadePage{
    from{
        opacity:0;
    }
    to{
        opacity:1;
    }
}

@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(40px) scale(.98);
    }
    to{
        opacity:1;
        transform:translateY(0) scale(1);
    }
}
</style>


<div class="flex-1 flex flex-col">

<?php include '../includes/navbar.php'; ?>


<main class="flex-1 p-4 sm:p-6 md:p-8 bg-background">


<div class="max-w-3xl mx-auto">


<div class="card p-8 form-card">


<h1 class="text-3xl font-bold mb-2">

Create Task

</h1>


<p class="text-slate-400 mb-8">

Tambahkan task baru ke dalam project.

</p>



<form method="POST" class="space-y-6">



<div>

<label class="block mb-2 font-medium">

Project

</label>


<select
name="project_id"
required
class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none">


<?php while($project=mysqli_fetch_assoc($projects)): ?>


<option value="<?= $project['id']; ?>">

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

></textarea>


</div>




<div>


<label class="block mb-2 font-medium">

Status

</label>


<select

name="status"

class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none"

>


<option value="Todo">

Todo

</option>


<option value="Doing">

Doing

</option>


<option value="Done">

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

class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none"

>


</div>





<div class="flex flex-col gap-3 sm:flex-row">


<button

name="submit"

class="bg-primary hover:bg-indigo-700 px-6 py-3 rounded-xl font-semibold transition"

>


Create Task


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