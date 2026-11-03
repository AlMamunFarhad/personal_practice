@extends('layouts.back-end.app')

@section('title', translate('employee_Edit'))

@section('content')
    <div class="mx-auto w-full max-w-6xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-7 overflow-hidden rounded-3xl border border-blue-100 bg-gradient-to-br from-blue-50 via-white to-indigo-50 shadow-sm dark:border-slate-700 dark:from-blue-950/30 dark:via-[#121d30] dark:to-indigo-950/30">
            <div class="flex flex-col gap-5 p-6 sm:flex-row sm:items-center sm:justify-between sm:p-8">
                <div class="flex items-center gap-4">
                    <span class="flex size-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/25">
                        <svg viewBox="0 0 24 24" fill="none" class="size-7" aria-hidden="true">
                            <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8 9v-1.5a4.5 4.5 0 0 0-4.5-4.5h-7A4.5 4.5 0 0 0 4 19.5V21m14-13h4m-2-2v4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <div>
                        <p class="mb-1 text-xs font-semibold uppercase tracking-[0.16em] text-blue-600 dark:text-blue-300">
                            {{ translate('employee') }} #{{ $employee['id'] }}
                        </p>
                        <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100 sm:text-3xl">
                            {{ translate('employee_update') }}
                        </h1>
                    </div>
                </div>
                <span class="inline-flex w-fit items-center gap-2 rounded-full border border-blue-200/80 bg-white/80 px-3 py-1.5 text-xs font-medium text-slate-600 dark:border-slate-700 dark:bg-slate-900/50 dark:text-slate-300">
                    <span class="size-2 rounded-full bg-emerald-500"></span>
                    {{ translate('general_information') }}
                </span>
            </div>
        </div>

        <form action="{{ route('admin.employee.update', [$employee['id']]) }}" method="post" enctype="multipart/form-data" class="space-y-6 text-left">
            @csrf
            <input type="hidden" name="id" value="{{ $employee['id'] }}">

            <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
                <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/70 px-5 py-4 dark:border-slate-700/70 dark:bg-slate-900/40 sm:px-7">
                    <span class="flex size-10 items-center justify-center rounded-xl bg-blue-100 text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">
                        <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                            <path d="M16 20v-1.5a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4V20m7.5-9a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8-5v6m-3-3h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <div>
                        <h2 class="font-semibold text-slate-900 dark:text-slate-100">{{ translate('general_information') }}</h2>
                        <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ translate('employee') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-8 p-5 sm:p-7 lg:grid-cols-2">
                    <div class="space-y-5">
                        <div>
                            <label for="name" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ translate('full_Name') }}</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                placeholder="{{ translate('ex') }} : John Doe"
                                value="{{ $employee['name'] }}"
                                required
                            >
                        </div>

                        <div>
                            <label for="phone" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ translate('phone') }}</label>
                            <input
                                type="number"
                                name="phone"
                                value="{{ $employee['phone'] }}"
                                class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                id="phone"
                                placeholder="{{ translate('ex').':'.'+88017********' }}"
                                required
                            >
                        </div>

                        <div>
                            <label for="role_id" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ translate('role') }}</label>
                            <select
                                class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                name="role_id"
                                id="role_id"
                            >
                                <option value="0" selected disabled>{{ '---'.translate('select').'---' }}</option>
                                @foreach ($adminRoles as $adminRole)
                                    <option value="{{ $adminRole->id }}" {{ $adminRole['id'] == $employee['admin_role_id'] ? 'selected' : '' }}>
                                        {{ ucfirst($adminRole->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label for="identify_type" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ translate('identify_type') }}</label>
                                <select
                                    class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                    name="identify_type"
                                    id="identify_type"
                                >
                                    <option value="" selected disabled>{{ translate('select_identify_type') }}</option>
                                    <option value="nid" {{ $employee->identify_type == 'nid' ? 'selected' : '' }}>{{ translate('NID') }}</option>
                                    <option value="passport" {{ $employee->identify_type == 'passport' ? 'selected' : '' }}>{{ translate('passport') }}</option>
                                </select>
                            </div>

                            <div>
                                <label for="identify_number" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ translate('identify_number') }}</label>
                                <input
                                    type="number"
                                    name="identify_number"
                                    value="{{ $employee->identify_number }}"
                                    class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                    placeholder="{{ translate('ex').':'.'9876123123' }}"
                                    id="identify_number"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <div class="mb-4 flex justify-center">
                                <img
                                    class="upload-img-view h-48 w-48 rounded-2xl border border-slate-200 bg-slate-50 object-cover shadow-sm dark:border-slate-700 dark:bg-slate-900/40 sm:h-56 sm:w-56"
                                    id="viewer"
                                    src="{{ getValidImage(path: 'storage/app/public/admin/'.$employee['image'], type: 'backend-profile') }}"
                                    alt=""
                                >
                            </div>
                            <label for="custom-file-upload" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                {{ translate('employee_image') }}
                                <span class="ml-1 font-normal text-blue-600 dark:text-blue-300">({{ translate('ratio').'1:1' }})</span>
                            </label>
                            <input
                                type="file"
                                name="image"
                                id="custom-file-upload"
                                class="image-input block w-full cursor-pointer rounded-xl border border-slate-200 bg-white text-sm text-slate-600 transition hover:border-blue-300 file:mr-4 file:cursor-pointer file:rounded-lg file:border-0 file:bg-slate-100 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-blue-50 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:border-blue-800 dark:file:bg-slate-800 dark:file:text-slate-200 dark:hover:file:bg-slate-700"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                data-image-id="viewer"
                            >
                        </div>

                        <div>
                            <p class="mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">{{ translate('identity_image') }}</p>
                            <div class="row select-multiple-image grid grid-cols-2 gap-3 sm:grid-cols-3">
                                @if ($employee['identify_image'])
                                    @foreach (json_decode($employee['identify_image'], true) as $img)
                                        <div class="overflow-hidden rounded-xl border border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-900/40">
                                            <img
                                                class="h-32 w-full object-cover sm:h-36"
                                                alt=""
                                                src="{{ getValidImage(path: 'storage/app/public/admin/'.$img, type: 'backend-basic') }}"
                                            >
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
                <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/70 px-5 py-4 dark:border-slate-700/70 dark:bg-slate-900/40 sm:px-7">
                    <span class="flex size-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300">
                        <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                            <rect x="4" y="5" width="16" height="14" rx="2" stroke="currentColor" stroke-width="1.7"/>
                            <path d="m5 7 7 5 7-5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <div>
                        <h2 class="font-semibold text-slate-900 dark:text-slate-100">{{ translate('account_information') }}</h2>
                        <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ translate('email') }} &amp; {{ translate('password') }}</p>
                    </div>
                </div>

                <div class="p-5 sm:p-7">
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ translate('email') }}</label>
                            <input
                                type="email"
                                name="email"
                                value="{{ $employee['email'] }}"
                                class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                id="email"
                                placeholder="{{ translate('ex').':'.'ex@gmail.com' }}"
                                required
                            >
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                {{ translate('password') }}
                                <span class="ml-1 font-normal text-slate-500 dark:text-slate-400">({{ translate('input_if_you_want_to_change') }})</span>
                            </label>
                            <input
                                type="text"
                                name="password"
                                class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                id="password"
                                placeholder="{{ translate('password') }}"
                            >
                        </div>

                        <div>
                            <label for="confirm_password" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ translate('confirm_password') }}</label>
                            <input
                                type="text"
                                name="confirm_password"
                                class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                id="confirm_password"
                                placeholder="{{ translate('confirm_password') }}"
                            >
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end border-t border-slate-100 pt-5 dark:border-slate-700/70">
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:-translate-y-0.5 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-500/25 focus:ring-offset-2 dark:focus:ring-offset-[#121d30]"
                        >
                            {{ translate('update') }}
                            <svg viewBox="0 0 20 20" fill="none" class="size-4" aria-hidden="true">
                                <path d="M4 10h12m0 0-5-5m5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </section>
        </form>

        <span
            id="get-multiple-image-data"
            data-image="{{ asset('assets/back-end/img/400x400/img2.jpg') }}"
            data-width=""
            data-group-class="col-6 col-lg-4"
            data-row-height="auto"
            data-max-count="5"
            data-field="identity_image[]"
        ></span>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/back-end/js/spartan-multi-image-picker.js') }}"></script>
    <script src="{{ asset('assets/back-end/js/select-multiple-image.js') }}"></script>
@endpush
