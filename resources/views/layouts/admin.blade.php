<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#111a2e">
        <title>@yield('title', 'Dashboard') · {{ config('app.name', 'Northstar') }}</title>
        <script>
            const savedTheme = localStorage.getItem('northstar-theme');

            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
                document.documentElement.style.colorScheme = 'dark';
            }
        </script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            <button
                type="button"
                class="fixed inset-0 z-30 hidden bg-slate-950/45 backdrop-blur-[2px] lg:hidden"
                data-sidebar-overlay
                aria-label="Close navigation"
            ></button>

            <aside
                class="fixed inset-y-0 left-0 z-40 flex w-[264px] -translate-x-full flex-col overflow-y-auto bg-[#111a2e] text-slate-300 transition-transform duration-300 ease-out lg:translate-x-0"
                data-sidebar
                aria-label="Main navigation"
            >
                <a href="{{ route('dashboard') }}" class="flex h-[76px] items-center gap-3 border-b border-white/[0.07] px-6">
                    <span class="flex size-10 items-center justify-center rounded-[14px] bg-gradient-to-br from-blue-400 to-indigo-500 text-white shadow-lg shadow-blue-500/25">
                        <svg viewBox="0 0 24 24" fill="none" class="size-[22px]" aria-hidden="true">
                            <path d="M4 13.2 9.5 4l3.2 5.3L20 6l-5.5 14-3.1-5.1L4 13.2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span class="leading-tight">
                        <span class="block text-[15px] font-semibold tracking-wide text-white">Northstar</span>
                        <span class="mt-1 block text-[10px] font-medium uppercase tracking-[0.2em] text-slate-500">Admin workspace</span>
                    </span>
                    <span class="ml-auto rounded-md border border-white/10 px-1.5 py-1 text-[9px] font-semibold tracking-wide text-slate-400">PRO</span>
                </a>

                <div class="px-4 pb-5 pt-7">
                    <p class="mb-3 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-slate-500">Workspace</p>
                    <nav class="space-y-1">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-xl bg-blue-500/15 px-3 py-2.5 text-[13px] font-semibold text-blue-300 ring-1 ring-inset ring-blue-400/10">
                            <svg viewBox="0 0 24 24" fill="none" class="size-[18px]" aria-hidden="true"><rect x="3.5" y="3.5" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.7"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.7"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.7"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.7"/></svg>
                            <span>Overview</span>
                            <span class="ml-auto size-1.5 rounded-full bg-blue-300"></span>
                        </a>
                        <a href="{{ route('dashboard') }}#orders" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-[13px] font-medium text-slate-400 transition hover:bg-white/[0.06] hover:text-white">
                            <svg viewBox="0 0 24 24" fill="none" class="size-[18px]" aria-hidden="true"><path d="M5 7.5h14l1 12H4l1-12Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 8V6a3 3 0 0 1 6 0v2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                            <span>Orders</span>
                            <span class="ml-auto rounded-md bg-white/[0.08] px-1.5 py-0.5 text-[10px] text-slate-400">12</span>
                        </a>
                        <a href="{{ route('dashboard') }}#customers" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-[13px] font-medium text-slate-400 transition hover:bg-white/[0.06] hover:text-white">
                            <svg viewBox="0 0 24 24" fill="none" class="size-[18px]" aria-hidden="true"><path d="M16 20v-1.5a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4V20m7.5-9a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm6-7.6a4 4 0 0 1 0 7.7m4.5 8.9v-1.5a4 4 0 0 0-3-3.9" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                            <span>Customers</span>
                        </a>
                        <a href="{{ route('dashboard') }}#products" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-[13px] font-medium text-slate-400 transition hover:bg-white/[0.06] hover:text-white">
                            <svg viewBox="0 0 24 24" fill="none" class="size-[18px]" aria-hidden="true"><path d="m12 3 8 4.5v9L12 21l-8-4.5v-9L12 3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="m4.5 7.8 7.5 4.4 7.5-4.4M12 12.5V21m-4-15.7 8 4.6" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
                            <span>Products</span>
                        </a>
                        <a href="{{ route('dashboard') }}#analytics" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-[13px] font-medium text-slate-400 transition hover:bg-white/[0.06] hover:text-white">
                            <svg viewBox="0 0 24 24" fill="none" class="size-[18px]" aria-hidden="true"><path d="M4 19V5m0 14h16" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="m7 15 4-4 3 2 5-6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 7h3v3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span>Analytics</span>
                            <span class="ml-auto rounded-md bg-indigo-400/10 px-1.5 py-0.5 text-[9px] font-semibold text-indigo-300">NEW</span>
                        </a>
                    </nav>
                </div>

                <div class="px-4 pt-1">
                    <p class="mb-3 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-slate-500">Manage</p>
                    <nav class="space-y-1">
                        <a href="{{ route('dashboard') }}#team" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-[13px] font-medium text-slate-400 transition hover:bg-white/[0.06] hover:text-white">
                            <svg viewBox="0 0 24 24" fill="none" class="size-[18px]" aria-hidden="true"><rect x="3.5" y="4.5" width="17" height="15" rx="2.5" stroke="currentColor" stroke-width="1.7"/><path d="M8 9h8M8 13h5m-5 3h3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                            <span>Team & access</span>
                        </a>
                        <a href="{{ route('dashboard') }}#settings" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-[13px] font-medium text-slate-400 transition hover:bg-white/[0.06] hover:text-white">
                            <svg viewBox="0 0 24 24" fill="none" class="size-[18px]" aria-hidden="true"><path d="M12 15.2a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4Z" stroke="currentColor" stroke-width="1.7"/><path d="m19.4 15 .1.1a1.8 1.8 0 1 1-2.5 2.5l-.1-.1a1.8 1.8 0 0 0-3.1 1.3v.2a1.8 1.8 0 1 1-3.6 0v-.2a1.8 1.8 0 0 0-3.1-1.3l-.1.1a1.8 1.8 0 1 1-2.5-2.5l.1-.1a1.8 1.8 0 0 0-1.3-3.1h-.2a1.8 1.8 0 1 1 0-3.6h.2a1.8 1.8 0 0 0 1.3-3.1l-.1-.1a1.8 1.8 0 1 1 2.5-2.5l.1.1a1.8 1.8 0 0 0 3.1-1.3v-.2a1.8 1.8 0 1 1 3.6 0v.2a1.8 1.8 0 0 0 3.1 1.3l.1-.1a1.8 1.8 0 1 1 2.5 2.5l-.1.1a1.8 1.8 0 0 0 1.3 3.1h.2a1.8 1.8 0 1 1 0 3.6h-.2a1.8 1.8 0 0 0-1.3 3.1Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span>Settings</span>
                        </a>
                    </nav>
                </div>

                <div class="mt-auto p-4">
                    <div class="rounded-2xl border border-white/[0.08] bg-gradient-to-br from-white/[0.07] to-white/[0.025] p-4">
                        <div class="mb-3 flex size-9 items-center justify-center rounded-xl bg-blue-400/15 text-blue-300">
                            <svg viewBox="0 0 24 24" fill="none" class="size-[18px]" aria-hidden="true"><path d="M12 3.5 14.3 9l5.7 2-5.7 2.3L12 19l-2.3-5.7L4 11l5.7-2L12 3.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="m19 16 .8 1.9 1.7.6-1.7.7L19 21l-.7-1.8-1.8-.7 1.8-.6L19 16Z" fill="currentColor"/></svg>
                        </div>
                        <p class="text-xs font-semibold text-white">Need a hand?</p>
                        <p class="mt-1 text-[11px] leading-5 text-slate-400">Our support team is just a message away.</p>
                        <a href="mailto:support@example.com" class="mt-3 inline-flex items-center gap-1 text-[11px] font-semibold text-blue-300 hover:text-blue-200">
                            Visit help center
                            <svg viewBox="0 0 16 16" fill="none" class="size-3" aria-hidden="true"><path d="M3.3 8h9.4m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>
                    <div class="mt-4 flex items-center gap-3 border-t border-white/[0.07] px-1 pt-4">
                        <span class="flex size-9 items-center justify-center rounded-full bg-gradient-to-br from-amber-200 to-orange-300 text-[11px] font-bold text-orange-900">FA</span>
                        <span class="min-w-0 flex-1">
                            <span class="block truncate text-xs font-semibold text-white">Farhad Ahmed</span>
                            <span class="mt-0.5 block truncate text-[10px] text-slate-500">Workspace owner</span>
                        </span>
                        <button type="button" class="rounded-lg p-1.5 text-slate-500 transition hover:bg-white/[0.08] hover:text-white" aria-label="Account options">
                            <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true"><circle cx="5" cy="12" r="1" fill="currentColor"/><circle cx="12" cy="12" r="1" fill="currentColor"/><circle cx="19" cy="12" r="1" fill="currentColor"/></svg>
                        </button>
                    </div>
                </div>
            </aside>

            <div class="min-h-screen lg:pl-[264px]">
                <header class="sticky top-0 z-20 border-b border-slate-200/80 bg-white/90 backdrop-blur-xl">
                    <div class="flex h-[72px] items-center gap-3 px-4 sm:px-7 lg:px-9">
                        <button
                            type="button"
                            class="inline-flex size-10 shrink-0 items-center justify-center rounded-xl border border-slate-200 text-slate-600 transition hover:bg-slate-50 lg:hidden"
                            data-sidebar-toggle
                            aria-label="Open navigation"
                            aria-expanded="false"
                        >
                            <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                        </button>
                        <div class="hidden min-w-0 items-center gap-2 text-xs text-slate-400 sm:flex">
                            <span>Workspace</span>
                            <svg viewBox="0 0 16 16" fill="none" class="size-3 text-slate-300" aria-hidden="true"><path d="m6 3.5 4.5 4.5L6 12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span class="font-semibold text-slate-700">@yield('breadcrumb', 'Overview')</span>
                        </div>
                        <label class="relative ml-auto hidden w-full max-w-[290px] md:block">
                            <span class="sr-only">Search orders</span>
                            <svg viewBox="0 0 24 24" fill="none" class="pointer-events-none absolute left-3 top-1/2 size-[17px] -translate-y-1/2 text-slate-400" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8" stroke="currentColor" stroke-width="1.7"/><path d="m16 16 4.2 4.2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                            <input type="search" data-order-search placeholder="Search anything..." class="h-10 w-full rounded-xl border border-slate-200 bg-slate-50/70 pl-9 pr-14 text-xs text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-300 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                            <kbd class="absolute right-2.5 top-1/2 -translate-y-1/2 rounded-md border border-slate-200 bg-white px-1.5 py-0.5 text-[9px] font-medium text-slate-400">⌘ K</kbd>
                        </label>
                        <div class="relative ml-auto flex shrink-0 items-center gap-2 md:ml-0 sm:gap-3">
                            <button
                                type="button"
                                class="inline-flex size-10 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-100 hover:text-slate-800"
                                data-theme-toggle
                                aria-label="Switch to dark mode"
                                aria-pressed="false"
                                title="Switch to dark mode"
                            >
                                <svg viewBox="0 0 24 24" fill="none" class="size-[19px] dark:hidden" aria-hidden="true">
                                    <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.7"/>
                                    <path d="M12 2.5v2m0 15v2m9.5-9.5h-2m-15 0h-2m16.2-6.7-1.4 1.4M6.7 17.3l-1.4 1.4m13.4 0-1.4-1.4M6.7 6.7 5.3 5.3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                </svg>
                                <svg viewBox="0 0 24 24" fill="none" class="hidden size-[19px] dark:block" aria-hidden="true">
                                    <path d="M20.2 15.1A8.3 8.3 0 0 1 8.9 3.8 8.5 8.5 0 1 0 20.2 15Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button type="button" class="relative inline-flex size-10 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-100 hover:text-slate-800" data-notification-toggle aria-expanded="false" aria-label="Notifications">
                                <svg viewBox="0 0 24 24" fill="none" class="size-[19px]" aria-hidden="true"><path d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9m-8 12a2 2 0 0 0 4 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span class="absolute right-[9px] top-[8px] size-2 rounded-full border-2 border-white bg-rose-500"></span>
                            </button>
                            <div class="absolute right-0 top-[48px] z-50 hidden w-72 rounded-2xl border border-slate-200 bg-white p-4 shadow-xl shadow-slate-900/10" data-notification-panel>
                                <p class="text-sm font-semibold text-slate-800">You’re all caught up</p>
                                <p class="mt-1 text-xs leading-5 text-slate-500">New order and account updates will show up here.</p>
                            </div>
                            <span class="hidden h-8 w-px bg-slate-200 sm:block"></span>
                            <button type="button" class="flex items-center gap-2 rounded-xl py-1 pl-1 pr-1.5 transition hover:bg-slate-50" aria-label="Your profile">
                                <span class="flex size-8 items-center justify-center rounded-full bg-gradient-to-br from-amber-200 to-orange-300 text-[10px] font-bold text-orange-900">FA</span>
                                <span class="hidden text-left sm:block">
                                    <span class="block text-[11px] font-semibold leading-4 text-slate-700">Farhad Ahmed</span>
                                    <span class="block text-[10px] leading-4 text-slate-400">Administrator</span>
                                </span>
                                <svg viewBox="0 0 16 16" fill="none" class="hidden size-3 text-slate-400 sm:block" aria-hidden="true"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                        </div>
                    </div>
                </header>

                <main class="mx-auto max-w-[1600px] px-4 py-6 sm:px-7 sm:py-8 lg:px-9">
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
