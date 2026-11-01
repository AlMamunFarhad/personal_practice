@extends('layouts.back-end.app')

@section('title', translate('employee_list'))

@section('content')
    <div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-7 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="flex size-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300">
                    <img src="{{ asset('assets/back-end/img/employee.png') }}" width="22" alt="">
                </span>
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ translate('employee') }}</p>
                    <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">
                        {{ translate('employee_list') }}
                    </h1>
                </div>
            </div>
        </div>

        <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
            <div class="flex flex-col gap-5 border-b border-slate-100 bg-slate-50/70 px-5 py-5 dark:border-slate-700/70 dark:bg-slate-900/40 sm:px-7 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="flex items-center gap-2 text-lg font-semibold text-slate-900 dark:text-slate-100">
                        {{ translate('employee_table') }}
                        <span class="rounded-full bg-slate-200 px-2.5 py-1 text-xs font-semibold text-slate-700 dark:bg-slate-700 dark:text-slate-200">
                            {{ $employees->total() }}
                        </span>
                    </h2>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center lg:justify-end">
                    <form action="{{ url()->current() }}" method="GET" class="flex min-w-0 flex-1 gap-2 sm:min-w-[280px]">
                        <label for="employee-search" class="sr-only">{{ translate('search_by_name_or_email_or_phone') }}</label>
                        <input
                            id="employee-search"
                            type="search"
                            name="searchValue"
                            class="min-w-0 flex-1 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                            placeholder="{{ translate('search_by_name_or_email_or_phone') }}"
                            value="{{ request('searchValue') }}"
                            required
                        >
                        <button
                            type="submit"
                            class="rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                        >
                            {{ translate('search') }}
                        </button>
                    </form>

                    <form action="{{ url()->current() }}" method="GET" class="flex gap-2">
                        <label for="employee-role" class="sr-only">{{ translate('role') }}</label>
                        <select
                            id="employee-role"
                            class="min-w-0 rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-200 dark:focus:border-blue-400 dark:focus:ring-blue-400/10 sm:min-w-[180px]"
                            name="admin_role_id"
                        >
                            <option value="all" {{ request('admin_role_id', 'all') == 'all' ? 'selected' : '' }}>
                                {{ translate('all') }}
                            </option>
                            @foreach ($employee_roles as $employee_role)
                                <option
                                    value="{{ $employee_role['id'] }}"
                                    {{ request('admin_role_id') == $employee_role['id'] ? 'selected' : '' }}
                                >
                                    {{ ucfirst($employee_role['name']) }}
                                </option>
                            @endforeach
                        </select>
                        <button
                            type="submit"
                            class="rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                        >
                            {{ translate('filter') }}
                        </button>
                    </form>

                    <details class="relative">
                        <summary class="flex cursor-pointer list-none items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-200 dark:hover:bg-slate-800">
                            <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                                <path d="M12 3v12m0 0 4-4m-4 4-4-4M5 17v3h14v-3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ translate('export') }}
                            <svg viewBox="0 0 24 24" fill="none" class="size-3.5" aria-hidden="true">
                                <path d="m7 10 5 5 5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </summary>
                        <ul class="absolute right-0 z-20 mt-2 min-w-40 rounded-xl border border-slate-200 bg-white p-1.5 shadow-lg dark:border-slate-700 dark:bg-[#121d30]">
                            <li>
                                {{-- <a
                                    class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-slate-700 transition hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-800"
                                    href="{{ route('admin.employee.export', ['role' => request('admin_role_id'), 'searchValue' => request('searchValue')]) }}"
                                >
                                    <img width="14" src="{{ asset('assets/back-end/img/excel.png') }}" alt="">
                                    {{ translate('excel') }}
                                </a> --}}
                            </li>
                        </ul>
                    </details>

                    <a
                        href="{{ route('admin.employee.add-new') }}"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                    >
                        <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                            <path d="M12 5v14m-7-7h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                        {{ translate('add_new') }}
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table
                    id="datatable"
                    style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};"
                    class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700"
                >
                    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:bg-slate-900/40 dark:text-slate-400">
                        <tr>
                            <th scope="col" class="whitespace-nowrap px-5 py-4">{{ translate('SL') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4">{{ translate('name') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4">{{ translate('email') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4">{{ translate('phone') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4">{{ translate('role') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4">{{ translate('status') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4 text-center">{{ translate('action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 dark:divide-slate-700/70 dark:text-slate-300">
                        @forelse ($employees as $key => $employee)
                            <tr class="transition hover:bg-slate-50/80 dark:hover:bg-slate-800/40">
                                <td class="whitespace-nowrap px-5 py-4 text-slate-500 dark:text-slate-400">{{ $key + 1 }}</td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <img
                                            class="size-10 rounded-full object-cover ring-2 ring-slate-100 dark:ring-slate-700"
                                            alt=""
                                            src="{{ getValidImage(path: 'storage/app/public/admin/'.$employee['image'], type: 'backend-profile') }}"
                                        >
                                        <span class="font-medium text-slate-900 dark:text-slate-100">{{ $employee['name'] }}</span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">{{ $employee['email'] }}</td>
                                <td class="whitespace-nowrap px-5 py-4">{{ $employee['phone'] }}</td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    {{ $employee?->role['name'] ?? translate('role_not_found') }}
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    @if ($employee['id'] == 1)
                                        <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">
                                            {{ translate('admin') }}
                                        </span>
                                    @else
                                        {{-- <form
                                            action="{{ route('admin.employee.status') }}"
                                            method="post"
                                            id="employee-id-{{ $employee['id'] }}-form"
                                            class="employee_id_form"
                                        >
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $employee['id'] }}">
                                            <label class="relative inline-flex cursor-pointer items-center">
                                                <input
                                                    type="checkbox"
                                                    class="switcher_input toggle-switch-message peer sr-only"
                                                    value="1"
                                                    id="employee-id-{{ $employee['id'] }}"
                                                    name="status"
                                                    {{ $employee->status ? 'checked' : '' }}
                                                    data-modal-id="toggle-status-modal"
                                                    data-toggle-id="employee-id-{{ $employee['id'] }}"
                                                    data-on-image="employee-on.png"
                                                    data-off-image="employee-off.png"
                                                    data-on-title="{{ translate('want_to_Turn_ON_Employee_Status'). '?' }}"
                                                    data-off-title="{{ translate('want_to_Turn_OFF_Employee_Status'). '?' }}"
                                                    data-on-message="<p>{{ translate('if_enabled_this_employee_can_log_in_to_the_system_and_perform_his_role') }}</p>"
                                                    data-off-message="<p>{{ translate('if_disabled_this_employee_can_not_log_in_to_the_system_and_perform_his_role') }}</p>"
                                                >
                                                <span class="switcher_control relative h-6 w-11 rounded-full bg-slate-300 transition peer-checked:bg-blue-600 peer-focus-visible:ring-4 peer-focus-visible:ring-blue-500/20 after:absolute after:left-0.5 after:top-0.5 after:size-5 after:rounded-full after:bg-white after:shadow after:transition-transform after:content-[''] peer-checked:after:translate-x-5 dark:bg-slate-600 dark:peer-checked:bg-blue-500"></span>
                                            </label>
                                        </form> --}}
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-center">
                                    @if ($employee['id'] == 1)
                                        <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600 dark:bg-slate-700 dark:text-slate-300">
                                            {{ translate('default') }}
                                        </span>
                                    @else
                                        {{-- <div class="flex items-center justify-center gap-2">
                                            <a
                                                href="{{ route('admin.employee.update', [$employee['id']]) }}"
                                                class="inline-flex size-9 items-center justify-center rounded-lg border border-blue-200 text-blue-700 transition hover:bg-blue-50 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-blue-900/70 dark:text-blue-300 dark:hover:bg-blue-500/10"
                                                title="{{ translate('edit') }}"
                                                aria-label="{{ translate('edit') }}"
                                            >
                                                <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                                                    <path d="m14 5 5 5M4 20l4.4-.9L19 8.5a2.1 2.1 0 0 0-3-3L5.4 16.1 4 20Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </a>
                                            <a
                                                href="{{ route('admin.employee.view', ['id' => $employee['id']]) }}"
                                                class="inline-flex size-9 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-500/10 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                                                title="{{ translate('view') }}"
                                                aria-label="{{ translate('view') }}"
                                            >
                                                <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                                                    <path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                                                    <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.7"/>
                                                </svg>
                                            </a>
                                        </div> --}}
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-12 text-center text-sm text-slate-500 dark:text-slate-400">
                                    {{ translate('no_data_found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end border-t border-slate-100 px-5 py-4 dark:border-slate-700/70 sm:px-7">
                {{ $employees->links() }}
            </div>
        </section>
    </div>
@endsection
