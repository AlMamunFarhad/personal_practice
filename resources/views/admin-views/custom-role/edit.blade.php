@extends('layouts.back-end.app')

@section('title', translate('edit_Role'))

@section('content')
    <div class="mx-auto w-full max-w-6xl px-4 py-6 sm:px-6 lg:px-8">
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
                            {{ translate('employee_Roles') }} #{{ $role['id'] }}
                        </p>
                        <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100 sm:text-3xl">
                            {{ translate('role_update') }}
                        </h1>
                    </div>
                </div>
                <span class="inline-flex w-fit items-center gap-2 rounded-full border border-blue-200/80 bg-white/80 px-3 py-1.5 text-xs font-medium text-slate-600 dark:border-slate-700 dark:bg-slate-900/50 dark:text-slate-300">
                    <span class="size-2 rounded-full bg-emerald-500"></span>
                    {{ translate('module_permission') }}
                </span>
            </div>
        </div>

        <form id="submit-create-role" action="{{ route('admin.custom-role.update', [$role['id']]) }}" method="post" class="space-y-6 text-start">
            @csrf
            <input type="hidden" name="id" value="{{ $role['id'] }}">

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
                            value="{{ $role['name'] }}"
                            id="name"
                            class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                            placeholder="{{ translate('ex').':'.translate('store') }}"
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
                            <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ translate('select_all') }} / {{ translate('modules') }}</p>
                        </div>
                    </div>
                    <label for="select-all" class="inline-flex w-fit cursor-pointer items-center gap-2 rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50 dark:border-slate-700 dark:bg-slate-900/50 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/10">
                        <input type="checkbox" id="select-all" class="size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800">
                        {{ translate('select_all') }}
                    </label>
                </div>

                <div class="grid grid-cols-1 gap-3 p-5 sm:grid-cols-2 sm:p-7 lg:grid-cols-3">
                    <label for="dashboard" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" name="modules[]" value="dashboard" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" id="dashboard" {{ in_array('dashboard', (array) json_decode($role['module_access'])) ? 'checked' : '' }}>
                        <span>{{ translate('dashboard') }}</span>
                    </label>
                    <label for="pos_management" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" name="modules[]" value="pos_management" id="pos_management" {{ in_array('pos_management', (array) json_decode($role['module_access'])) ? 'checked' : '' }}>
                        <span>{{ translate('pos_management') }}</span>
                    </label>
                    <label for="order" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" name="modules[]" value="order_management" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" id="order" {{ in_array('order_management', (array) json_decode($role['module_access'])) ? 'checked' : '' }}>
                        <span>{{ translate('order_management') }}</span>
                    </label>
                    <label for="product" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" name="modules[]" value="product_management" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" id="product" {{ in_array('product_management', (array) json_decode($role['module_access'])) ? 'checked' : '' }}>
                        <span>{{ translate('product_management') }}</span>
                    </label>
                    <label for="promotion_management" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" name="modules[]" value="promotion_management" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" id="promotion_management" {{ in_array('promotion_management', (array) json_decode($role['module_access'])) ? 'checked' : '' }}>
                        <span>{{ translate('promotion_management') }}</span>
                    </label>
                    <label for="support_section" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" name="modules[]" value="support_section" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" id="support_section" {{ in_array('support_section', (array) json_decode($role['module_access'])) ? 'checked' : '' }}>
                        <span>{{ translate('help_&_support_Section') }}</span>
                    </label>
                    <label for="report" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" name="modules[]" value="report" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" id="report" {{ in_array('report', (array) json_decode($role['module_access'])) ? 'checked' : '' }}>
                        <span>{{ translate('reports_and_analytics') }}</span>
                    </label>
                    <label for="user_section" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" name="modules[]" value="user_section" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" id="user_section" {{ in_array('user_section', (array) json_decode($role['module_access'])) ? 'checked' : '' }}>
                        <span>{{ translate('user_management') }}</span>
                    </label>
                    <label for="system_settings" class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 text-sm font-medium text-slate-700 transition hover:border-blue-300 hover:bg-blue-50/60 has-[:checked]:border-blue-300 has-[:checked]:bg-blue-50/80 dark:border-slate-700/70 dark:bg-slate-900/30 dark:text-slate-300 dark:hover:border-blue-500/50 dark:hover:bg-blue-500/5 dark:has-[:checked]:border-blue-500/50 dark:has-[:checked]:bg-blue-500/10">
                        <input type="checkbox" name="modules[]" value="system_settings" class="module-permission size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800" id="system_settings" {{ in_array('system_settings', (array) json_decode($role['module_access'])) ? 'checked' : '' }}>
                        <span>{{ translate('system_Settings') }}</span>
                    </label>
                </div>
            </section>

            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <button type="reset" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-900/50 dark:text-slate-300 dark:hover:bg-slate-800 dark:focus:ring-slate-700">
                    {{ translate('reset') }}
                </button>
                <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                    {{ translate('update') }}
                </button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/back-end/js/admin/custom-role.js') }}"></script>
@endpush
