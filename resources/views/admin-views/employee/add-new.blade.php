
@extends('layouts.back-end.app')

@section('title', translate('employee Add'))
@section('breadcrumb', translate('add_new_employee'))

@section('content')
    <div class="mx-auto w-full max-w-6xl px-4 py-5 sm:px-6 lg:px-8">

        {{-- Page Header --}}
        <div class="mb-7 overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-700/70 dark:bg-[#121d30]">
            <div class="flex flex-col gap-5 bg-gradient-to-r from-blue-50 via-white to-indigo-50 p-6 dark:from-blue-950/30 dark:via-[#121d30] dark:to-indigo-950/30 sm:flex-row sm:items-center sm:justify-between sm:p-8">
                <div class="flex items-center gap-4">
                    <span class="flex size-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/20">
                        <svg viewBox="0 0 24 24" fill="none" class="size-7" aria-hidden="true">
                            <path d="M16 20v-1.5a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4V20m7.5-9a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8-5v6m-3-3h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <div>
                        <p class="mb-1 text-xs font-semibold uppercase tracking-[0.16em] text-blue-600 dark:text-blue-300">{{ translate('employee') }}</p>
                        <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100 sm:text-3xl">
                            {{ translate('add_new_employee') }}
                        </h2>
                    </div>
                </div>
                <span class="inline-flex w-fit items-center gap-2 rounded-full border border-blue-200/80 bg-white/80 px-3 py-1.5 text-xs font-medium text-slate-600 dark:border-slate-700 dark:bg-slate-900/50 dark:text-slate-300">
                    <span class="size-2 rounded-full bg-emerald-500"></span>
                    {{ translate('general_information') }}
                </span>
            </div>
        </div>

        <div class="w-full">

            <form
                action="{{ route('admin.employee.add-new') }}"
                method="post"
                enctype="multipart/form-data"
                class="w-full space-y-6 text-left"
            >
                @csrf

                {{-- General Information --}}
                <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
                    <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/70 px-5 py-4 dark:border-slate-700/70 dark:bg-slate-900/40 sm:px-7">
                        <span class="flex size-10 items-center justify-center rounded-xl bg-blue-100 text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">
                            <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                                <path d="M16 20v-1.5a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4V20m7.5-9a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8-5v6m-3-3h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="font-semibold text-slate-900 dark:text-slate-100">{{ translate('general_information') }}</h3>
                            <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ translate('employee') }}</p>
                        </div>
                    </div>

                    <div class="p-5 sm:p-7">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                            {{-- Left Column --}}
                            <div class="space-y-5">

                                {{-- Full Name --}}
                                <div>
                                    <label for="name" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        {{ translate('full_name') }}
                                    </label>

                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                        placeholder="{{ translate('ex'). ':'. translate('John_Doe') }}"
                                        value="{{ old('name') }}"
                                        required
                                    >
                                </div>

                                {{-- Phone --}}
                                <div>
                                    <label for="phone" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        {{ translate('phone') }}
                                    </label>

                                    <input
                                        type="number"
                                        name="phone"
                                        id="phone"
                                        value="{{ old('phone') }}"
                                        class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                        placeholder="{{ translate('ex').':'. '+88017********' }}"
                                        required
                                    >
                                </div>

                                {{-- Role --}}
                                <div>
                                    <label for="role_id" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        {{ translate('role') }}
                                    </label>

                                    <select
                                        name="role_id"
                                        id="role_id"
                                        class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                    >
                                        <option value="0" selected disabled>
                                            {{ translate('select') }}
                                        </option>

                                        @foreach($employee_roles as $role)
                                            <option
                                                value="{{ $role->id }}"
                                                {{ old('role_id') == $role->id ? 'selected' : '' }}
                                            >
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Identify Type --}}
                                <div>
                                    <label for="identify_type" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        {{ translate('identify_type') }}
                                    </label>

                                    <select
                                        name="identify_type"
                                        id="identify_type"
                                        class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                    >
                                        <option value="" selected disabled>
                                            {{ translate('select_identify_type') }}
                                        </option>

                                        <option value="nid">
                                            {{ translate('NID') }}
                                        </option>

                                        <option value="passport">
                                            {{ translate('passport') }}
                                        </option>
                                    </select>
                                </div>

                                {{-- Identify Number --}}
                                <div>
                                    <label for="identify_number" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        {{ translate('identify_number') }}
                                    </label>

                                    <input
                                        type="number"
                                        name="identify_number"
                                        value="{{ old('identity_number') }}"
                                        id="identify_number"
                                        class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                        placeholder="{{ translate('ex').':'.'9876123123' }}"
                                    >
                                </div>

                            </div>

                            {{-- Right Column --}}
                            <div class="space-y-5">

                                {{-- Employee Image --}}
                                <div>

                                    <div class="mb-4 flex justify-center">
                                        <img
                                            class="upload-img-view h-64 w-64 rounded-2xl border border-slate-200 bg-slate-50 object-cover shadow-sm dark:border-slate-700 dark:bg-slate-900/40"
                                            id="viewer"
                                            alt="{{ translate('employee_image') }}"
                                            hidden
                                        >
                                        <div id="employee-image-placeholder" class="flex h-64 w-64 items-center justify-center rounded-2xl border border-dashed border-slate-300 bg-slate-50 text-slate-400 dark:border-slate-600 dark:bg-slate-900/40 dark:text-slate-500">
                                            <svg viewBox="0 0 24 24" fill="none" class="size-12" aria-hidden="true">
                                                <path d="M4 5.5A1.5 1.5 0 0 1 5.5 4h13A1.5 1.5 0 0 1 20 5.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 18.5v-13Z" stroke="currentColor" stroke-width="1.5"/>
                                                <circle cx="9" cy="9" r="1.5" stroke="currentColor" stroke-width="1.5"/>
                                                <path d="m5 17 4-4 3 3 2-2 5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </div>

                                    <label for="custom-file-upload" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        {{ translate('employee_image') }}
                                        <span class="ml-1 text-blue-600 dark:text-blue-300">
                                            ({{ translate('ratio').' '.'1:1' }})
                                        </span>
                                    </label>

                                    <div class="relative">
                                        <input
                                            type="file"
                                            name="image"
                                            id="custom-file-upload"
                                            class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-white text-sm text-slate-600 transition hover:border-blue-300 file:mr-4 file:cursor-pointer file:rounded-lg file:border-0 file:bg-slate-100 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-blue-50 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:border-blue-800 dark:file:bg-slate-800 dark:file:text-slate-200 dark:hover:file:bg-slate-700"
                                            data-image-preview
                                            accept="image/*"
                                            required
                                        >
                                    </div>

                                </div>

                                {{-- Identity Image --}}
                                <div>

                                    <label
                                        class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                                        for="identity_image"
                                    >
                                        {{ translate('identity_image') }}
                                    </label>

                                    <input
                                        type="file"
                                        name="identity_image[]"
                                        id="identity_image"
                                        class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-white text-sm text-slate-600 transition hover:border-blue-300 file:mr-4 file:cursor-pointer file:rounded-lg file:border-0 file:bg-slate-100 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-blue-50 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:border-blue-800 dark:file:bg-slate-800 dark:file:text-slate-200 dark:hover:file:bg-slate-700"
                                        accept="image/*"
                                        data-max-files="5"
                                        multiple
                                    >

                                </div>

                            </div>

                        </div>
                    </div>
                </section>

                {{-- Account Information --}}
                <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
                    <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/70 px-5 py-4 dark:border-slate-700/70 dark:bg-slate-900/40 sm:px-7">
                        <span class="flex size-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300">
                            <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                                <rect x="4" y="5" width="16" height="14" rx="2" stroke="currentColor" stroke-width="1.7"/>
                                <path d="m5 7 7 5 7-5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="font-semibold text-slate-900 dark:text-slate-100">{{ translate('account_Information') }}</h3>
                            <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ translate('email') }} &amp; {{ translate('password') }}</p>
                        </div>
                    </div>

                    <div class="p-5 sm:p-7">
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">

                            {{-- Email --}}
                            <div>
                                <label for="email" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                    {{ translate('email') }}
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    id="email"
                                    class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                    placeholder="{{ translate('ex').':'.'ex@gmail.com' }}"
                                    required
                                >
                            </div>

                            {{-- Password --}}
                            <div>
                                <label for="user_password" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                    {{ translate('password') }}
                                </label>

                                <div class="flex w-full overflow-hidden rounded-xl border border-slate-200 bg-white transition focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:focus-within:border-blue-400 dark:focus-within:ring-blue-400/10">

                                    <input
                                        type="password"
                                        class="min-w-0 flex-1 border-0 bg-transparent px-4 py-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:ring-0 dark:text-slate-100 dark:placeholder:text-slate-500"
                                        name="password"
                                        required
                                        id="user_password"
                                        placeholder="{{ translate('password_minimum_8_characters') }}"
                                    >

                                    <div id="changePassTarget" class="flex items-center border-l border-slate-200 bg-slate-50 px-3 dark:border-slate-700 dark:bg-slate-800/60">
                                        <button type="button" class="rounded-lg p-1 text-slate-500 transition hover:bg-slate-200 hover:text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100" data-password-toggle="user_password" aria-label="{{ translate('show_password') }}" aria-pressed="false">
                                            <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                                                <path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                                                <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.6"/>
                                            </svg>
                                        </button>
                                    </div>

                                </div>
                            </div>

                            {{-- Confirm Password --}}
                            <div>
                                <label for="confirm_password" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                    {{ translate('confirm_password') }}
                                </label>

                                <div class="flex w-full overflow-hidden rounded-xl border border-slate-200 bg-white transition focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:focus-within:border-blue-400 dark:focus-within:ring-blue-400/10">

                                    <input
                                        type="password"
                                        class="min-w-0 flex-1 border-0 bg-transparent px-4 py-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:ring-0 dark:text-slate-100 dark:placeholder:text-slate-500"
                                        name="confirm_password"
                                        required
                                        id="confirm_password"
                                        placeholder="{{ translate('confirm_password') }}"
                                    >

                                    <div id="changeConfirmPassTarget" class="flex items-center border-l border-slate-200 bg-slate-50 px-3 dark:border-slate-700 dark:bg-slate-800/60">
                                        <button type="button" class="rounded-lg p-1 text-slate-500 transition hover:bg-slate-200 hover:text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100" data-password-toggle="confirm_password" aria-label="{{ translate('show_password') }}" aria-pressed="false">
                                            <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                                                <path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                                                <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.6"/>
                                            </svg>
                                        </button>
                                    </div>

                                </div>
                            </div>

                        </div>

                        {{-- Form Actions --}}
                        <div class="mt-8 flex flex-col-reverse justify-end gap-3 border-t border-slate-100 pt-5 dark:border-slate-700/70 sm:flex-row">

                            <button
                                type="reset"
                                id="reset"
                                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:border-slate-600 dark:hover:bg-slate-800"
                            >
                                {{ translate('reset') }}
                            </button>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:-translate-y-0.5 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-500/25 focus:ring-offset-2 dark:focus:ring-offset-[#121d30]"
                            >
                                {{ translate('submit') }}
                                <svg viewBox="0 0 20 20" fill="none" class="size-4" aria-hidden="true">
                                    <path d="M4 10h12m0 0-5-5m5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>

                        </section>

                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection

@push('script')
    <script>
        const employeeImageInput = document.querySelector('[data-image-preview]');
        const employeeImagePreview = document.getElementById('viewer');
        const employeeImagePlaceholder = document.getElementById('employee-image-placeholder');
        const identityImagesInput = document.getElementById('identity_image');
        let employeeImagePreviewUrl;

        identityImagesInput?.addEventListener('change', () => {
            const maxFiles = Number(identityImagesInput.dataset.maxFiles);
            const exceedsLimit = (identityImagesInput.files?.length ?? 0) > maxFiles;

            identityImagesInput.setCustomValidity(
                exceedsLimit ? 'Select no more than 5 images.' : ''
            );
        });

        employeeImageInput?.addEventListener('change', () => {
            const image = employeeImageInput.files?.[0];

            if (!image || !employeeImagePreview || !employeeImagePlaceholder) {
                return;
            }

            if (employeeImagePreviewUrl) {
                URL.revokeObjectURL(employeeImagePreviewUrl);
            }

            employeeImagePreviewUrl = URL.createObjectURL(image);
            employeeImagePreview.src = employeeImagePreviewUrl;
            employeeImagePreview.hidden = false;
            employeeImagePlaceholder.hidden = true;
        });

        document.querySelectorAll('[data-password-toggle]').forEach((toggle) => {
            toggle.addEventListener('click', () => {
                const passwordInput = document.getElementById(toggle.dataset.passwordToggle);

                if (!passwordInput) {
                    return;
                }

                const isVisible = passwordInput.type === 'text';
                passwordInput.type = isVisible ? 'password' : 'text';
                toggle.setAttribute('aria-pressed', String(!isVisible));
            });
        });
    </script>
@endpush
