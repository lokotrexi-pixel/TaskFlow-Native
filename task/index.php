<?php

require '../includes/auth_check.php';
require '../config/database.php';


$user_id = $_SESSION['user_id'];


$query = mysqli_query($conn, "

SELECT
    tasks.*,
    projects.name AS project_name,
    workspaces.name AS workspace_name

FROM tasks

INNER JOIN projects
ON tasks.project_id = projects.id

INNER JOIN workspaces
ON projects.workspace_id = workspaces.id

WHERE workspaces.user_id='$user_id'

ORDER BY tasks.id DESC

");



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

.page-header{
    opacity:0;
    transform:translateY(30px);
    animation:fadeUp .45s ease forwards;
    animation-delay:.1s;
}

.card{
    opacity:0;
    transform:translateY(30px);
    animation:fadeUp .45s ease forwards;
    transition:transform .35s ease, box-shadow .35s ease;
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 45px rgba(79,70,229,.18);
}

@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(30px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

@keyframes fadePage{
    from{opacity:0;}
    to{opacity:1;}
}
</style>

<div class="flex-1 flex flex-col">


<?php include '../includes/navbar.php'; ?>



<main class="flex-1 p-4 sm:p-6 md:p-8 bg-background">



<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-8 page-header">



<div>

<h1 class="text-3xl font-bold">

My Tasks

</h1>


<p class="text-slate-400 mt-2">

Kelola seluruh task pada project Anda.

</p>


</div>




<div class="flex gap-3">


<a
href="create.php"
class="bg-primary hover:bg-indigo-700 px-5 py-3 rounded-xl font-semibold transition flex items-center gap-2">


<i data-lucide="plus" class="w-5 h-5"></i>

New Task


</a>




<a
href="export.php"
class="bg-emerald-600 hover:bg-emerald-700 px-5 py-3 rounded-xl font-semibold transition flex items-center gap-2">


<i data-lucide="file-down" class="w-5 h-5"></i>

Export PDF


</a>



</div>


</div>





<?php if(mysqli_num_rows($query)>0): ?>



<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">



<?php while($task=mysqli_fetch_assoc($query)): ?>



<div class="card p-6">



<div class="flex justify-between items-center">



<div class="w-14 h-14 rounded-2xl bg-primary flex items-center justify-center">


<i data-lucide="check-check" class="w-7 h-7"></i>


</div>





<?php if($task['status']=="Todo"): ?>


<span class="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-sm">

Todo

</span>


<?php elseif($task['status']=="Doing"): ?>


<span class="bg-yellow-500/20 text-yellow-300 px-3 py-1 rounded-full text-sm">

Doing

</span>


<?php else: ?>


<span class="bg-emerald-500/20 text-emerald-400 px-3 py-1 rounded-full text-sm">

Done

</span>


<?php endif; ?>



</div>





<h2 class="text-2xl font-bold mt-5">


<?= htmlspecialchars($task['title']); ?>


</h2>





<p class="text-slate-400 mt-3">


Workspace :

<span class="text-white">

<?= htmlspecialchars($task['workspace_name']); ?>

</span>


</p>





<p class="text-slate-400 mt-1">


Project :

<span class="text-white">

<?= htmlspecialchars($task['project_name']); ?>

</span>


</p>







<p class="text-slate-400 mt-4 min-h-[70px]">


<?= !empty($task['description'])

? htmlspecialchars($task['description'])

: 'Belum ada deskripsi task.'; ?>


</p>






<div class="bg-slate-900 rounded-xl p-4 mt-6">


<p class="text-slate-400 text-sm">

Deadline

</p>



<h3 class="text-lg font-bold mt-2">


<?= 

$task['deadline']

? date('d M Y',strtotime($task['deadline']))

: '-';

?>


</h3>


</div>







<div class="flex gap-3 mt-6">



<a

href="edit.php?id=<?= $task['id']; ?>"

class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-center py-3 rounded-xl font-semibold transition">


Edit


</a>





<a

href="delete.php?id=<?= $task['id']; ?>"

onclick="return confirm('Hapus task ini?')"

class="flex-1 bg-red-500 hover:bg-red-600 text-center py-3 rounded-xl font-semibold transition">


Delete


</a>



</div>





</div>




<?php endwhile; ?>



</div>





<?php else: ?>





<div class="card p-12 text-center">



<div class="w-20 h-20 rounded-full bg-primary mx-auto flex items-center justify-center">


<i data-lucide="clipboard-plus" class="w-10 h-10"></i>


</div>





<h2 class="text-2xl font-bold mt-6">

Belum ada Task

</h2>




<p class="text-slate-400 mt-3">

Tambahkan task pertama Anda.

</p>





<a

href="create.php"

class="inline-flex items-center gap-2 mt-8 bg-primary hover:bg-indigo-700 px-6 py-3 rounded-xl font-semibold transition">


<i data-lucide="plus" class="w-5 h-5"></i>


Create Task


</a>



</div>





<?php endif; ?>




</main>



</div>




<script>
lucide.createIcons();

document.querySelectorAll('.card').forEach((card,index)=>{
    card.style.animationDelay=(0.08+index*0.06)+"s";
});
</script>



<?php include '../includes/footer.php'; ?>