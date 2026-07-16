<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
TaskFlow
</title>


<!-- Font -->

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">


<!-- Tailwind -->

    <link rel="stylesheet" href="../assets/css/tailwind.css">


<script>

window.tailwind=window.tailwind||{};tailwind.config = {

theme: {

extend: {


colors:{


background:'#020617',

sidebar:'#0f172a',

card:'#1e293b',

bordercolor:'#334155',

primary:'#4f46e5',

success:'#10b981',

warning:'#f59e0b',

danger:'#ef4444'


}


}

}

}

</script>



<!-- Lucide -->

<script src="../assets/js/lucide.min.js"></script>



<link rel="stylesheet" href="../assets/css/style.css">



<style>


html{

scroll-behavior:smooth;

}




body{

    animation:pageFade .3s ease;
    -webkit-overflow-scrolling:touch;
    scroll-behavior:smooth;
    overflow-y:auto;

}



@keyframes pageFade{


from{

opacity:0;

}


to{

opacity:1;

}

}




.dashboard-card{
    will-change:transform;
}


/* SIDEBAR */


@media (min-width:1024px){

.sidebar-animation{

animation:sidebarShow .4s ease;

}

}



@keyframes sidebarShow{


from{

opacity:0;

transform:translateX(-40px);

}



to{

opacity:1;

transform:translateX(0);

}


}





/* NAVBAR */


.nav-animation{

animation:navbarShow .4s ease;

}



@keyframes navbarShow{


from{

opacity:0;

transform:translateY(-25px);

}



to{

opacity:1;

transform:translateY(0);

}


}






/* MENU */


.menu-animation{

opacity:0;

    animation:menuShow .35s ease forwards;

}


.menu-1{

    animation-delay:.05s;

}


.menu-2{

    animation-delay:.1s;

}


.menu-3{

    animation-delay:.15s;

}


.menu-4{

    animation-delay:.2s;

}




@keyframes menuShow{


from{

opacity:0;

transform:translateX(-20px);

}



to{

opacity:1;

transform:translateX(0);

}


}







.sidebar-link{

transition:.3s ease;

}



.sidebar-link:hover{

transform:translateX(8px);

}



.sidebar-link i{

transition:.3s ease;

}



.sidebar-link:hover i{

transform:scale(1.2) rotate(5deg);

}







.profile-hover{

transition:.3s ease;

}


.profile-hover:hover{

transform:translateY(-5px);

}




.user-card{

transition:.3s ease;

}



.user-card:hover{


transform:translateY(-5px);

box-shadow:0 20px 40px rgba(0,0,0,.25);


}




.logo-hover{

transition:.3s ease;

}


.logo-hover:hover{

letter-spacing:2px;

transform:scale(1.05);

}




</style>



</head>


<body class="bg-background text-white font-[Inter] overflow-x-hidden">


<div class="flex min-h-screen">