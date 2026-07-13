<?php

require '../includes/auth_check.php';
require '../config/database.php';

if (isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $user_id = $_SESSION['user_id'];

    $query = mysqli_query(
        $conn,
        "INSERT INTO workspaces(user_id,name,description)
         VALUES('$user_id','$name','$description')"
    );

    if ($query) {
        header("Location: index.php");
        exit;
    }
}

include '../includes/header.php';
include '../includes/sidebar.php';

?>

<div class="flex-1 flex flex-col">

<?php include '../includes/navbar.php'; ?>

<main class="flex-1 p-8 bg-background">

<div class="max-w-3xl mx-auto">

<div class="bg-card border border-bordercolor rounded-2xl p-8">

<h1 class="text-3xl font-bold mb-2">
Create Workspace
</h1>

<p class="text-slate-400 mb-8">
Tambahkan workspace baru untuk mengelola project dan task.
</p>

<form method="POST" class="space-y-6">

<div>

<label class="block mb-2 font-medium">
Workspace Name
</label>

<input
type="text"
name="name"
required
class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none focus:border-primary">

</div>

<div>

<label class="block mb-2 font-medium">
Description
</label>

<textarea
name="description"
rows="5"
class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none focus:border-primary resize-none"></textarea>

</div>

<div class="flex gap-4">

<button
name="submit"
class="bg-primary hover:bg-indigo-700 px-6 py-3 rounded-xl font-semibold transition">

Create Workspace

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