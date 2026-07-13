<?php

session_start();


if(isset($_SESSION['user_id'])){

    header("Location: dashboard/index.php");
    exit;

}

?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
TaskFlow - Task Management
</title>


<script src="https://cdn.tailwindcss.com"></script>


</head>


<body class="bg-slate-950 text-white">


<nav class="border-b border-slate-800">

<div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">


<h1 class="text-2xl font-bold">

<span class="text-indigo-500">
Task
</span>Flow

</h1>


<div class="flex gap-4">


<a
href="auth/login.php"
class="px-5 py-2 rounded-xl border border-slate-700 hover:bg-slate-800">

Login

</a>


<a
href="auth/register.php"
class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700">

Register

</a>


</div>


</div>

</nav>



<section class="max-w-7xl mx-auto px-6 py-24">


<div class="grid md:grid-cols-2 gap-12 items-center">


<div>


<p class="text-indigo-400 font-semibold mb-4">

TASK MANAGEMENT PLATFORM

</p>


<h1 class="text-5xl font-bold leading-tight">

Manage Your Work.
<br>

Track Your Progress.

</h1>


<p class="text-slate-400 text-lg mt-6 leading-8">

TaskFlow membantu kamu mengelola
Workspace, Project, dan Task
dengan lebih mudah, cepat, dan terstruktur.

</p>


<div class="flex gap-4 mt-8">


<a
href="auth/register.php"
class="px-7 py-3 bg-indigo-600 rounded-xl hover:bg-indigo-700 font-semibold">

Get Started

</a>


<a
href="auth/login.php"
class="px-7 py-3 border border-slate-700 rounded-xl hover:bg-slate-800">

Login

</a>


</div>


</div>



<div class="bg-slate-900 border border-slate-800 rounded-3xl p-8">


<div class="space-y-5">


<div class="bg-slate-800 rounded-xl p-5">

<h3 class="font-bold text-xl">

📁 Workspace

</h3>

<p class="text-slate-400 mt-2">

Organize your working space.

</p>

</div>


<div class="bg-slate-800 rounded-xl p-5">

<h3 class="font-bold text-xl">

📂 Project

</h3>

<p class="text-slate-400 mt-2">

Manage your projects efficiently.

</p>

</div>


<div class="bg-slate-800 rounded-xl p-5">

<h3 class="font-bold text-xl">

✅ Task

</h3>

<p class="text-slate-400 mt-2">

Track progress and deadlines.

</p>

</div>


</div>


</div>


</div>


</section>




<section class="max-w-7xl mx-auto px-6 pb-20">


<div class="grid md:grid-cols-3 gap-6">


<div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">

<h2 class="text-xl font-bold">

Simple

</h2>

<p class="text-slate-400 mt-3">

Interface sederhana dan mudah digunakan.

</p>

</div>



<div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">

<h2 class="text-xl font-bold">

Organized

</h2>

<p class="text-slate-400 mt-3">

Workspace, project, dan task tersusun rapi.

</p>

</div>




<div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">

<h2 class="text-xl font-bold">

Responsive

</h2>

<p class="text-slate-400 mt-3">

Nyaman digunakan desktop maupun mobile.

</p>

</div>


</div>


</section>



<footer class="border-t border-slate-800 py-6 text-center text-slate-500">

© <?= date('Y'); ?> TaskFlow. All Rights Reserved.

</footer>



</body>

</html>