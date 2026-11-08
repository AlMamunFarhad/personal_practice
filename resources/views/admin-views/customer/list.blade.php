@php use Illuminate\Support\Str; @endphp
@extends('layouts.back-end.app')

@section('title', translate('customer_List'))

@section('content')
    <div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-7 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="flex size-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300">
                    <img src="{{ asset('assets/back-end/img/customer.png') }}" width="22" alt="">
                </span>
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ translate('customer') }}</p>
                    <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">
                        {{ translate('customer_list') }}
                    </h1>
                </div>
            </div>
            <a href="{{ route('admin.customer.add') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                    <path d="M12 5v14m-7-7h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                {{ translate('add_new') }}
            </a>
        </div>

        <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
            <div class="flex flex-col gap-5 border-b border-slate-100 bg-slate-50/70 px-5 py-5 dark:border-slate-700/70 dark:bg-slate-900/40 sm:px-7 lg:flex-row lg:items-center lg:justify-between">
                <h2 class="flex items-center gap-2 text-lg font-semibold text-slate-900 dark:text-slate-100">
                    {{ translate('customer_list') }}
                    <span class="rounded-full bg-slate-200 px-2.5 py-1 text-xs font-semibold text-slate-700 dark:bg-slate-700 dark:text-slate-200">
                        {{ count($customers) }}
                    </span>
                </h2>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">
                    <form action="{{ url()->current() }}" method="GET" class="flex min-w-0 flex-1 gap-2 sm:min-w-[280px]">
                        <label for="customer-search" class="sr-only">{{ translate('search_by_Name_or_Email_or_Phone') }}</label>
                        <input
                            id="customer-search"
                            type="search"
                            name="searchValue"
                            class="min-w-0 flex-1 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                            placeholder="{{ translate('search_by_Name_or_Email_or_Phone') }}"
                            aria-label="{{ translate('search_by_Name_or_Email_or_Phone') }}"
                            value="{{ request('searchValue') }}"
                        >
                        <button
                            type="submit"
                            class="rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                        >
                            {{ translate('search') }}
                        </button>
                    </form>

                    <details class="group relative">
                        <summary class="flex cursor-pointer list-none items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-200 dark:hover:bg-slate-800">
                            <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                                <path d="M12 3v12m0 0 4-4m-4 4-4-4M5 17v3h14v-3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ translate('export') }}
                            <svg viewBox="0 0 24 24" fill="none" class="size-3.5 transition group-open:rotate-180" aria-hidden="true">
                                <path d="m7 10 5 5 5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </summary>
                        {{-- <ul class="absolute end-0 z-20 mt-2 hidden min-w-40 rounded-xl border border-slate-200 bg-white p-1.5 shadow-lg group-open:block dark:border-slate-700 dark:bg-[#121d30]">
                            <li>
                                <a
                                    class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-slate-700 transition hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-800"
                                    href="{{ route('admin.customer.export', ['searchValue' => request('searchValue')]) }}"
                                >
                                    <img width="14" src="{{ asset('assets/back-end/img/excel.png') }}" alt="">
                                    {{ translate('excel') }}
                                </a>
                            </li>
                        </ul> --}}
                    </details>
                    <a
                        href="{{ route('admin.customer.add') }}"
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
                    style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};"
                    class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700/70"
                >
                    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:bg-slate-900/40 dark:text-slate-400">
                        <tr>
                            <th scope="col" class="whitespace-nowrap px-5 py-4">{{ translate('SL') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4">{{ translate('customer_name') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4">{{ translate('contact_info') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4">{{ translate('total_Order') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4 text-center">{{ translate('block') }} / {{ translate('unblock') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4 text-center">{{ translate('action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 dark:divide-slate-700/70 dark:text-slate-300">
                        @forelse ($customers as $key => $customer)
                            <tr class="transition hover:bg-slate-50/80 dark:hover:bg-slate-800/40">
                                <td class="whitespace-nowrap px-5 py-4 text-slate-500 dark:text-slate-400">
                                    {{ $customers->firstItem() + $key }}
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    <a
                                        href="{{ route('admin.customer.view', [$customer['id']]) }}"
                                        class="flex items-center gap-3 font-medium text-slate-900 transition hover:text-blue-700 dark:text-slate-100 dark:hover:text-blue-300"
                                    >
                                        <img
                                            src="{{ getValidImage(path: 'storage/app/public/profile/'.$customer->image, type: 'backend-profile') }}"
                                            class="size-10 rounded-full object-cover ring-2 ring-slate-100 dark:ring-slate-700"
                                            alt=""
                                            width="40"
                                        >
                                        <span>{{ Str::limit($customer['name'], 20) }}</span>
                                    </a>
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    <div class="mb-1">
                                        <a class="font-medium text-slate-800 transition hover:text-blue-700 dark:text-slate-200 dark:hover:text-blue-300" href="mailto:{{ $customer->email }}">
                                            {{ $customer->email }}
                                        </a>
                                    </div>
                                    <a class="text-slate-500 transition hover:text-blue-700 dark:text-slate-400 dark:hover:text-blue-300" href="tel:{{ $customer->phone }}">
                                        {{ $customer->phone }}
                                    </a>
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    <span class="inline-flex min-w-9 items-center justify-center rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">
                                        {{ $customer->orders_count }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-center">
                                    @if ($customer['email'] == 'walking@customer.com')
                                        <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600 dark:bg-slate-700 dark:text-slate-300">
                                            {{ translate('default') }}
                                        </span>
                                    @else
                                        <form
                                            action="{{ route('admin.customer.status-update') }}"
                                            method="post"
                                            id="customer-status{{ $customer['id'] }}-form"
                                            class="customer-status-form"
                                        >
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $customer['id'] }}">
                                            <label class="relative inline-flex cursor-pointer items-center">
                                                <input
                                                    type="checkbox"
                                                    class="switcher_input toggle-switch-message peer sr-only"
                                                    id="customer-status{{ $customer['id'] }}"
                                                    name="status"
                                                    value="1"
                                                    {{ $customer['is_active'] == 1 ? 'checked' : '' }}
                                                    data-modal-id="toggle-status-modal"
                                                    data-toggle-id="customer-status{{ $customer['id'] }}"
                                                    data-on-image="customer-block-on.png"
                                                    data-off-image="customer-block-off.png"
                                                    data-on-title="{{ translate('want_to_unblock').' '.$customer['f_name'].' '.$customer['l_name'].'?' }}"
                                                    data-off-title="{{ translate('want_to_block').' '.$customer['f_name'].' '.$customer['l_name'].'?' }}"
                                                    data-on-message="<p>{{ translate('if_enabled_this_customer_will_be_unblocked_and_can_log_in_to_this_system_again') }}</p>"
                                                    data-off-message="<p>{{ translate('if_disabled_this_customer_will_be_blocked_and_cannot_log_in_to_this_system') }}</p>"
                                                >
                                                <span class="switcher_control relative h-6 w-11 rounded-full bg-slate-300 transition peer-checked:bg-blue-600 peer-focus-visible:ring-4 peer-focus-visible:ring-blue-500/20 after:absolute after:left-0.5 after:top-0.5 after:size-5 after:rounded-full after:bg-white after:shadow after:transition-transform after:content-[''] peer-checked:after:translate-x-5 dark:bg-slate-600 dark:peer-checked:bg-blue-500"></span>
                                            </label>
                                        </form>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a
                                            title="{{ translate('edit') }}"
                                            aria-label="{{ translate('edit') }}"
                                            class="inline-flex size-9 items-center justify-center rounded-lg border border-blue-200 text-blue-700 transition hover:bg-blue-50 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-blue-900/70 dark:text-blue-300 dark:hover:bg-blue-500/10"
                                            href="{{ route('admin.customer.edit', [$customer['id']]) }}"
                                        >
                                            <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                                                <path d="m14 5 5 5M4 20l4.2-.8L19 8.4a2.1 2.1 0 0 0-3-3L5.2 16.2 4 20Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        <a
                                            title="{{ translate('view') }}"
                                            aria-label="{{ translate('view') }}"
                                            class="inline-flex size-9 items-center justify-center rounded-lg border border-blue-200 text-blue-700 transition hover:bg-blue-50 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-blue-900/70 dark:text-blue-300 dark:hover:bg-blue-500/10"
                                            href="{{ route('admin.customer.view', [$customer['id']]) }}"
                                        >
                                            <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                                                <path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                                                <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.7"/>
                                            </svg>
                                        </a>
                                        @if ($customer['id'] != '0')
                                            <a
                                                title="{{ translate('delete') }}"
                                                aria-label="{{ translate('delete') }}"
                                                class="delete-data delete inline-flex size-9 items-center justify-center rounded-lg border border-rose-200 text-rose-600 transition hover:bg-rose-50 focus:outline-none focus:ring-4 focus:ring-rose-500/10 dark:border-rose-500/30 dark:text-rose-300 dark:hover:bg-rose-500/10"
                                                href="javascript:"
                                                data-id="customer-{{ $customer['id'] }}"
                                            >
                                                <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                                                    <path d="M4 7h16m-10 4v6m4-6v6M6 7l1 14h10l1-14M9 7V4h6v3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                    <form action="{{ route('admin.customer.delete', [$customer['id']]) }}" method="post" id="customer-{{ $customer['id'] }}">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center">
                                    <img
                                        class="mx-auto mb-3 w-40"
                                        src="{{ asset('assets/back-end/svg/illustrations/sorry.svg') }}"
                                        alt=""
                                    >
                                    <p class="mb-0 text-sm text-slate-500 dark:text-slate-400">{{ translate('no_data_to_show') }}</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end border-t border-slate-100 px-5 py-4 dark:border-slate-700/70 sm:px-7">
                {!! $customers->links() !!}
            </div>
        </section>
    </div>
@endsection
