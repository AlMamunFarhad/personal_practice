@extends('layouts.back-end.app')

@section('title', translate('create_Role'))

@section('content')
    <div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-7 overflow-hidden rounded-3xl border border-blue-100 bg-gradient-to-br from-blue-50 via-white to-indigo-50 shadow-sm dark:border-slate-700 dark:from-blue-950/30 dark:via-[#121d30] dark:to-indigo-950/30">
            <div class="flex flex-col gap-5 p-6 sm:flex-row sm:items-center sm:justify-between sm:p-8">
                <div class="flex items-center gap-4">
                    <span class="flex size-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/25">
                        <svg viewBox="0 0 24 24" fill="none" class="size-7" aria-hidden="true">
                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm7.4-3a7.4 7.4 0 0 0-.1-1.2l1.5-1.2-1.5-2.6-1.8.7a7 7 0 0 0-2-1.2L15.2 4h-3l-.3 2.5a7 7 0 0 0-2 1.2l-1.8-.7-1.5 2.6 1.5 1.2a7.4 7.4 0 0 0 0 2.4l-1.5 1.2 1.5 2.6 1.8-.7a7 7 0 0 0 2 1.2l.3 2.5h3l.3-2.5a7 7 0 0 0 2-1.2l1.8.7 1.5-2.6-1.5-1.2c.1-.4.1-.8.1-1.2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <div>
                        <p class="mb-1 text-xs font-semibold uppercase tracking-[0.16em] text-blue-600 dark:text-blue-300">
                            {{ translate('employee_Roles') }}
                        </p>
                        <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100 sm:text-3xl">
                            {{ translate('employee_role_setup') }}
                        </h1>
                    </div>
                </div>
                <span class="inline-flex w-fit items-center gap-2 rounded-full border border-blue-200/80 bg-white/80 px-3 py-1.5 text-xs font-medium text-slate-600 dark:border-slate-700 dark:bg-slate-900/50 dark:text-slate-300">
                    <span class="size-2 rounded-full bg-emerald-500"></span>
                    {{ translate('module_permission') }}
                </span>
            </div>
        </div>

        <form id="submit-create-role" method="post" action="{{ route('admin.custom-role.store') }}" class="mb-8 space-y-6 text-start">
            @csrf

            <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
                <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/70 px-5 py-4 dark:border-slate-700/70 dark:bg-slate-900/40 sm:px-7">
                    <span class="flex size-10 items-center justify-center rounded-xl bg-blue-100 text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">
                        <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                            <path d="M4 7h16M4 12h16M4 17h10" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <div>
                        <h2 class="font-semibold text-slate-900 dark:text-slate-100">{{ translate('general_information') }}</h2>
                        <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ translate('role_name') }}</p>
                    </div>
                </div>

                <div class="p-5 sm:p-7">
                    <div class="max-w-2xl">
                        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            {{ translate('role_name') }}
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                            placeholder="{{ translate('ex').':'.translate('store') }}"
                            required
                        >
                    </div>
                </div>
            </section>

            <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
                <div class="flex flex-col gap-4 border-b border-slate-100 bg-slate-50/70 px-5 py-4 dark:border-slate-700/70 dark:bg-slate-900/40 sm:flex-row sm:items-center sm:justify-between sm:px-7">
                    <div class="flex items-center gap-3">
                        <span class="flex size-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300">
                            <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                                <path d="M4 5h6v6H4zM14 5h6v6h-6zM4 15h6v5H4zM14 15h6v5h-6z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div>
                            <h2 class="font-semibold text-slate-900 dark:text-slate-100">{{ translate('module_permission') }}</h2>
                            <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ translate('modules') }}</p>
                        </div>
                    </div>
                    <label for="select-all" class="inline-flex w-fit cursor-pointer items-center gap-2 rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50 dark:border-slate-700 dark:bg-slate-900/50 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/10">
                        <input type="checkbox" id="select-all" class="size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800">
                        {{ translate('select_all') }}
                    </label>
                </div>

                <div class="grid grid-cols-1 gap-3 p-5 sm:grid-cols-2 sm:p-7 lg:grid-cols-3">
                    <label for="dashboard" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" name="modules[]" value="dashboard" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" id="dashboard">
                        <span>{{ translate('dashboard') }}</span>
                    </label>
                    <label for="pos_management" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" name="modules[]" value="pos_management" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" id="pos_management">
                        <span>{{ translate('pos_management') }}</span>
                    </label>
                    <label for="order" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" name="modules[]" value="order_management" id="order">
                        <span>{{ translate('order_management') }}</span>
                    </label>
                    <label for="product" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" name="modules[]" value="product_management" id="product">
                        <span>{{ translate('product_management') }}</span>
                    </label>
                    <label for="promotion_management" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" name="modules[]" value="promotion_management" id="promotion_management">
                        <span>{{ translate('promotion_management') }}</span>
                    </label>
                    <label for="support_section" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" name="modules[]" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" value="support_section" id="support_section">
                        <span>{{ translate('help_&_support_section') }}</span>
                    </label>
                    <label for="report" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" name="modules[]" value="report" id="report">
                        <span>{{ translate('reports_&_analytics') }}</span>
                    </label>
                    <label for="user_section" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" name="modules[]" value="user_section" id="user_section">
                        <span>{{ translate('user_management') }}</span>
                    </label>
                    <label for="system_settings" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" name="modules[]" value="system_settings" id="system_settings">
                        <span>{{ translate('system_settings') }}</span>
                    </label>
                </div>
            </section>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 sm:w-auto">
                    {{ translate('submit') }}
                </button>
            </div>
        </form>

        <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
            <div class="flex flex-col gap-5 border-b border-slate-100 bg-slate-50/70 px-5 py-5 dark:border-slate-700/70 dark:bg-slate-900/40 sm:px-7 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">{{ translate('employee_Roles') }}</h2>
                        <span class="inline-flex min-w-8 items-center justify-center rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">{{ count($roles) }}</span>
                    </div>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ translate('role_name') }} · {{ translate('modules') }}</p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <form action="{{ url()->current() }}?search={{ request('searchValue') }}" method="GET" class="flex min-w-0 flex-1">
                        <label for="datatableSearch_" class="sr-only">{{ translate('search_role') }}</label>
                        <div class="flex min-w-0 flex-1 rounded-xl shadow-sm">
                            <div class="flex items-center rounded-s-xl border border-e-0 border-slate-200 bg-white px-3 text-slate-400 dark:border-slate-700 dark:bg-slate-900/50">
                                <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                                    <circle cx="10.8" cy="10.8" r="6.8" stroke="currentColor" stroke-width="1.7"/>
                                    <path d="m16 16 4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <input id="datatableSearch_" type="search" name="searchValue" class="min-w-0 flex-1 border-y border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/50 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400" placeholder="{{ translate('search_role') }}" value="{{ request('searchValue') }}">
                            <button type="submit" class="rounded-e-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                                {{ translate('search') }}
                            </button>
                        </div>
                    </form>

                    <details class="group relative">
                        <summary class="flex cursor-pointer list-none items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-blue-300 hover:bg-blue-50 dark:border-slate-700 dark:bg-slate-900/50 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/10">
                            <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                                <path d="M12 3v12m0 0 4-4m-4 4-4-4M5 17v3h14v-3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ translate('export') }}
                            <svg viewBox="0 0 24 24" fill="none" class="size-4 transition group-open:rotate-180" aria-hidden="true">
                                <path d="m7 10 5 5 5-5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </summary>
                        <div class="absolute end-0 z-20 mt-2 hidden w-44 overflow-hidden rounded-xl border border-slate-200 bg-white p-1 shadow-xl group-open:block dark:border-slate-700 dark:bg-[#121d30]">
                            <a class="flex items-center gap-2 rounded-lg px-3 py-2.5 text-sm text-slate-700 transition hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-800" href="{{ route('admin.custom-role.export', ['searchValue' => request('searchValue')]) }}">
                                <img width="14" src="{{ asset('assets/back-end/img/excel.png') }}" alt="">
                                {{ translate('excel') }}
                            </a>
                        </div>
                    </details>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[760px] text-start text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500 dark:bg-slate-900/30 dark:text-slate-400">
                        <tr>
                            <th scope="col" class="px-5 py-4 font-semibold sm:px-7">{{ translate('SL') }}</th>
                            <th scope="col" class="px-5 py-4 font-semibold">{{ translate('role_name') }}</th>
                            <th scope="col" class="px-5 py-4 font-semibold">{{ translate('modules') }}</th>
                            <th scope="col" class="px-5 py-4 font-semibold">{{ translate('created_at') }}</th>
                            <th scope="col" class="px-5 py-4 font-semibold">{{ translate('status') }}</th>
                            <th scope="col" class="px-5 py-4 text-center font-semibold">{{ translate('action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/70">
                        @forelse($roles as $key => $role)
                            <tr class="transition hover:bg-slate-50/80 dark:hover:bg-slate-800/30">
                                <td class="whitespace-nowrap px-5 py-4 text-slate-500 dark:text-slate-400 sm:px-7">{{ $key + 1 }}</td>
                                <td class="whitespace-nowrap px-5 py-4 font-semibold text-slate-800 dark:text-slate-200">{{ $role['name'] }}</td>
                                <td class="px-5 py-4">
                                    <div class="flex max-w-lg flex-wrap gap-1.5">
                                        @if($role['module_access'] != null)
                                            @foreach((array) json_decode($role['module_access']) as $module)
                                                @if($module == 'report')
                                                    <span class="rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700 dark:bg-blue-500/10 dark:text-blue-300">{{ translate('reports_and_analytics') }}</span>
                                                @elseif($module == 'user_section')
                                                    <span class="rounded-lg bg-violet-50 px-2.5 py-1 text-xs font-medium text-violet-700 dark:bg-violet-500/10 dark:text-violet-300">{{ translate('user_management') }}</span>
                                                @elseif($module == 'support_section')
                                                    <span class="rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">{{ translate('Help_&_Support_Section') }}</span>
                                                @else
                                                    <span class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-medium capitalize text-slate-600 dark:bg-slate-800 dark:text-slate-300">{{ translate(str_replace('_', ' ', $module)) }}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-slate-600 dark:text-slate-400">{{ date('d-M-y', strtotime($role['created_at'])) }}</td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    <form action="{{ route('admin.custom-role.employee-role-status') }}" method="post" id="employee-role-status{{ $role['id'] }}-form">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $role['id'] }}">
                                        <label class="switcher" for="employee-role-status{{ $role['id'] }}">
                                            <input type="checkbox" class="switcher_input toggle-switch-message" id="employee-role-status{{ $role['id'] }}" name="status" value="1" {{ $role['status'] == 1 ? 'checked' : '' }}
                                                data-modal-id="toggle-status-modal"
                                                data-toggle-id="employee-role-status{{ $role['id'] }}"
                                                data-on-image="employee-on.png"
                                                data-off-image="employee-off.png"
                                                data-on-title="{{ translate('want_to_Turn_ON_Employee_Status'). '?' }}"
                                                data-off-title="{{ translate('want_to_Turn_OFF_Employee_Status'). '?' }}"
                                                data-on-message="<p>{{ translate('when_the_status_is_enabled_employees_can_access_the_system_to_perform_their_responsibilities') }}</p>"
                                                data-off-message="<p>{{ translate('when_the_status_is_disabled_employees_cannot_access_the_system_to_perform_their_responsibilities') }}</p>">
                                            <span class="switcher_control"></span>
                                        </label>
                                    </form>
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.custom-role.update', [$role['id']]) }}" class="inline-flex size-9 items-center justify-center rounded-lg border border-blue-200 text-blue-600 transition hover:bg-blue-50 dark:border-blue-500/30 dark:text-blue-300 dark:hover:bg-blue-500/10" title="{{ translate('edit') }}" aria-label="{{ translate('edit') }}">
                                            <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                                                <path d="m14 5 5 5M4 20l4.2-.8L19 8.4a2.1 2.1 0 0 0-3-3L5.2 16.2 4 20Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        <a href="javascript:" class="delete-data-without-form inline-flex size-9 items-center justify-center rounded-lg border border-rose-200 text-rose-600 transition hover:bg-rose-50 dark:border-rose-500/30 dark:text-rose-300 dark:hover:bg-rose-500/10" data-action="{{ route('admin.custom-role.delete') }}" title="{{ translate('delete') }}" aria-label="{{ translate('delete') }}" data-id="{{ $role['id'] }}">
                                            <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                                                <path d="M4 7h16m-10 4v6m4-6v6M6 7l1 14h10l1-14M9 7V4h6v3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center text-sm text-slate-500 dark:text-slate-400">
                                    {{ translate('no_data_found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/back-end/js/admin/custom-role.js') }}"></script>
@endpush
