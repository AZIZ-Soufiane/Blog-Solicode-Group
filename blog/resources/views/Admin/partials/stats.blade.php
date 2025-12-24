<div class="mb-8">
    <h1 class="text-2xl font-bold text-black dark:text-black">Dashboard Admin</h1>
    <p class="text-sm text-black dark:text-black">Vue d'ensemble et statistiques de la plateforme.</p>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <!-- Card: Articles -->
    <div class="group relative bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300">
        <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-blue-500/10 to-transparent opacity-0 group-hover:opacity-100 transition"></div>

        <div class="relative flex items-center justify-between">
            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Articles Publiés
                </p>
                <h3 id="published-articles" class="mt-2 text-3xl font-bold text-gray-900">
                    0
                </h3>
            </div>

            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-blue-600/10 text-blue-600">
                <i data-lucide="newspaper" class="w-6 h-6"></i>
            </div>
        </div>

        <div class="relative mt-4 flex items-center gap-2">
            <span class="text-xs text-gray-400">Total sur la plateforme</span>
        </div>
    </div>

    <!-- Card: Views -->
    <div class="group relative bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300">
        <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-indigo-500/10 to-transparent opacity-0 group-hover:opacity-100 transition"></div>

        <div class="relative flex items-center justify-between">
            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Vues Totales
                </p>
                <h3 id="total-views" class="mt-2 text-3xl font-bold text-gray-900">
                    0
                </h3>
            </div>

            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-indigo-600/10 text-indigo-600">
                <i data-lucide="eye" class="w-6 h-6"></i>
            </div>
        </div>

        <div class="relative mt-4 flex items-center gap-2">
            <span id="percentage_growth" class="text-sm font-semibold text-green-600">
                0%
            </span>
            <span class="text-xs text-gray-400">ce mois-ci</span>
        </div>
    </div>

    <!-- Card: Users -->
    <div class="group relative bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300">
        <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-sky-500/10 to-transparent opacity-0 group-hover:opacity-100 transition"></div>

        <div class="relative flex items-center justify-between">
            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Utilisateurs
                </p>
                <h3 id="total-users" class="mt-2 text-3xl font-bold text-gray-900">
                    0
                </h3>
            </div>

            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-sky-600/10 text-sky-600">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
        </div>

        <div class="relative mt-4 flex items-center gap-2">
            <span class="text-xs text-gray-400">Administrateurs et Auteurs</span>
        </div>
    </div>

    <!-- Card: Comments -->
    <div class="group relative bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300">
        <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-emerald-500/10 to-transparent opacity-0 group-hover:opacity-100 transition"></div>

        <div class="relative flex items-center justify-between">
            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Commentaires
                </p>
                <h3 id="total-comments" class="mt-2 text-3xl font-bold text-gray-900">
                    0
                </h3>
                <p id="new-comments" class="mt-1 text-sm text-emerald-600">
                    0 nouveaux
                </p>
            </div>

            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-emerald-600/10 text-emerald-600">
                <i data-lucide="message-square" class="w-6 h-6"></i>
            </div>
        </div>
    </div>

</div>
