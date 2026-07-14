<?php

require '../includes/auth_check.php';
require '../config/database.php';

$user_id = $_SESSION['user_id'];

$workspaces = mysqli_query(
    $conn,
    "SELECT *
     FROM workspaces
     WHERE user_id='$user_id'
     ORDER BY name ASC"
);

if (isset($_POST['submit'])) {

    $workspace_id = $_POST['workspace_id'];
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $status = $_POST['status'];

    mysqli_query(
        $conn,
        "INSERT INTO projects
        (workspace_id,name,description,status)
        VALUES
        ('$workspace_id','$name','$description','$status')"
    );

    header("Location: index.php");
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
    animation:fadePage .6s ease;
}

.form-card{
    opacity:0;
    transform:translateY(40px) scale(.98);
    animation:fadeUp .7s ease forwards;
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

<main class="flex-1 p-8 bg-background">

<div class="max-w-3xl mx-auto">

<div class="card p-8 form-card">

<h1 class="text-3xl font-bold mb-2">

Create Project

</h1>

<p class="text-slate-400 mb-8">

Tambahkan project baru ke dalam workspace.

</p>

<form method="POST" class="space-y-6">

<div>

<label class="block mb-2 font-medium">

Workspace

</label>

<select
name="workspace_id"
required
class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none">

<?php while($workspace=mysqli_fetch_assoc($workspaces)): ?>

<option value="<?= $workspace['id']; ?>">

<?= htmlspecialchars($workspace['name']); ?>

</option>

<?php endwhile; ?>

</select>

</div>

<div>

<label class="block mb-2 font-medium">

Project Name

</label>

<input
type="text"
name="name"
required
class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none">

</div>

<div>

<label class="block mb-2 font-medium">

Description

</label>

<textarea
name="description"
rows="5"
class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none resize-none"></textarea>

</div>

<div>

<label class="block mb-2 font-medium">

Status

</label>

<select
name="status"
class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none">

<option value="Active">

Active

</option>

<option value="Completed">

Completed

</option>

</select>

</div>

<div class="flex gap-4">

<button
name="submit"
class="bg-primary hover:bg-indigo-700 px-6 py-3 rounded-xl font-semibold transition">

Create Project

</button>

<a
href="index.php"
class="bg-slate-700 hover:bg-slate-600 px-6 py-3 rounded-xl transition">

Cancel

</a>

</div>

</form>

</div>

</div>

</main>

</div>

<?php include '../includes/footer.php'; ?>