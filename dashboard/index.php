<?php

require '../includes/auth_check.php';
require '../config/database.php';


$user_id = $_SESSION['user_id'];


// Workspace
$workspace = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM workspaces
WHERE user_id='$user_id'
");

$workspace = mysqli_fetch_assoc($workspace);



// Project
$project = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM projects

INNER JOIN workspaces
ON projects.workspace_id = workspaces.id

WHERE workspaces.user_id='$user_id'
");

$project = mysqli_fetch_assoc($project);




// Total Task
$task = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM tasks

INNER JOIN projects
ON tasks.project_id = projects.id

INNER JOIN workspaces
ON projects.workspace_id = workspaces.id

WHERE workspaces.user_id='$user_id'
");

$task = mysqli_fetch_assoc($task);




// Completed Task
$done = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM tasks

INNER JOIN projects
ON tasks.project_id = projects.id

INNER JOIN workspaces
ON projects.workspace_id = workspaces.id

WHERE workspaces.user_id='$user_id'

AND tasks.status='Done'
");

$done = mysqli_fetch_assoc($done);



$progress = 0;


if($task['total'] > 0){

    $progress = round(
        ($done['total'] / $task['total']) * 100
    );

}



include '../includes/header.php';

include '../includes/sidebar.php';

?>


<style>


html{

    scroll-behavior:smooth;

}



/* muncul saat load */

.dashboard-show{

    opacity:0;

    animation:fadeUp .45s ease forwards;

}



.delay-1{

    animation-delay:.05s;

}


.delay-2{

    animation-delay:.1s;

}


.delay-3{

    animation-delay:.15s;

}


.delay-4{

    animation-delay:.2s;

}




@keyframes fadeUp{


from{

    opacity:0;

    transform:translateY(35px);

}


to{

    opacity:1;

    transform:translateY(0);

}


}





.dashboard-card{

    transition:.3s ease;

}



.dashboard-card:hover{

    transform:translateY(-8px);

    box-shadow:0 20px 40px rgba(99,102,241,.15);

}





.progress-bar{

    transform-origin:left center;
    animation:progressAnimation 1.5s ease forwards;

}



@keyframes progressAnimation{


from{

    transform:scaleX(0);

}

to{

    transform:scaleX(1);

}


}





</style>





<div class="flex-1 flex flex-col">


<?php include '../includes/navbar.php'; ?>



<main class="flex-1 p-4 sm:p-6 md:p-8 bg-background">





<div class="mb-10 dashboard-show">


<h1 class="text-2xl sm:text-3xl md:text-4xl font-bold break-words">


Welcome Back,

<?= htmlspecialchars($_SESSION['name']); ?> 👋


</h1>



<p class="text-slate-400 mt-3">

Kelola workspace, project, dan task dengan lebih mudah.

</p>


</div>









<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">






<div class="card dashboard-card dashboard-show delay-1 p-6">


<div class="flex justify-between">


<div>


<p class="text-slate-400">

Workspace

</p>


<h2 class="text-4xl font-bold mt-3">

<?= $workspace['total']; ?>

</h2>


</div>



<div class="bg-indigo-500/20 p-4 rounded-xl">


<i data-lucide="folder" class="w-7 h-7"></i>


</div>



</div>


</div>









<div class="card dashboard-card dashboard-show delay-2 p-6">


<div class="flex justify-between">


<div>


<p class="text-slate-400">

Project

</p>


<h2 class="text-4xl font-bold mt-3">

<?= $project['total']; ?>

</h2>


</div>



<div class="bg-blue-500/20 p-4 rounded-xl">


<i data-lucide="briefcase" class="w-7 h-7"></i>


</div>



</div>


</div>









<div class="card dashboard-card dashboard-show delay-3 p-6">


<div class="flex justify-between">


<div>


<p class="text-slate-400">

Tasks

</p>


<h2 class="text-4xl font-bold mt-3">

<?= $task['total']; ?>

</h2>


</div>



<div class="bg-yellow-500/20 p-4 rounded-xl">


<i data-lucide="check-square" class="w-7 h-7"></i>


</div>



</div>


</div>









<div class="card dashboard-card dashboard-show delay-4 p-6">


<div class="flex justify-between">


<div>


<p class="text-slate-400">

Completed

</p>


<h2 class="text-4xl font-bold mt-3">

<?= $done['total']; ?>

</h2>


</div>



<div class="bg-emerald-500/20 p-4 rounded-xl">


<i data-lucide="circle-check" class="w-7 h-7"></i>


</div>



</div>


</div>





</div>









<div class="card dashboard-show mt-8 p-8">


<div class="flex justify-between mb-4">


<h2 class="text-xl font-bold">

Task Progress

</h2>



<span class="text-slate-400">

<?= $progress; ?>%

</span>



</div>





<div class="w-full bg-slate-800 rounded-full h-3">


<div

class="bg-primary h-3 rounded-full progress-bar"

style="width: <?= $progress; ?>%"

>

</div>


</div>



</div>









<div class="card dashboard-card dashboard-show mt-8 p-8">


<h2 class="text-2xl font-bold mb-3">


About TaskFlow


</h2>



<p class="text-slate-400 leading-8">


TaskFlow adalah aplikasi manajemen tugas berbasis Native PHP
yang membantu pengguna mengelola Workspace,
Project, dan Task secara sederhana,
cepat, dan responsif.


</p>


</div>







</main>


</div>





<script>


lucide.createIcons();


</script>



<?php include '../includes/footer.php'; ?>