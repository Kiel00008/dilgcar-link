<x-admin-layout mode="public">
    <div class="mx-auto w-full max-w-7xl">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div style="width: 48px; height: 48px; background: rgba(71, 98, 255, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6" style="color: #4762ff;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-slate-900">Archived Chats</h2>
                    <p class="text-slate-600 text-sm mt-1">Restore or permanently remove saved conversations.</p>
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="mb-6 flex items-center gap-4">
            <div class="relative flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 104.473 8.708l2.41 2.409a.75.75 0 101.06-1.06l-2.409-2.41A5.5 5.5 0 009 3.5zM4.5 9a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0z" clip-rule="evenodd" />
                </svg>
                <input type="search" placeholder="Search archived chats..." class="w-full pl-10 pr-4 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <select class="px-4 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-700 font-medium focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option>All Archives</option>
            </select>
            
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-slate-700">Sort by</span>
                <select class="px-4 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-700 font-medium focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Newest</option>
                    <option>Oldest</option>
                </select>
            </div>
            
            <div style="background: rgba(71, 98, 255, 0.1); padding: 8px 16px; border-radius: 12px; display: flex; align-items: center; gap: 8px; font-weight: 600; color: #4762ff;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                </svg>
                <span>{{ $conversations->count() }} Archived Chats</span>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200">
            @if ($conversations->isEmpty())
                <div class="px-10 py-16 text-center">
                    <div class="text-sm font-semibold text-slate-600">No archived chats yet</div>
                </div>
            @else
                <div class="divide-y divide-slate-200">
                    @foreach ($conversations as $conversation)
                        <div class="flex items-center gap-4 px-8 py-6 hover:bg-slate-50 transition">
                            <div class="min-w-0 flex-1">
                                <div class="truncate text-base font-bold text-slate-900">
                                    {{ $conversation->title ?: 'Untitled Thread' }}
                                </div>
                                <div class="mt-2 text-xs font-semibold uppercase tracking-wider" style="color: #0f1f4a;">
                                    {{ $conversation->created_at?->format('M d, Y') }}
                                </div>
                            </div>

                            <div class="relative">
                                <button type="button" class="archive-actions-trigger flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-slate-50 text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                                        <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 14a1.5 1.5 0 110 3 1.5 1.5 0 010-3z" />
                                    </svg>
                                </button>

                                <div class="archive-actions-menu absolute right-0 bottom-full mb-3 hidden w-44 overflow-hidden rounded-2xl bg-white ring-1 ring-slate-900/10 shadow-lg z-50">
                                    <form method="POST" action="{{ route('legal.ai.conversations.toggle-save', $conversation->id) }}" class="m-0">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4 text-slate-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75A2.25 2.25 0 0014.25 4.5h-7.5A2.25 2.25 0 004.5 6.75v10.5A2.25 2.25 0 006.75 19.5h7.5A2.25 2.25 0 0016.5 17.25V13.5m3 0L21 12m0 0l-1.5-1.5M21 12H9" />
                                            </svg>
                                            <span>Restore</span>
                                        </button>
                                    </form>
                                    <div class="h-px bg-slate-200"></div>
                                    <form method="POST" action="{{ route('legal.ai.conversations.destroy', $conversation->id) }}" class="m-0" data-confirm="delete" data-confirm-title="Delete Conversation" data-confirm-message="Delete this conversation?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-semibold text-rose-700 hover:bg-rose-50 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4 text-rose-600">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-1.806A2.25 2.25 0 0013.813 1.5h-3.626a2.25 2.25 0 00-2.25 2.25V3m7.5 0H9" />
                                            </svg>
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script type="module">
        const triggers = Array.from(document.querySelectorAll('.archive-actions-trigger'));

        const closeAll = () => {
            document.querySelectorAll('.archive-actions-menu').forEach((el) => el.classList.add('hidden'));
        };

        triggers.forEach((btn) => {
            const menu = btn.parentElement?.querySelector('.archive-actions-menu');
            if (!menu) return;

            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const isHidden = menu.classList.contains('hidden');
                closeAll();
                if (isHidden) menu.classList.remove('hidden');
            });
        });

        document.addEventListener('click', (e) => {
            const target = e.target;
            if (!(target instanceof Element)) return;
            if (target.closest('.archive-actions-trigger') || target.closest('.archive-actions-menu')) return;
            closeAll();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeAll();
        });
    </script>
</x-admin-layout>
