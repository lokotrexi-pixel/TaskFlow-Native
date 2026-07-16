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


<header class="min-h-20 bg-sidebar border-b border-bordercolor flex items-center justify-between gap-3 px-4 md:px-8 nav-animation">


    <!-- Left -->

    <div class="flex items-center gap-3 min-w-0 flex-1">


        <button id="sidebarToggle" class="lg:hidden p-2 -ml-2 mr-1 rounded-lg hover:bg-card transition shrink-0" aria-label="Buka menu">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>

        <div>

            <h1 class="text-xl sm:text-2xl md:text-3xl font-bold tracking-tight">

            Dashboard

        </h1>



        <p class="text-slate-400 text-sm mt-1 break-words">

            Welcome back,

            <span class="text-white font-semibold">

                <?= htmlspecialchars($_SESSION['name']); ?>

            </span>

        </p>


        </div>

    </div>





    <!-- Right -->

    <div class="flex items-center gap-5 shrink-0">





        <!-- Date -->


        <div class="hidden lg:flex items-center gap-3 bg-card rounded-xl px-5 py-3">


            <div class="w-10 h-10 rounded-xl bg-primary/20 flex items-center justify-center">


                <i 
                data-lucide="calendar-days"
                class="w-5 h-5 text-indigo-400">
                </i>


            </div>



        <div class="min-w-0">


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