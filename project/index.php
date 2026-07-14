<?php

require '../includes/auth_check.php';
require '../config/database.php';

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn, "

SELECT
    projects.*,
    workspaces.name AS workspace_name

FROM projects

INNER JOIN workspaces
ON projects.workspace_id = workspaces.id

WHERE workspaces.user_id='$user_id'

ORDER BY projects.id DESC

");

include '../includes/header.php';
include '../includes/sidebar.php';

?>

<style>
html{
    scroll-behavior:smooth;
}

main{
    animation:fadePage .7s ease;
}

.page-header{
    opacity:0;
    transform:translateY(30px);
    animation:fadeUp .7s ease forwards;
    animation-delay:.1s;
}

.card{
    opacity:0;
    transform:translateY(30px);
    animation:fadeUp .8s ease forwards;
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

<main class="flex-1 p-8 bg-background">

    <div class="flex items-center justify-between mb-8 page-header">

        <div>

            <h1 class="text-3xl font-bold">
                My Projects
            </h1>

            <p class="text-slate-400 mt-2">
                Kelola seluruh project pada workspace Anda.
            </p>

        </div>

        <a
            href="create.php"
            class="bg-primary hover:bg-indigo-700 px-5 py-3 rounded-xl font-semibold transition">

            + New Project

        </a>

    </div>

<?php if(mysqli_num_rows($query)>0): ?>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

<?php while($project=mysqli_fetch_assoc($query)): ?>

<?php

$project_id=$project['id'];

$task=mysqli_query($conn,"
SELECT COUNT(*) total
FROM tasks
WHERE project_id='$project_id'
");

$task=mysqli_fetch_assoc($task);

?>

<div class="card p-6">

    <div class="flex justify-between items-start">

        <div class="w-14 h-14 rounded-2xl bg-primary flex items-center justify-center">

            <i data-lucide="folder-kanban" class="w-7 h-7"></i>

        </div>

<?php if($project['status']=="Active"): ?>

<span class="bg-emerald-500/20 text-emerald-400 px-3 py-1 rounded-full text-sm">

Active

</span>

<?php else: ?>

<span class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full text-sm">

Completed

</span>

<?php endif; ?>

    </div>

    <h2 class="text-2xl font-bold mt-5">

        <?= htmlspecialchars($project['name']); ?>

    </h2>

    <p class="text-slate-400 mt-3">

        Workspace :

        <span class="text-white">

            <?= htmlspecialchars($project['workspace_name']); ?>

        </span>

    </p>

    <p class="text-slate-400 mt-4 min-h-[60px]">

        <?= !empty($project['description'])
            ? htmlspecialchars($project['description'])
            : 'Belum ada deskripsi project.'; ?>

    </p>

    <div class="bg-slate-900 rounded-xl p-4 mt-6">

        <p class="text-slate-400 text-sm">

            Total Task

        </p>

        <h2 class="text-3xl font-bold mt-2">

            <?= $task['total']; ?>

        </h2>

    </div>

    <div class="flex gap-3 mt-6">

        <a
        href="edit.php?id=<?= $project['id']; ?>"
        class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-center py-3 rounded-xl font-semibold transition">

        Edit

        </a>

        <a
        href="delete.php?id=<?= $project['id']; ?>"
        onclick="return confirm('Hapus project ini?')"
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

<i data-lucide="folder-plus" class="w-10 h-10"></i>

</div>

<h2 class="text-2xl font-bold mt-6">

Belum ada Project

</h2>

<p class="text-slate-400 mt-3">

Tambahkan project pertama Anda.

</p>

<a
href="create.php"
class="inline-block mt-8 bg-primary hover:bg-indigo-700 px-6 py-3 rounded-xl font-semibold transition">

Create Project

</a>

</div>

<?php endif; ?>

</main>

</div>

<script>
lucide.createIcons();

document.querySelectorAll('.card').forEach((card,index)=>{
    card.style.animationDelay=(0.25+index*0.1)+"s";
});
</script>

<?php include '../includes/footer.php'; ?>