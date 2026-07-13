<header class="h-20 bg-sidebar border-b border-bordercolor flex items-center justify-between px-8">

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

        <!-- Search -->

        <div class="hidden lg:flex items-center bg-card rounded-xl px-4 py-3 w-80">

            <i data-lucide="search" class="w-5 h-5 text-slate-400"></i>

            <input
                type="text"
                placeholder="Search..."
                class="ml-3 w-full bg-transparent outline-none text-sm placeholder:text-slate-500">

        </div>

        <!-- Notification -->

        <button
            class="w-12 h-12 rounded-xl bg-card hover:bg-primary transition flex items-center justify-center">

            <i data-lucide="bell" class="w-5 h-5"></i>

        </button>

        <!-- User -->

        <div class="flex items-center gap-3">

            <div
                class="w-11 h-11 rounded-full bg-primary flex items-center justify-center font-bold">

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