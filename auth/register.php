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


    <link rel="stylesheet" href="../assets/css/tailwind.css">

<style>

body{
    animation:fadePage .35s ease;
}

.auth-card{
    opacity:0;
    transform:translateY(40px) scale(.97);
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