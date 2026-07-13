<aside class="w-72 bg-sidebar border-r border-bordercolor flex flex-col">

    <!-- Logo -->
    <div class="h-20 px-6 flex items-center border-b border-bordercolor">

        <div class="w-11 h-11 rounded-xl bg-primary flex items-center justify-center shadow-lg">

            <span class="text-xl font-bold text-white">
                T
            </span>

        </div>

        <div class="ml-3">

            <h1 class="text-xl font-bold tracking-wide">
                TaskFlow
            </h1>

            <p class="text-xs text-slate-400">
                Project Management
            </p>

        </div>

    </div>

    <!-- Menu -->

    <nav class="flex-1 p-5 space-y-2">

        <a href="../dashboard/index.php"
            class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 hover:bg-primary hover:text-white transition duration-300">

            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>

            Dashboard

        </a>

        <a href="../workspace/index.php"
            class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 hover:bg-primary hover:text-white transition duration-300">

            <i data-lucide="folders" class="w-5 h-5"></i>

            Workspace

        </a>

        <a href="../project/index.php"
            class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 hover:bg-primary hover:text-white transition duration-300">

            <i data-lucide="folder-kanban" class="w-5 h-5"></i>

            Projects

        </a>

        <a href="../task/index.php"
            class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 hover:bg-primary hover:text-white transition duration-300">

            <i data-lucide="check-square" class="w-5 h-5"></i>

            Tasks

        </a>

    </nav>

    <!-- User -->

    <div class="border-t border-bordercolor p-5">

        <div class="rounded-2xl bg-card p-4">

            <div class="flex items-center gap-3">

                <div class="w-11 h-11 rounded-full bg-primary flex items-center justify-center font-bold">

                    <?= strtoupper(substr($_SESSION['name'],0,1)); ?>

                </div>

                <div>

                    <h3 class="font-semibold">

                        <?= $_SESSION['name']; ?>

                    </h3>

                    <p class="text-xs text-slate-400">

                        <?= $_SESSION['email']; ?>

                    </p>

                </div>

            </div>

            <a href="../auth/logout.php"
                class="mt-4 flex justify-center items-center gap-2 bg-red-500 hover:bg-red-600 rounded-xl py-3 transition">

                <i data-lucide="log-out" class="w-5 h-5"></i>

                Logout

            </a>

        </div>

    </div>

</aside>

<script>
    lucide.createIcons();
</script>