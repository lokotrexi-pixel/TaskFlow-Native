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