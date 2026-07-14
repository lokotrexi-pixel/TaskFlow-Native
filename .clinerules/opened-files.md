# Opened Files
## File Name
database\taskflow_native.sql
## File Content
-- ==========================================
-- DATABASE
-- ==========================================
CREATE DATABASE IF NOT EXISTS taskflow_native;
USE taskflow_native;

-- ==========================================
-- USERS
-- ==========================================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================================
-- WORKSPACES
-- ==========================================
CREATE TABLE workspaces (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE
);

-- ==========================================
-- PROJECTS
-- ==========================================
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    workspace_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    status ENUM('Active','Completed') DEFAULT 'Active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (workspace_id)
    REFERENCES workspaces(id)
    ON DELETE CASCADE
);

-- ==========================================
-- TASKS
-- ==========================================
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    status ENUM('Todo','Doing','Done') DEFAULT 'Todo',
    deadline DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (project_id)
    REFERENCES projects(id)
    ON DELETE CASCADE
);


# Opened Files
## File Name
auth\register.php
## File Content
<?php

session_start();

require '../config/database.php';


$error = "";


if(isset($_POST['register'])){


    $name = $_POST['name'];

    $email = $_POST['email'];

    $password = $_POST['password'];



    // cek email sudah ada atau belum

    $check = mysqli_query($conn,

        "SELECT * FROM users WHERE email='$email'"

    );



    if(mysqli_num_rows($check) > 0){


        $error = "Email sudah terdaftar!";


    }else{


        $password_hash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );



        $query = mysqli_query($conn,


        "INSERT INTO users

        (name,email,password)

        VALUES

        ('$name','$email','$password_hash')"


        );



        if($query){


            header("Location: login.php");

            exit;


        }


    }


}


?>


<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
Register - TaskFlow
</title>


<script src="https://cdn.tailwindcss.com"></script>

<style>

body{
    animation:fadePage .6s ease;
}

.auth-card{
    opacity:0;
    transform:translateY(40px) scale(.97);
    animation:fadeUp .8s ease forwards;
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
        transform:translateY(40px) scale(.97);
    }
    to{
        opacity:1;
        transform:translateY(0) scale(1);
    }
}

</style>

</head>



<body class="bg-slate-950 text-white min-h-screen flex items-center justify-center">



<div class="w-full max-w-md px-6">



<div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-xl auth-card">



<div class="text-center mb-8">


<h1 class="text-3xl font-bold">


<span class="text-indigo-500">
Task
</span>Flow


</h1>


<p class="text-slate-400 mt-2">

Create your TaskFlow account

</p>


</div>





<?php if($error): ?>


<div class="bg-red-500/10 border border-red-500/30 text-red-400 p-4 rounded-xl mb-5">


<?= $error ?>


</div>


<?php endif; ?>







<form method="POST">





<div class="mb-4">


<label class="text-sm text-slate-400">

Name

</label>


<input

type="text"

name="name"

required

class="w-full mt-2 px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-indigo-500"

placeholder="Your name"


>


</div>






<div class="mb-4">


<label class="text-sm text-slate-400">

Email

</label>


<input

type="email"

name="email"

required

class="w-full mt-2 px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-indigo-500"

placeholder="email@example.com"


>


</div>







<div class="mb-6">


<label class="text-sm text-slate-400">

Password

</label>


<input

type="password"

name="password"

required

class="w-full mt-2 px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-indigo-500"

placeholder="••••••••"


>


</div>







<button

name="register"

class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 font-semibold transition"


>

Create Account

</button>




</form>







<div class="text-center mt-6 text-slate-400">


Sudah punya akun?


<a

href="login.php"

class="text-indigo-400 hover:text-indigo-300 font-semibold"

>

Login

</a>


</div>





<div class="text-center mt-4">


<a

href="../index.php"

class="text-sm text-slate-500 hover:text-white"

>

← Kembali ke Landing Page

</a>


</div>






</div>


</div>



</body>

</html>
# Opened Files
## File Name
project\create.php
## File Content
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
# Opened Files
## File Name
project\edit.php
## File Content
<?php

require '../includes/auth_check.php';
require '../config/database.php';

$id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];

$data = mysqli_query($conn, "

SELECT
    projects.*,
    workspaces.user_id

FROM projects

INNER JOIN workspaces
ON projects.workspace_id = workspaces.id

WHERE projects.id='$id'
AND workspaces.user_id='$user_id'

");

$project = mysqli_fetch_assoc($data);

if (!$project) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $status = $_POST['status'];

    mysqli_query($conn, "

    UPDATE projects

    SET

        name='$name',
        description='$description',
        status='$status'

    WHERE id='$id'

    ");

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

Edit Project

</h1>

<p class="text-slate-400 mb-8">

Perbarui informasi project.

</p>

<form method="POST" class="space-y-6">

<div>

<label class="block mb-2 font-medium">

Project Name

</label>

<input
type="text"
name="name"
required
value="<?= htmlspecialchars($project['name']); ?>"
class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none">

</div>

<div>

<label class="block mb-2 font-medium">

Description

</label>

<textarea
name="description"
rows="5"
class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none resize-none"><?= htmlspecialchars($project['description']); ?></textarea>

</div>

<div>

<label class="block mb-2 font-medium">

Status

</label>

<select
name="status"
class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none">

<option
value="Active"
<?= $project['status']=="Active" ? "selected" : ""; ?>>

Active

</option>

<option
value="Completed"
<?= $project['status']=="Completed" ? "selected" : ""; ?>>

Completed

</option>

</select>

</div>

<div class="flex gap-4">

<button
name="submit"
class="bg-primary hover:bg-indigo-700 px-6 py-3 rounded-xl font-semibold transition">

Update Project

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
# Opened Files
## File Name
task\index.php
## File Content
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
    card.style.animationDelay=(0.25+index*0.1)+"s";
});
</script>



<?php include '../includes/footer.php'; ?>
# Opened Files
## File Name
task\create.php
## File Content
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





<div class="flex gap-4">


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
# Opened Files
## File Name
task\edit.php
## File Content
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
# Opened Files
## File Name
assets\css\style.css
## File Content
/* ===================================
   TASKFLOW
   Modern SaaS Dark Theme
=================================== */

html{
    scroll-behavior:smooth;
}

body{

    margin:0;

    font-family:'Inter',sans-serif;

    background:#020617;

    color:white;

}

/* Scrollbar */

::-webkit-scrollbar{

    width:8px;

}

::-webkit-scrollbar-track{

    background:#0f172a;

}

::-webkit-scrollbar-thumb{

    background:#334155;

    border-radius:999px;

}

::-webkit-scrollbar-thumb:hover{

    background:#475569;

}

/* Card */

.card{

    background:#1e293b;

    border:1px solid #334155;

    border-radius:18px;

    transition:.3s;

}

.card:hover{

    transform:translateY(-3px);

    box-shadow:0 18px 35px rgba(0,0,0,.35);

}

/* Button */

.btn{

    transition:.25s;

}

.btn:hover{

    transform:translateY(-2px);

}

/* Input */

input,
textarea,
select{

    transition:.25s;

}

input:focus,
textarea:focus,
select:focus{

    box-shadow:0 0 0 3px rgba(79,70,229,.35);

}

/* Link */

a{

    transition:.25s;

}

/* Table */

table{

    border-collapse:collapse;

}

th{

    font-weight:600;

}

tr{

    transition:.2s;

}

tbody tr:hover{

    background:rgba(255,255,255,.03);

}
# Opened Files
## File Name
includes\navbar.php
## File Content
<?php

$hari = [

    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu'

];


$bulan = [

    'January' => 'Januari',
    'February' => 'Februari',
    'March' => 'Maret',
    'April' => 'April',
    'May' => 'Mei',
    'June' => 'Juni',
    'July' => 'Juli',
    'August' => 'Agustus',
    'September' => 'September',
    'October' => 'Oktober',
    'November' => 'November',
    'December' => 'Desember'

];


$tanggalSekarang = 
$hari[date('l')] 
. ", " .
date('d')
. " "
. $bulan[date('F')]
. " "
. date('Y');

?>


<header class="h-20 bg-sidebar border-b border-bordercolor flex items-center justify-between px-8 nav-animation">


    <!-- Left -->

    <div>


        <h1 class="text-3xl font-bold tracking-tight">

            Dashboard

        </h1>



        <p class="text-slate-400 text-sm mt-1">

            Welcome back,

            <span class="text-white font-semibold">

                <?= htmlspecialchars($_SESSION['name']); ?>

            </span>

        </p>


    </div>





    <!-- Right -->

    <div class="flex items-center gap-5">





        <!-- Date -->


        <div class="hidden lg:flex items-center gap-3 bg-card rounded-xl px-5 py-3">


            <div class="w-10 h-10 rounded-xl bg-primary/20 flex items-center justify-center">


                <i 
                data-lucide="calendar-days"
                class="w-5 h-5 text-indigo-400">
                </i>


            </div>



            <div>


                <p class="text-xs text-slate-400">

                    Hari Ini

                </p>



                <p class="text-sm font-semibold">

                    <?= $tanggalSekarang; ?>

                </p>



            </div>


        </div>











        <!-- User -->


        <div class="flex items-center gap-3 profile-hover">



            <div

            class="w-11 h-11 rounded-full bg-primary flex items-center justify-center font-bold"

            >


                <?= strtoupper(substr($_SESSION['name'],0,1)); ?>


            </div>





            <div class="hidden md:block">


                <div class="font-semibold">


                    <?= htmlspecialchars($_SESSION['name']); ?>


                </div>



                <div class="text-xs text-slate-400">


                    <?= htmlspecialchars($_SESSION['email']); ?>


                </div>



            </div>



        </div>



    </div>




</header>




<script>

lucide.createIcons();

</script>
# Opened Files
## File Name
includes\sidebar.php
## File Content
<aside class="w-72 bg-sidebar border-r border-bordercolor flex flex-col sidebar-animation">


<div class="h-20 px-6 flex items-center border-b border-bordercolor">



<div class="w-11 h-11 rounded-xl bg-primary flex items-center justify-center shadow-lg">


<span class="text-xl font-bold">

T

</span>


</div>




<div class="ml-3">


<h1 class="text-xl font-bold tracking-wide logo-hover">

TaskFlow

</h1>



<p class="text-xs text-slate-400">

Project Management

</p>


</div>



</div>






<nav class="flex-1 p-5 space-y-2">



<a href="../dashboard/index.php"

class="sidebar-link menu-animation menu-1 flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 hover:bg-primary hover:text-white transition">


<i data-lucide="layout-dashboard"
class="w-5 h-5">
</i>


Dashboard


</a>





<a href="../workspace/index.php"

class="sidebar-link menu-animation menu-2 flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 hover:bg-primary hover:text-white transition">


<i data-lucide="folders"
class="w-5 h-5">
</i>


Workspace


</a>






<a href="../project/index.php"

class="sidebar-link menu-animation menu-3 flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 hover:bg-primary hover:text-white transition">


<i data-lucide="folder-kanban"
class="w-5 h-5">
</i>


Projects


</a>






<a href="../task/index.php"

class="sidebar-link menu-animation menu-4 flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 hover:bg-primary hover:text-white transition">


<i data-lucide="check-square"
class="w-5 h-5">
</i>


Tasks


</a>



</nav>







<div class="border-t border-bordercolor px-5 pt-5 pb-20">



<div class="rounded-2xl bg-card p-4 user-card">


<div class="flex items-center gap-3">



<div class="w-11 h-11 rounded-full bg-primary flex items-center justify-center font-bold">


<?= strtoupper(substr($_SESSION['name'],0,1)); ?>


</div>



<div>


<h3 class="font-semibold">

<?= htmlspecialchars($_SESSION['name']); ?>

</h3>


<p class="text-xs text-slate-400">

<?= htmlspecialchars($_SESSION['email']); ?>

</p>


</div>



</div>





<a href="../auth/logout.php"

class="mt-4 flex justify-center items-center gap-2 bg-red-500 hover:bg-red-600 rounded-xl py-3 transition">


<i data-lucide="log-out"
class="w-5 h-5">
</i>


Logout


</a>


</div>



</div>



</aside>



<script>

lucide.createIcons();

</script>
# Opened Files
## File Name
dashboard\index.php
## File Content
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

    animation:fadeUp .8s ease forwards;

}



.delay-1{

    animation-delay:.15s;

}


.delay-2{

    animation-delay:.3s;

}


.delay-3{

    animation-delay:.45s;

}


.delay-4{

    animation-delay:.6s;

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

    animation:progressAnimation 1.5s ease forwards;

}



@keyframes progressAnimation{


from{

    width:0;

}


}





</style>





<div class="flex-1 flex flex-col">


<?php include '../includes/navbar.php'; ?>



<main class="flex-1 p-8 bg-background">





<div class="mb-10 dashboard-show">


<h1 class="text-4xl font-bold">


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
# Opened Files
## File Name
workspace\index.php
## File Content
<?php

require '../includes/auth_check.php';
require '../config/database.php';

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn, "
SELECT *
FROM workspaces
WHERE user_id='$user_id'
ORDER BY id DESC
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
                My Workspaces
            </h1>

            <p class="text-slate-400 mt-2">
                Kelola seluruh workspace Anda.
            </p>

        </div>

        <a
            href="create.php"
            class="bg-primary hover:bg-indigo-700 px-5 py-3 rounded-xl font-semibold transition">

            + New Workspace

        </a>

    </div>

    <?php if(mysqli_num_rows($query) > 0): ?>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        <?php while($workspace = mysqli_fetch_assoc($query)): ?>

        <?php

        $workspace_id = $workspace['id'];

        $project = mysqli_query($conn,"
            SELECT COUNT(*) total
            FROM projects
            WHERE workspace_id='$workspace_id'
        ");

        $project = mysqli_fetch_assoc($project);

        $task = mysqli_query($conn,"
            SELECT COUNT(*) total
            FROM tasks
            INNER JOIN projects
            ON tasks.project_id=projects.id
            WHERE projects.workspace_id='$workspace_id'
        ");

        $task = mysqli_fetch_assoc($task);

        ?>

        <div class="card p-6">

            <div class="flex items-center justify-between">

                <div class="w-14 h-14 rounded-2xl bg-primary flex items-center justify-center">

                    <i data-lucide="folders" class="w-7 h-7"></i>

                </div>

                <span class="text-xs bg-slate-700 px-3 py-1 rounded-full">

                    Workspace

                </span>

            </div>

            <h2 class="text-2xl font-bold mt-5">

                <?= htmlspecialchars($workspace['name']); ?>

            </h2>

            <p class="text-slate-400 mt-3 min-h-[60px]">

                <?= !empty($workspace['description'])
                    ? htmlspecialchars($workspace['description'])
                    : 'Belum ada deskripsi workspace.'; ?>

            </p>

            <div class="grid grid-cols-2 gap-4 mt-6">

                <div class="bg-slate-900 rounded-xl p-4 text-center">

                    <p class="text-slate-400 text-sm">
                        Projects
                    </p>

                    <h3 class="text-3xl font-bold mt-2">

                        <?= $project['total']; ?>

                    </h3>

                </div>

                <div class="bg-slate-900 rounded-xl p-4 text-center">

                    <p class="text-slate-400 text-sm">
                        Tasks
                    </p>

                    <h3 class="text-3xl font-bold mt-2">

                        <?= $task['total']; ?>

                    </h3>

                </div>

            </div>

            <div class="flex gap-3 mt-6">

                <a
                    href="edit.php?id=<?= $workspace['id']; ?>"
                    class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-center py-3 rounded-xl font-semibold transition">

                    Edit

                </a>

                <a
                    href="delete.php?id=<?= $workspace['id']; ?>"
                    onclick="return confirm('Hapus workspace ini?')"
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

            Belum ada Workspace

        </h2>

        <p class="text-slate-400 mt-3">

            Buat workspace pertama untuk mulai mengelola project.

        </p>

        <a
            href="create.php"
            class="inline-block mt-8 bg-primary hover:bg-indigo-700 px-6 py-3 rounded-xl font-semibold transition">

            Create Workspace

        </a>

    </div>

    <?php endif; ?>

</main>

</div>

<script>
lucide.createIcons();

document.querySelectorAll('.card').forEach((card, index) => {
    card.style.animationDelay = (0.25 + index * 0.1) + "s";
});
</script>

<?php include '../includes/footer.php'; ?>
# Opened Files
## File Name
workspace\create.php
## File Content
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

<div class="bg-card border border-bordercolor rounded-2xl p-8 form-card">

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
# Opened Files
## File Name
workspace\edit.php
## File Content
<?php

require '../includes/auth_check.php';
require '../config/database.php';

$id = (int)$_GET['id'];
$user_id = $_SESSION['user_id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM workspaces
     WHERE id='$id'
     AND user_id='$user_id'"
);

$workspace = mysqli_fetch_assoc($query);

if (!$workspace) {
    die("Workspace tidak ditemukan.");
}

if (isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    mysqli_query(
        $conn,
        "UPDATE workspaces
         SET
            name='$name',
            description='$description'
         WHERE id='$id'
         AND user_id='$user_id'"
    );

    header("Location: index.php");
    exit;
}

include '../includes/header.php';
include '../includes/sidebar.php';

?>

<style>
main{
    animation:fadePage .6s ease;
}

.form-card{
    opacity:0;
    transform:translateY(30px);
    animation:fadeUp .8s ease forwards;
    animation-delay:.15s;
}

@keyframes fadePage{
    from{opacity:0;}
    to{opacity:1;}
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
</style>

<div class="flex-1 flex flex-col">

<?php include '../includes/navbar.php'; ?>

<main class="flex-1 p-8 bg-background">

<div class="max-w-3xl mx-auto">

<div class="bg-card border border-bordercolor rounded-2xl p-8 form-card">

<h1 class="text-3xl font-bold mb-2">
Edit Workspace
</h1>

<p class="text-slate-400 mb-8">
Perbarui informasi workspace Anda.
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
value="<?= htmlspecialchars($workspace['name']); ?>"
class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none focus:border-primary">

</div>

<div>

<label class="block mb-2 font-medium">
Description
</label>

<textarea
name="description"
rows="5"
class="w-full rounded-xl bg-slate-900 border border-bordercolor px-4 py-3 outline-none focus:border-primary resize-none"><?= htmlspecialchars($workspace['description']); ?></textarea>

</div>

<div class="flex gap-4">

<button
name="submit"
class="bg-primary hover:bg-indigo-700 px-6 py-3 rounded-xl font-semibold transition">

Update Workspace

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
# Opened Files
## File Name
project\index.php
## File Content
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
# Opened Files
## File Name
config\database.php
## File Content
<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "taskflow_native";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi database gagal!");
}
# Opened Files
## File Name
auth\login.php
## File Content
<?php

session_start();

require '../config/database.php';


$error = "";


if (isset($_POST['login'])) {


    $email = $_POST['email'];
    $password = $_POST['password'];


    $query = mysqli_query($conn,

        "SELECT * FROM users WHERE email='$email'"

    );


    $user = mysqli_fetch_assoc($query);



    if ($user) {


        if (password_verify($password, $user['password'])) {


            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];


            header("Location: ../dashboard/index.php");
            exit;


        } else {


            $error = "Password salah!";


        }


    } else {


        $error = "Email tidak ditemukan!";


    }

}


?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
Login - TaskFlow
</title>


<script src="https://cdn.tailwindcss.com"></script>


</head>



<body class="bg-slate-950 text-white min-h-screen flex items-center justify-center">



<div class="w-full max-w-md px-6">



<div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-xl">



<div class="text-center mb-8">


<h1 class="text-3xl font-bold">

<span class="text-indigo-500">
Task
</span>Flow

</h1>


<p class="text-slate-400 mt-2">

Login to manage your tasks

</p>


</div>





<?php if($error): ?>


<div class="bg-red-500/10 border border-red-500/30 text-red-400 p-4 rounded-xl mb-5">


<?= $error ?>


</div>


<?php endif; ?>






<form method="POST">



<div class="mb-5">


<label class="text-sm text-slate-400">

Email

</label>


<input

type="email"

name="email"

required

class="w-full mt-2 px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-indigo-500"

placeholder="email@example.com"


>


</div>






<div class="mb-6">


<label class="text-sm text-slate-400">

Password

</label>


<input

type="password"

name="password"

required

class="w-full mt-2 px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-indigo-500"

placeholder="••••••••"


>


</div>






<button

name="login"

class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 font-semibold transition"


>

Login

</button>



</form>





<div class="text-center mt-6 text-slate-400">


Belum punya akun?


<a

href="register.php"

class="text-indigo-400 hover:text-indigo-300 font-semibold"

>

Register

</a>


</div>




<div class="text-center mt-4">


<a

href="../index.php"

class="text-sm text-slate-500 hover:text-white"

>

← Kembali ke Landing Page

</a>


</div>



</div>


</div>



</body>

</html>
