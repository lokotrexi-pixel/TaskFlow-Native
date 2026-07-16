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


    <link rel="stylesheet" href="assets/css/tailwind.css">



<style>


html{

    scroll-behavior:smooth;

}



.fade-up{

    animation:fadeUp .45s ease forwards;

}



@keyframes fadeUp{

    from{

        opacity:0;

        transform:translateY(40px);

    }


    to{

        opacity:1;

        transform:translateY(0);

    }

}





.float{

    animation:floating 4s ease-in-out infinite;

}



@keyframes floating{


    0%{

        transform:translateY(0);

    }


    50%{

        transform:translateY(-15px);

    }


    100%{

        transform:translateY(0);

    }


}






.glow{

    animation:glow 5s infinite alternate;

}



@keyframes glow{


    from{

        opacity:.3;



    }


    to{

        opacity:.7;



    }


}





.feature-card{

    transition:.3s ease;

}



.feature-card:hover{

    transform:translateY(-8px);

}





.reveal{

    opacity:0;

    transform:translateY(40px);

    transition:all .8s ease;

}




.reveal.active{

    opacity:1;

    transform:translateY(0);

}



</style>


</head>




<body class="bg-slate-950 text-white relative min-h-screen overflow-x-hidden">





<div class="absolute top-20 left-1/2 -translate-x-1/2 w-[80vw] max-w-96 h-[80vw] max-h-96 bg-indigo-600 blur-[120px] rounded-full glow">

</div>






<nav class="border-b border-slate-800 relative z-10">


<div class="max-w-7xl mx-auto px-4 sm:px-6 py-5 flex justify-between items-center">



<h1 class="text-2xl font-bold">

<span class="text-indigo-500">

Task

</span>Flow

</h1>




<div class="flex gap-3">


<a

href="auth/login.php"

class="px-4 sm:px-5 py-2 text-sm sm:text-base rounded-xl border border-slate-700 hover:bg-slate-800 transition">

Login

</a>




<a

href="auth/register.php"

class="px-4 sm:px-5 py-2 text-sm sm:text-base rounded-xl bg-indigo-600 hover:bg-indigo-700 transition">

Register

</a>


</div>


</div>


</nav>








<section class="max-w-7xl mx-auto px-6 py-24 relative z-10">



<div class="grid md:grid-cols-2 gap-12 items-center">






<div class="fade-up">



<p class="text-indigo-400 font-semibold mb-4">

TASK MANAGEMENT PLATFORM

</p>





<h1 class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight">


Manage Your Work.

<br>


<span class="text-indigo-500">

Track Your Progress.

</span>


</h1>






<p class="text-slate-400 text-lg mt-6 leading-8">

TaskFlow membantu kamu mengelola Workspace,
Project, dan Task dengan lebih mudah,
cepat, dan terstruktur.

</p>






<div class="flex gap-4 mt-8">



<a

href="auth/register.php"

class="px-7 py-3 bg-indigo-600 rounded-xl hover:bg-indigo-700 font-semibold transition">

Get Started

</a>





<a

href="auth/login.php"

class="px-7 py-3 border border-slate-700 rounded-xl hover:bg-slate-800 transition">

Login

</a>



</div>



</div>









<div class="float">



<div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-2xl">





<div class="flex justify-between items-center mb-6">


<h2 class="text-xl font-bold">

Dashboard Preview

</h2>



<span class="text-xs bg-indigo-500/20 text-indigo-400 px-3 py-1 rounded-full">

Live

</span>


</div>








<div class="grid grid-cols-3 gap-4 mb-6">



<div class="bg-slate-800 rounded-xl p-4">

<p class="text-slate-400 text-sm">

Workspace

</p>


<h3 class="text-2xl font-bold">

3

</h3>


</div>





<div class="bg-slate-800 rounded-xl p-4">

<p class="text-slate-400 text-sm">

Project

</p>


<h3 class="text-2xl font-bold">

8

</h3>


</div>





<div class="bg-slate-800 rounded-xl p-4">

<p class="text-slate-400 text-sm">

Task

</p>


<h3 class="text-2xl font-bold">

24

</h3>


</div>



</div>







<div class="space-y-4">



<div class="bg-slate-800 rounded-xl p-5">

<div class="flex gap-3 items-center">


<i data-lucide="folder"
class="text-indigo-400">
</i>


<span class="font-semibold">

Workspace

</span>


</div>

</div>






<div class="bg-slate-800 rounded-xl p-5">


<div class="flex gap-3 items-center">


<i data-lucide="briefcase"
class="text-blue-400">
</i>


<span class="font-semibold">

Project Management

</span>


</div>


</div>








<div class="bg-slate-800 rounded-xl p-5">


<div class="flex gap-3 items-center">


<i data-lucide="check-square"
class="text-emerald-400">
</i>


<span class="font-semibold">

Task Tracking

</span>


</div>


</div>





</div>




</div>



</div>






</div>


</section>









<section class="max-w-7xl mx-auto px-6 pb-20 reveal">



<div class="grid md:grid-cols-3 gap-6">





<div class="feature-card bg-slate-900 border border-slate-800 rounded-2xl p-6 reveal">


<i data-lucide="zap"
class="w-8 h-8 text-indigo-400 mb-4">
</i>


<h2 class="text-xl font-bold">

Simple

</h2>


<p class="text-slate-400 mt-3">

Interface sederhana dan mudah digunakan.

</p>


</div>







<div class="feature-card bg-slate-900 border border-slate-800 rounded-2xl p-6 reveal">


<i data-lucide="layers"
class="w-8 h-8 text-blue-400 mb-4">
</i>


<h2 class="text-xl font-bold">

Organized

</h2>


<p class="text-slate-400 mt-3">

Workspace, project, dan task tersusun rapi.

</p>


</div>








<div class="feature-card bg-slate-900 border border-slate-800 rounded-2xl p-6 reveal">


<i data-lucide="monitor-smartphone"
class="w-8 h-8 text-emerald-400 mb-4">
</i>


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








<script src="assets/js/lucide.min.js"></script>



<script>


lucide.createIcons();




const reveals = document.querySelectorAll('.reveal');



function revealOnScroll(){


    reveals.forEach(element=>{


        const windowHeight = window.innerHeight;


        const elementTop = element.getBoundingClientRect().top;


        if(elementTop < windowHeight - 120){


            element.classList.add('active');


        }


    });



}



let _ticking=false;
const _onScroll=function(){
    if(_ticking) return;
    _ticking=true;
    requestAnimationFrame(()=>{
        revealOnScroll();
        _ticking=false;
        if(document.querySelectorAll('.reveal:not(.active)').length===0){
            window.removeEventListener('scroll', _onScroll);
        }
    });
};
window.addEventListener('scroll', _onScroll, {passive:true});



revealOnScroll();



</script>





</body>

</html>