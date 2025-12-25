<aside id="application-sidebar"
    class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden fixed top-0 left-0 bottom-0 z-[60] w-64 bg-white border-r border-gray-200 lg:block lg:translate-x-0 lg:right-auto lg:bottom-0">
    
    <div class="flex flex-col h-full max-h-full">
        <div class="px-6 pt-7 pb-4">
            <a class="flex flex-col gap-y-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20" href="{{ route('author.dashboard', ['userId' => $userId ?? 1]) }}" aria-label="Solicode Blog Author Dashboard">
                <img src="{{ asset('images/logosolicode.png') }}" alt="Solicode Logo" class="w-36 h-auto">
                <span class="text-[11px] font-bold text-blue-500 uppercase tracking-widest pl-1">Blog Author Dashboard</span>
            </a>
        </div>

        <nav class="hs-accordion-group p-4 w-full flex flex-col flex-wrap overflow-y-auto scrollbar-y" data-hs-accordion-always-open>
            <ul class="space-y-1">
                <li class="px-3 mb-2">
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Menu Principal</span>
                </li>

                <li>
                    <a class="group flex items-center gap-x-3.5 py-2.5 px-3 bg-blue-50 text-sm font-semibold text-blue-600 rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                        href="{{ route('author.dashboard', ['userId' => $userId ?? 1]) }}">
                        <i data-lucide="layout-dashboard" class="w-4.5 h-4.5 transition-transform duration-300 group-hover:scale-110"></i>
                        Dashboard
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</aside>
