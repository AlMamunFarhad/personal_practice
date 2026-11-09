@extends('layouts.back-end.app')

@section('title', translate('customer_details'))

@section('content')
    <div class="mx-auto w-full max-w-6xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-7 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="flex size-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300">
                    <svg viewBox="0 0 24 24" fill="none" class="size-6" aria-hidden="true">
                        <path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.7"/>
                    </svg>
                </span>
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ translate('customer') }}</p>
                    <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">{{ translate('customer_details') }}</h1>
                </div>
            </div>
            <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-[#121d30] dark:text-slate-300">
                <span class="size-2 rounded-full bg-blue-500"></span>
                {{ translate('customer_ID') }} #{{ $customer['id'] }}
            </span>
        </div>

        <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
            <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-600 to-violet-700 px-6 py-8 sm:px-9 sm:py-10">
                <div class="absolute -right-12 -top-20 size-64 rounded-full border-[32px] border-white/[0.06]"></div>
                <div class="absolute -bottom-28 right-40 size-64 rounded-full border-[28px] border-white/[0.05]"></div>
                <div class="relative flex flex-col gap-6 sm:flex-row sm:items-center">
                    <div class="mx-auto shrink-0 sm:mx-0">
                        <img
                            class="size-32 rounded-3xl border-4 border-white/30 bg-white/10 object-cover shadow-2xl shadow-indigo-950/25 sm:size-36"
                            src="{{ getValidImage(path: 'storage/app/public/profile/'.$customer['image'], type: 'backend-profile') }}"
                            alt="{{ translate('customer') }} {{ translate('image') }}"
                        >
                    </div>

                    <div class="min-w-0 flex-1 text-center text-white sm:text-left">
                        <p class="mb-2 text-xs font-semibold uppercase tracking-[0.18em] text-blue-100/80">
                            {{ translate('customer') }} #{{ $customer['id'] }}
                        </p>
                        <h2 class="break-words text-2xl font-semibold tracking-tight sm:text-3xl">{{ $customer->name }}</h2>
                        <p class="mt-2 text-sm font-medium text-blue-100">
                            {{ translate('joined_At') }} · {{ $customer->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <a
                        href="{{ route('admin.customer.edit', [$customer['id']]) }}"
                        class="relative inline-flex items-center justify-center gap-2 self-center rounded-xl border border-white/25 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/20 focus:outline-none focus:ring-4 focus:ring-white/25 sm:self-auto"
                    >
                        <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                            <path d="m14 5 5 5M4 20l4.2-.8L19 8.4a2.1 2.1 0 0 0-3-3L5.2 16.2 4 20Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        {{ translate('edit') }}
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 p-5 sm:p-7 lg:grid-cols-5">
                <div class="space-y-6 lg:col-span-3">
                    <div>
                        <h3 class="mb-4 text-sm font-semibold uppercase tracking-[0.12em] text-slate-500 dark:text-slate-400">
                            {{ translate('general_information') }}
                        </h3>
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <div class="flex items-start gap-3 rounded-2xl border border-slate-100 bg-slate-50/80 p-4 dark:border-slate-700/70 dark:bg-slate-900/40">
                                <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">
                                    <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                                        <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7l.5 3a2 2 0 0 1-.6 1.7L7.1 10.3a16 16 0 0 0 6 6l1.9-1.9a2 2 0 0 1 1.7-.6l3 .5a2 2 0 0 1 1.7 2Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400">{{ translate('phone') }}</p>
                                    <a href="tel:{{ $customer->phone }}" class="mt-1 block break-all text-sm font-semibold text-slate-900 hover:text-blue-600 dark:text-slate-100 dark:hover:text-blue-300">
                                        {{ $customer->phone ?: '—' }}
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 rounded-2xl border border-slate-100 bg-slate-50/80 p-4 dark:border-slate-700/70 dark:bg-slate-900/40">
                                <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300">
                                    <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                                        <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/>
                                        <path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400">{{ translate('email') }}</p>
                                    <a href="mailto:{{ $customer->email }}" class="mt-1 block break-all text-sm font-semibold text-slate-900 hover:text-blue-600 dark:text-slate-100 dark:hover:text-blue-300">
                                        {{ $customer->email }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="h-fit rounded-2xl border border-blue-100 bg-gradient-to-br from-blue-50 via-white to-indigo-50 p-5 dark:border-slate-700 dark:from-blue-950/25 dark:via-slate-900/30 dark:to-indigo-950/25 lg:col-span-2">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">
                                <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                                    <path d="M12 3 4 6v5c0 5 3.4 8.5 8 10 4.6-1.5 8-5 8-10V6l-8-3Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                                    <path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <div>
                                <h3 class="font-semibold text-slate-900 dark:text-slate-100">{{ translate('account') }}</h3>
                                <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ translate('status') }}</p>
                            </div>
                        </div>
                        <a
                            href="{{ route('admin.customer.edit', [$customer['id']]) }}"
                            class="flex size-9 shrink-0 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:border-blue-200 hover:text-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/50 dark:text-slate-300 dark:hover:border-blue-800 dark:hover:text-blue-300"
                            title="{{ translate('edit') }}"
                            aria-label="{{ translate('edit') }}"
                        >
                            <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                                <path d="m14 5 5 5M4 20l4.2-.8L19 8.4a2.1 2.1 0 0 0-3-3L5.2 16.2 4 20Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>

                    <div class="mt-5">
                        @if ($customer->is_active)
                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                                <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                {{ translate('active') }}
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 rounded-full bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-700 dark:bg-rose-500/10 dark:text-rose-300">
                                <span class="size-1.5 rounded-full bg-rose-500"></span>
                                {{ translate('inactive') }}
                            </span>
                        @endif
                    </div>
                </aside>
            </div>

            <div class="flex justify-end border-t border-slate-100 bg-slate-50/60 px-5 py-4 dark:border-slate-700/70 dark:bg-slate-900/30 sm:px-7">
                <a
                    href="{{ route('admin.customer.edit', [$customer['id']]) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:-translate-y-0.5 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-500/25"
                >
                    <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                        <path d="m14 5 5 5M4 20l4.2-.8L19 8.4a2.1 2.1 0 0 0-3-3L5.2 16.2 4 20Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{ translate('edit') }}
                </a>
            </div>
        </section>
    </div>
@endsection
