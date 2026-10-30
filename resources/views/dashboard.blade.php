@extends('layouts.admin')

@section('title', 'Dashboard')
@section('breadcrumb', 'Overview')

@section('content')
    @php
        $today = now();
        $chartDates = [26, 22, 17, 12, 7, 2, 0];

        $orders = [
            ['id' => '#NS-4829', 'name' => 'Olivia Rhye', 'email' => 'olivia@acme.com', 'initials' => 'OR', 'avatar' => 'bg-violet-100 text-violet-700', 'product' => 'Minimal Desk Lamp', 'date' => $today->format('M d, Y'), 'amount' => '$248.00', 'status' => 'Completed', 'statusClass' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/10'],
            ['id' => '#NS-4828', 'name' => 'Phoenix Baker', 'email' => 'phoenix@acme.com', 'initials' => 'PB', 'avatar' => 'bg-amber-100 text-amber-700', 'product' => 'Canvas Weekender', 'date' => $today->copy()->subDay()->format('M d, Y'), 'amount' => '$189.50', 'status' => 'Processing', 'statusClass' => 'bg-blue-50 text-blue-700 ring-blue-600/10'],
            ['id' => '#NS-4827', 'name' => 'Lana Steiner', 'email' => 'lana@acme.com', 'initials' => 'LS', 'avatar' => 'bg-rose-100 text-rose-700', 'product' => 'Ceramic Pour-over Set', 'date' => $today->copy()->subDay()->format('M d, Y'), 'amount' => '$96.00', 'status' => 'Completed', 'statusClass' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/10'],
            ['id' => '#NS-4826', 'name' => 'Demi Wilkinson', 'email' => 'demi@acme.com', 'initials' => 'DW', 'avatar' => 'bg-sky-100 text-sky-700', 'product' => 'Everyday Tote', 'date' => $today->copy()->subDays(2)->format('M d, Y'), 'amount' => '$64.00', 'status' => 'Pending', 'statusClass' => 'bg-amber-50 text-amber-700 ring-amber-600/10'],
            ['id' => '#NS-4825', 'name' => 'Candice Wu', 'email' => 'candice@acme.com', 'initials' => 'CW', 'avatar' => 'bg-fuchsia-100 text-fuchsia-700', 'product' => 'Linen Table Runner', 'date' => $today->copy()->subDays(3)->format('M d, Y'), 'amount' => '$132.00', 'status' => 'Completed', 'statusClass' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/10'],
        ];

        $products = [
            ['name' => 'Minimal Desk Lamp', 'category' => 'Home & living', 'sold' => 184, 'width' => 'w-[78%]', 'color' => 'bg-blue-500', 'icon' => 'bg-blue-50 text-blue-600'],
            ['name' => 'Canvas Weekender', 'category' => 'Accessories', 'sold' => 142, 'width' => 'w-[61%]', 'color' => 'bg-violet-500', 'icon' => 'bg-violet-50 text-violet-600'],
            ['name' => 'Ceramic Pour-over', 'category' => 'Kitchen', 'sold' => 96, 'width' => 'w-[42%]', 'color' => 'bg-amber-500', 'icon' => 'bg-amber-50 text-amber-600'],
        ];
    @endphp

    <section id="overview">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="mb-2 inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.12em] text-blue-700 ring-1 ring-inset ring-blue-600/10">
                    <span class="size-1.5 rounded-full bg-blue-500"></span>
                    {{ $today->format('l, F j') }}
                </div>
                <h1 class="text-[26px] font-semibold tracking-[-0.04em] text-slate-900 sm:text-[30px]">Good morning, Farhad <span aria-hidden="true">✦</span></h1>
                <p class="mt-1.5 text-[13px] text-slate-500">Here’s what’s happening with your store today.</p>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" class="inline-flex h-10 items-center gap-2 rounded-xl border border-slate-200 bg-white px-3.5 text-xs font-semibold text-slate-600 shadow-sm shadow-slate-900/[0.02] transition hover:border-slate-300 hover:bg-slate-50">
                    <svg viewBox="0 0 24 24" fill="none" class="size-4 text-slate-500" aria-hidden="true"><path d="M8 3v3m8-3v3M4.5 9h15M6 5h12a1.5 1.5 0 0 1 1.5 1.5v12A1.5 1.5 0 0 1 18 20H6a1.5 1.5 0 0 1-1.5-1.5v-12A1.5 1.5 0 0 1 6 5Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Last 30 days
                    <svg viewBox="0 0 16 16" fill="none" class="size-3 text-slate-400" aria-hidden="true"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <a href="#analytics" class="inline-flex h-10 items-center gap-2 rounded-xl bg-slate-900 px-3.5 text-xs font-semibold text-white shadow-sm shadow-slate-900/15 transition hover:bg-slate-800">
                    <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true"><path d="M12 3v12m0 0 4-4m-4 4-4-4m-4 6v2h16v-2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Export report
                </a>
            </div>
        </div>

        <div class="mt-7 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <article class="group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-900/[0.025] transition hover:-translate-y-0.5 hover:shadow-md hover:shadow-slate-900/[0.06]">
                <div class="flex items-start justify-between">
                    <span class="text-xs font-medium text-slate-500">Total revenue</span>
                    <span class="flex size-9 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <svg viewBox="0 0 24 24" fill="none" class="size-[18px]" aria-hidden="true"><path d="M12 3v18m4-14H9.8a3.3 3.3 0 1 0 0 6.6h4.4a3.3 3.3 0 1 1 0 6.6H7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                    </span>
                </div>
                <div class="mt-4 flex items-end justify-between gap-3">
                    <p class="text-[28px] font-semibold tracking-[-0.04em] text-slate-900">$48,294<span class="text-xl">.00</span></p>
                    <span class="mb-1 inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-semibold text-emerald-700">
                        <svg viewBox="0 0 16 16" fill="none" class="size-3" aria-hidden="true"><path d="m3.5 10 4-4 2.5 2.5L13 5.5m0 0H9.5M13 5.5V9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        12.8%
                    </span>
                </div>
                <p class="mt-2 text-[11px] text-slate-400">vs. $42,812.00 last month</p>
                <svg viewBox="0 0 160 30" fill="none" class="mt-4 h-7 w-full" preserveAspectRatio="none" aria-hidden="true"><path d="M1 23.5C12 21.5 15 24 24 18s12 4 22-1.5 11 2.5 21-4 13 7 22-1 14 2 23-5 14 5 24-1.5 12 1 23-4" stroke="#3b82f6" stroke-width="2" stroke-linecap="round"/><path d="M1 24c11-2 14 .5 23-5.5s12 4 22-1.5 11 2.5 21-4 13 7 22-1 14 2 23-5 14 5 24-1.5 12 1 23-4v24H1V24Z" fill="url(#revenue-spark)"/><defs><linearGradient id="revenue-spark" x1="80" y1="2" x2="80" y2="30" gradientUnits="userSpaceOnUse"><stop stop-color="#3b82f6" stop-opacity=".16"/><stop offset="1" stop-color="#3b82f6" stop-opacity="0"/></linearGradient></defs></svg>
            </article>

            <article class="group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-900/[0.025] transition hover:-translate-y-0.5 hover:shadow-md hover:shadow-slate-900/[0.06]">
                <div class="flex items-start justify-between">
                    <span class="text-xs font-medium text-slate-500">Total orders</span>
                    <span class="flex size-9 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                        <svg viewBox="0 0 24 24" fill="none" class="size-[18px]" aria-hidden="true"><path d="M5 7.5h14l1 12H4l1-12Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 8V6a3 3 0 0 1 6 0v2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                    </span>
                </div>
                <div class="mt-4 flex items-end justify-between gap-3">
                    <p class="text-[28px] font-semibold tracking-[-0.04em] text-slate-900">2,842</p>
                    <span class="mb-1 inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-semibold text-emerald-700">
                        <svg viewBox="0 0 16 16" fill="none" class="size-3" aria-hidden="true"><path d="m3.5 10 4-4 2.5 2.5L13 5.5m0 0H9.5M13 5.5V9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        8.2%
                    </span>
                </div>
                <p class="mt-2 text-[11px] text-slate-400">vs. 2,625 orders last month</p>
                <svg viewBox="0 0 160 30" fill="none" class="mt-4 h-7 w-full" preserveAspectRatio="none" aria-hidden="true"><path d="M1 22c9 2 13-7 22-4s13-8 22-3 13-7 22-2 13-5 22 0 13-9 22-3 13-4 22-9 13 7 27 1" stroke="#8b5cf6" stroke-width="2" stroke-linecap="round"/><path d="M1 22c9 2 13-7 22-4s13-8 22-3 13-7 22-2 13-5 22 0 13-9 22-3 13-4 22-9 13 7 27 1v28H1V22Z" fill="url(#orders-spark)"/><defs><linearGradient id="orders-spark" x1="80" y1="1" x2="80" y2="30" gradientUnits="userSpaceOnUse"><stop stop-color="#8b5cf6" stop-opacity=".15"/><stop offset="1" stop-color="#8b5cf6" stop-opacity="0"/></linearGradient></defs></svg>
            </article>

            <article class="group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-900/[0.025] transition hover:-translate-y-0.5 hover:shadow-md hover:shadow-slate-900/[0.06]">
                <div class="flex items-start justify-between">
                    <span class="text-xs font-medium text-slate-500">Active customers</span>
                    <span class="flex size-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <svg viewBox="0 0 24 24" fill="none" class="size-[18px]" aria-hidden="true"><path d="M16 20v-1.5a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4V20m7.5-9a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm6-7.6a4 4 0 0 1 0 7.7m4.5 8.9v-1.5a4 4 0 0 0-3-3.9" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                    </span>
                </div>
                <div class="mt-4 flex items-end justify-between gap-3">
                    <p class="text-[28px] font-semibold tracking-[-0.04em] text-slate-900">1,893</p>
                    <span class="mb-1 inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-semibold text-emerald-700">
                        <svg viewBox="0 0 16 16" fill="none" class="size-3" aria-hidden="true"><path d="m3.5 10 4-4 2.5 2.5L13 5.5m0 0H9.5M13 5.5V9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        4.6%
                    </span>
                </div>
                <p class="mt-2 text-[11px] text-slate-400">+83 new customers this month</p>
                <svg viewBox="0 0 160 30" fill="none" class="mt-4 h-7 w-full" preserveAspectRatio="none" aria-hidden="true"><path d="M1 20c10-4 13 5 23 0s13-2 22-7 13 3 22-1 13 3 22-1 13 5 22-4 13 4 22-2 13 2 27-4" stroke="#10b981" stroke-width="2" stroke-linecap="round"/><path d="M1 20c10-4 13 5 23 0s13-2 22-7 13 3 22-1 13 3 22-1 13 5 22-4 13 4 22-2 13 2 27-4v27H1V20Z" fill="url(#customers-spark)"/><defs><linearGradient id="customers-spark" x1="80" y1="1" x2="80" y2="30" gradientUnits="userSpaceOnUse"><stop stop-color="#10b981" stop-opacity=".15"/><stop offset="1" stop-color="#10b981" stop-opacity="0"/></linearGradient></defs></svg>
            </article>

            <article class="group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-900/[0.025] transition hover:-translate-y-0.5 hover:shadow-md hover:shadow-slate-900/[0.06]">
                <div class="flex items-start justify-between">
                    <span class="text-xs font-medium text-slate-500">Conversion rate</span>
                    <span class="flex size-9 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <svg viewBox="0 0 24 24" fill="none" class="size-[18px]" aria-hidden="true"><path d="M7 17 17 7M7.5 7h.01M16.5 17h.01" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><circle cx="7.5" cy="7.5" r="3" stroke="currentColor" stroke-width="1.6"/><circle cx="16.5" cy="16.5" r="3" stroke="currentColor" stroke-width="1.6"/></svg>
                    </span>
                </div>
                <div class="mt-4 flex items-end justify-between gap-3">
                    <p class="text-[28px] font-semibold tracking-[-0.04em] text-slate-900">3.24<span class="text-xl">%</span></p>
                    <span class="mb-1 inline-flex items-center gap-1 rounded-full bg-rose-50 px-2 py-1 text-[10px] font-semibold text-rose-700">
                        <svg viewBox="0 0 16 16" fill="none" class="size-3 rotate-180" aria-hidden="true"><path d="m3.5 10 4-4 2.5 2.5L13 5.5m0 0H9.5M13 5.5V9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        0.4%
                    </span>
                </div>
                <p class="mt-2 text-[11px] text-slate-400">vs. 3.64% last month</p>
                <svg viewBox="0 0 160 30" fill="none" class="mt-4 h-7 w-full" preserveAspectRatio="none" aria-hidden="true"><path d="M1 11c10-5 13 8 22 2s13-3 22 3 13-6 22 0 13-8 22-2 13 2 22 6 13-6 22-2 13 4 27-1" stroke="#f59e0b" stroke-width="2" stroke-linecap="round"/><path d="M1 11c10-5 13 8 22 2s13-3 22 3 13-6 22 0 13-8 22-2 13 2 22 6 13-6 22-2 13 4 27-1v18H1V11Z" fill="url(#conversion-spark)"/><defs><linearGradient id="conversion-spark" x1="80" y1="1" x2="80" y2="30" gradientUnits="userSpaceOnUse"><stop stop-color="#f59e0b" stop-opacity=".14"/><stop offset="1" stop-color="#f59e0b" stop-opacity="0"/></linearGradient></defs></svg>
            </article>
        </div>
    </section>

    <div class="mt-5 grid grid-cols-1 gap-5 2xl:grid-cols-[minmax(0,1.7fr)_minmax(300px,0.8fr)]">
        <section id="analytics" class="min-w-0 rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-900/[0.025] sm:p-6">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h2 class="text-sm font-semibold tracking-tight text-slate-900">Revenue overview</h2>
                    <p class="mt-1 text-[11px] text-slate-400">Track how your store is performing over time.</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="flex items-center gap-1.5 text-[10px] font-medium text-slate-500"><span class="size-2 rounded-full bg-blue-500"></span>Revenue</span>
                    <span class="flex items-center gap-1.5 text-[10px] font-medium text-slate-500"><span class="size-2 rounded-full bg-violet-300"></span>Orders</span>
                    <button type="button" class="ml-1 rounded-lg border border-slate-200 p-1.5 text-slate-500 transition hover:bg-slate-50" aria-label="Chart options">
                        <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true"><circle cx="5" cy="12" r="1" fill="currentColor"/><circle cx="12" cy="12" r="1" fill="currentColor"/><circle cx="19" cy="12" r="1" fill="currentColor"/></svg>
                    </button>
                </div>
            </div>
            <div class="mt-5 flex items-baseline gap-2">
                <span class="text-[25px] font-semibold tracking-[-0.04em] text-slate-900">$48,294</span>
                <span class="text-xs font-medium text-emerald-600">+$5,482 (12.8%)</span>
            </div>
            <div class="mt-4 w-full overflow-hidden">
                <svg viewBox="0 0 720 228" class="h-[190px] w-full sm:h-[225px]" preserveAspectRatio="none" role="img" aria-label="Revenue and orders trending upwards over the last 30 days">
                    <defs>
                        <linearGradient id="chart-fill" x1="360" y1="12" x2="360" y2="200" gradientUnits="userSpaceOnUse"><stop stop-color="#3b82f6" stop-opacity=".13"/><stop offset="1" stop-color="#3b82f6" stop-opacity="0"/></linearGradient>
                        <linearGradient id="chart-fill-violet" x1="360" y1="50" x2="360" y2="200" gradientUnits="userSpaceOnUse"><stop stop-color="#a78bfa" stop-opacity=".08"/><stop offset="1" stop-color="#a78bfa" stop-opacity="0"/></linearGradient>
                    </defs>
                    <path d="M0 24H720M0 68H720M0 112H720M0 156H720M0 200H720" stroke="#edf0f5" stroke-dasharray="3 5"/>
                    <path d="M0 168C24 161 30 157 48 160S78 151 96 154 126 142 144 148 174 127 192 137 222 131 240 139 270 109 288 119 318 96 336 110 366 97 384 105 414 77 432 91 462 74 480 83 510 61 528 76 558 58 576 67 606 44 624 57 654 37 672 45 702 20 720 26V200H0V168Z" fill="url(#chart-fill)"/>
                    <path d="M0 168C24 161 30 157 48 160S78 151 96 154 126 142 144 148 174 127 192 137 222 131 240 139 270 109 288 119 318 96 336 110 366 97 384 105 414 77 432 91 462 74 480 83 510 61 528 76 558 58 576 67 606 44 624 57 654 37 672 45 702 20 720 26" stroke="#3b82f6" stroke-width="2.6" stroke-linecap="round" vector-effect="non-scaling-stroke"/>
                    <path d="M0 178C24 180 30 173 48 175S78 167 96 170 126 174 144 169 174 158 192 164 222 155 240 160 270 148 288 151 318 145 336 152 366 137 384 144 414 130 432 141 462 127 480 137 510 122 528 127 558 115 576 124 606 105 624 119 654 99 672 110 702 94 720 103V200H0V178Z" fill="url(#chart-fill-violet)"/>
                    <path d="M0 178C24 180 30 173 48 175S78 167 96 170 126 174 144 169 174 158 192 164 222 155 240 160 270 148 288 151 318 145 336 152 366 137 384 144 414 130 432 141 462 127 480 137 510 122 528 127 558 115 576 124 606 105 624 119 654 99 672 110 702 94 720 103" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-dasharray="5 5" vector-effect="non-scaling-stroke"/>
                    <circle cx="576" cy="67" r="4" fill="white" stroke="#3b82f6" stroke-width="2.5" vector-effect="non-scaling-stroke"/>
                </svg>
                <div class="mt-2 grid grid-cols-7 text-[9px] font-medium text-slate-400 sm:text-[10px]">
                    @foreach ($chartDates as $index => $daysAgo)
                        <span @class(['text-center' => $index > 0 && $index < 6, 'text-right' => $index === 6])>{{ $today->copy()->subDays($daysAgo)->format('M d') }}</span>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="products" class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-900/[0.025] sm:p-6">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-sm font-semibold tracking-tight text-slate-900">Top products</h2>
                    <p class="mt-1 text-[11px] text-slate-400">Your best performers this month.</p>
                </div>
                <a href="#orders" class="inline-flex items-center gap-1 text-[10px] font-semibold text-blue-600 hover:text-blue-700">
                    View all
                    <svg viewBox="0 0 16 16" fill="none" class="size-3" aria-hidden="true"><path d="M3.3 8h9.4m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
            <div class="mt-5 space-y-5">
                @foreach ($products as $index => $product)
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="flex size-10 shrink-0 items-center justify-center rounded-xl {{ $product['icon'] }}">
                                @if ($index === 0)
                                    <svg viewBox="0 0 24 24" fill="none" class="size-[19px]" aria-hidden="true"><path d="M9 18h6m-5 3h4m-2-18a6 6 0 0 0-3.6 10.8c.7.5 1.1 1.1 1.2 1.8h4.8c.1-.7.5-1.3 1.2-1.8A6 6 0 0 0 12 3Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                @elseif ($index === 1)
                                    <svg viewBox="0 0 24 24" fill="none" class="size-[19px]" aria-hidden="true"><path d="M6 8.5h12l1 11H5l1-11Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M9 9V7a3 3 0 0 1 6 0v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                                @else
                                    <svg viewBox="0 0 24 24" fill="none" class="size-[19px]" aria-hidden="true"><path d="M6 8h12l-1 12H7L6 8Zm2 0a4 4 0 0 1 8 0" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 12h.01M15 12h.01" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
                                @endif
                            </span>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="truncate text-xs font-semibold text-slate-800">{{ $product['name'] }}</p>
                                    <span class="shrink-0 text-[11px] font-semibold text-slate-700">{{ $product['sold'] }} sold</span>
                                </div>
                                <p class="mt-0.5 text-[10px] text-slate-400">{{ $product['category'] }}</p>
                            </div>
                        </div>
                        <div class="ml-[52px] mt-2.5 h-1.5 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full {{ $product['width'] }} {{ $product['color'] }}"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="#orders" class="mt-6 flex h-9 items-center justify-center rounded-xl border border-slate-200 text-[11px] font-semibold text-slate-600 transition hover:bg-slate-50">Explore product insights</a>
        </section>
    </div>

    <div class="mt-5 grid grid-cols-1 gap-5 2xl:grid-cols-[minmax(0,1.7fr)_minmax(300px,0.8fr)]">
        <section id="orders" class="min-w-0 overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.025]">
            <div class="flex flex-col gap-3 border-b border-slate-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-sm font-semibold tracking-tight text-slate-900">Recent orders</h2>
                        <span class="rounded-md bg-slate-100 px-1.5 py-0.5 text-[9px] font-semibold text-slate-500">248</span>
                    </div>
                    <p class="mt-1 text-[11px] text-slate-400">Keep track of your latest transactions.</p>
                </div>
                <a href="#overview" class="inline-flex h-8 w-fit items-center gap-1.5 rounded-lg border border-slate-200 px-2.5 text-[10px] font-semibold text-slate-600 transition hover:bg-slate-50">
                    View all orders
                    <svg viewBox="0 0 16 16" fill="none" class="size-3" aria-hidden="true"><path d="M3.3 8h9.4m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
            <div class="w-full overflow-x-auto">
                <table class="w-full min-w-[690px] text-left">
                    <thead>
                        <tr class="bg-slate-50/70 text-[9px] font-semibold uppercase tracking-[0.11em] text-slate-400">
                            <th class="px-6 py-3 font-semibold">Order</th>
                            <th class="px-4 py-3 font-semibold">Customer</th>
                            <th class="px-4 py-3 font-semibold">Product</th>
                            <th class="px-4 py-3 font-semibold">Date</th>
                            <th class="px-4 py-3 font-semibold">Amount</th>
                            <th class="px-6 py-3 text-right font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($orders as $order)
                            <tr class="transition hover:bg-slate-50/70" data-order-row>
                                <td class="whitespace-nowrap px-6 py-3.5 text-[11px] font-semibold text-slate-700">{{ $order['id'] }}</td>
                                <td class="whitespace-nowrap px-4 py-3">
                                    <div class="flex items-center gap-2.5">
                                        <span class="flex size-8 shrink-0 items-center justify-center rounded-full text-[9px] font-semibold {{ $order['avatar'] }}">{{ $order['initials'] }}</span>
                                        <span>
                                            <span class="block text-[11px] font-semibold text-slate-700">{{ $order['name'] }}</span>
                                            <span class="mt-0.5 block text-[9px] text-slate-400">{{ $order['email'] }}</span>
                                        </span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-[10px] text-slate-500">{{ $order['product'] }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-[10px] text-slate-500">{{ $order['date'] }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-[11px] font-semibold text-slate-700">{{ $order['amount'] }}</td>
                                <td class="whitespace-nowrap px-6 py-3 text-right">
                                    <span class="inline-flex items-center gap-1.5 rounded-full px-2 py-1 text-[9px] font-semibold ring-1 ring-inset {{ $order['statusClass'] }}">
                                        <span class="size-1 rounded-full bg-current"></span>
                                        {{ $order['status'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="hidden" data-order-empty>
                            <td colspan="6" class="px-6 py-10 text-center text-xs text-slate-400">No orders match your search.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3 sm:px-6">
                <p class="text-[10px] text-slate-400">Showing <span data-order-count>5</span> of 248 orders</p>
                <div class="flex items-center gap-1">
                    <button type="button" class="flex size-7 items-center justify-center rounded-lg border border-slate-200 text-slate-400" aria-label="Previous page" disabled>
                        <svg viewBox="0 0 16 16" fill="none" class="size-3.5" aria-hidden="true"><path d="m10 3.5-4.5 4.5 4.5 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <button type="button" class="flex size-7 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:bg-slate-50" aria-label="Next page">
                        <svg viewBox="0 0 16 16" fill="none" class="size-3.5" aria-hidden="true"><path d="m6 3.5 4.5 4.5L6 12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>
            </div>
        </section>

        <section id="customers" class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-900/[0.025] sm:p-6">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-sm font-semibold tracking-tight text-slate-900">Customer insights</h2>
                    <p class="mt-1 text-[11px] text-slate-400">Your audience at a glance.</p>
                </div>
                <span class="flex size-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                    <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true"><path d="M4 16.5 9 11l3.5 3.5L20 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.5 7H20v4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
            </div>
            <div class="mt-5 flex items-center justify-between">
                <div>
                    <p class="text-[26px] font-semibold tracking-[-0.04em] text-slate-900">1,893</p>
                    <p class="mt-1 text-[10px] text-slate-400">Total customers</p>
                </div>
                <div class="flex -space-x-2">
                    <span class="flex size-8 items-center justify-center rounded-full border-2 border-white bg-violet-100 text-[8px] font-semibold text-violet-700">OR</span>
                    <span class="flex size-8 items-center justify-center rounded-full border-2 border-white bg-amber-100 text-[8px] font-semibold text-amber-700">PB</span>
                    <span class="flex size-8 items-center justify-center rounded-full border-2 border-white bg-sky-100 text-[8px] font-semibold text-sky-700">LS</span>
                    <span class="flex size-8 items-center justify-center rounded-full border-2 border-white bg-slate-100 text-[8px] font-semibold text-slate-600">+9</span>
                </div>
            </div>
            <div class="mt-5 grid grid-cols-2 gap-3">
                <div class="rounded-xl bg-slate-50 p-3">
                    <p class="text-[10px] text-slate-400">New this month</p>
                    <p class="mt-1 text-sm font-semibold text-slate-800">+83 <span class="text-[9px] font-medium text-emerald-600">↑ 4.6%</span></p>
                </div>
                <div class="rounded-xl bg-slate-50 p-3">
                    <p class="text-[10px] text-slate-400">Returning</p>
                    <p class="mt-1 text-sm font-semibold text-slate-800">38.2% <span class="text-[9px] font-medium text-emerald-600">↑ 2.1%</span></p>
                </div>
            </div>
            <div class="mt-5 border-t border-slate-100 pt-4">
                <div class="flex items-center justify-between text-[10px]">
                    <span class="font-medium text-slate-600">Customer satisfaction</span>
                    <span class="font-semibold text-slate-800">4.8 <span class="text-amber-400">★</span></span>
                </div>
                <div class="mt-2.5 flex h-1.5 overflow-hidden rounded-full bg-slate-100">
                    <span class="w-[82%] rounded-full bg-emerald-400"></span>
                    <span class="ml-1 w-[12%] rounded-full bg-emerald-200"></span>
                </div>
                <p class="mt-2 text-[9px] text-slate-400">Based on 328 customer reviews</p>
            </div>
        </section>
    </div>

    <section id="team" class="mt-5 flex flex-col gap-3 rounded-2xl border border-blue-100 bg-gradient-to-r from-blue-50 via-indigo-50/70 to-violet-50/70 p-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
        <div class="flex items-start gap-3">
            <span class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-white text-blue-600 shadow-sm shadow-blue-900/5">
                <svg viewBox="0 0 24 24" fill="none" class="size-[18px]" aria-hidden="true"><path d="m12 3 2.2 5.6L20 11l-5.8 2.3L12 19l-2.3-5.7L4 11l5.7-2.4L12 3Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="m19 16 .7 1.8 1.8.7-1.8.7L19 21l-.7-1.8-1.8-.7 1.8-.7L19 16Z" fill="currentColor"/></svg>
            </span>
            <div>
                <p class="text-xs font-semibold text-slate-800">Your workspace is ready to grow</p>
                <p class="mt-1 max-w-xl text-[10px] leading-5 text-slate-500">This dashboard is your new command center. Add your Laravel modules to the navigation and make it your own.</p>
            </div>
        </div>
        <a id="settings" href="#overview" class="inline-flex h-9 shrink-0 items-center justify-center gap-1.5 rounded-xl border border-white/80 bg-white/80 px-3.5 text-[10px] font-semibold text-slate-700 shadow-sm transition hover:bg-white">
            Customize workspace
            <svg viewBox="0 0 16 16" fill="none" class="size-3" aria-hidden="true"><path d="M3.3 8h9.4m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
    </section>

    <footer class="flex flex-col gap-1 py-6 text-[9px] text-slate-400 sm:flex-row sm:items-center sm:justify-between">
        <p>© {{ now()->year }} Northstar. All rights reserved.</p>
        <p>Designed for your next big thing <span class="text-rose-400">♥</span></p>
    </footer>
@endsection
