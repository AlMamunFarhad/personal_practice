@extends('layouts.back-end.app')

@section('title', translate('customer').' · '.translate('edit'))

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
                        <p class="mb-1 text-xs font-semibold uppercase tracking-[0.16em] text-blue-600 dark:text-blue-300">{{ translate('customer') }} #{{ $customer['id'] }}</p>
                        <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100 sm:text-3xl">
                            {{ translate('edit') }} {{ translate('customer') }}
                        </h1>
                    </div>
                </div>
                <a href="{{ route('admin.customer.list') }}" class="inline-flex w-fit items-center gap-2 rounded-xl border border-blue-200/80 bg-white/80 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/50 dark:text-slate-300 dark:hover:bg-slate-800">
                    <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                        <path d="M19 12H5m0 0 6 6m-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{ translate('customer_list') }}
                </a>
            </div>
        </div>

        <form action="{{ route('admin.customer.update', [$customer['id']]) }}" method="post" enctype="multipart/form-data" class="space-y-6 text-start">
            @csrf
            <input type="hidden" name="id" value="{{ $customer['id'] }}">

            <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
                <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/70 px-5 py-4 dark:border-slate-700/70 dark:bg-slate-900/40 sm:px-7">
                    <span class="flex size-10 items-center justify-center rounded-xl bg-blue-100 text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">
                        <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                            <path d="M16 20v-1.5a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4V20m7.5-9a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8-5v6m-3-3h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <div>
                        <h2 class="font-semibold text-slate-900 dark:text-slate-100">{{ translate('general_information') }}</h2>
                        <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ translate('customer') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 p-5 sm:p-7 md:grid-cols-2">
                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ translate('name') }}</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $customer['name']) }}" autocomplete="name" required
                            class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10">
                        @error('name')
                            <p class="mt-2 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ translate('phone') }}</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $customer['phone']) }}" autocomplete="tel" required
                            class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10">
                        @error('phone')
                            <p class="mt-2 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="email" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ translate('email') }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $customer['email']) }}" autocomplete="email" required
                            class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10">
                        @error('email')
                            <p class="mt-2 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="border-t border-slate-100 p-5 dark:border-slate-700/70 sm:p-7">
                    <div class="max-w-xl">
                        <label for="customer-image" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            {{ translate('customer') }} {{ translate('image') }}
                            <span class="ml-1 text-slate-400 dark:text-slate-500">({{ translate('ratio') }} 1:1)</span>
                        </label>

                        <div class="mb-4 flex justify-center sm:justify-start">
                            <img
                                id="customer-image-preview"
                                class="size-48 rounded-2xl border border-slate-200 bg-slate-50 object-cover shadow-sm dark:border-slate-700 dark:bg-slate-900/40"
                                src="{{ getValidImage(path: 'storage/app/public/profile/'.$customer->image, type: 'backend-profile') }}"
                                data-original-image="{{ getValidImage(path: 'storage/app/public/profile/'.$customer->image, type: 'backend-profile') }}"
                                alt="{{ translate('customer') }} {{ translate('image') }} {{ translate('preview') }}"
                            >
                        </div>

                        <input
                            type="file"
                            name="image"
                            id="customer-image"
                            class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-white text-sm text-slate-600 transition hover:border-blue-300 file:mr-4 file:cursor-pointer file:rounded-lg file:border-0 file:bg-slate-100 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-blue-50 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:border-blue-800 dark:file:bg-slate-800 dark:file:text-slate-200 dark:hover:file:bg-slate-700"
                            accept="image/*"
                            data-customer-image-preview
                        >
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">{{ translate('upload') }} {{ translate('image') }}</p>
                        @error('image')
                            <p class="mt-2 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
                <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/70 px-5 py-4 dark:border-slate-700/70 dark:bg-slate-900/40 sm:px-7">
                    <span class="flex size-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300">
                        <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                            <path d="M12 3 5 6v5c0 4.5 3 8.3 7 10 4-1.7 7-5.5 7-10V6l-7-3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                            <path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <div>
                        <h2 class="font-semibold text-slate-900 dark:text-slate-100">{{ translate('password') }}</h2>
                        <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ translate('password') }}</p>
                    </div>
                </div>
                <div class="p-5 sm:p-7">
                    <div class="max-w-xl">
                        <label for="password" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ translate('password') }}</label>
                        <input type="password" name="password" id="password" autocomplete="new-password"
                            class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                            placeholder="{{ translate('password_minimum_8_characters') }}">
                        @error('password')
                            <p class="mt-2 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <a href="{{ route('admin.customer.list') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-900/50 dark:text-slate-300 dark:hover:bg-slate-800 dark:focus:ring-slate-700">
                    {{ translate('cancel') }}
                </a>
                <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                    {{ translate('update') }}
                </button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        const customerImageInput = document.querySelector('[data-customer-image-preview]');
        const customerImagePreview = document.getElementById('customer-image-preview');
        let customerImagePreviewUrl;

        customerImageInput?.addEventListener('change', () => {
            const image = customerImageInput.files?.[0];

            if (!customerImagePreview) {
                return;
            }

            if (customerImagePreviewUrl) {
                URL.revokeObjectURL(customerImagePreviewUrl);
                customerImagePreviewUrl = undefined;
            }

            if (image) {
                customerImagePreviewUrl = URL.createObjectURL(image);
                customerImagePreview.src = customerImagePreviewUrl;
            } else {
                customerImagePreview.src = customerImagePreview.dataset.originalImage;
            }
        });

        window.addEventListener('pagehide', () => {
            if (customerImagePreviewUrl) {
                URL.revokeObjectURL(customerImagePreviewUrl);
            }
        });
    </script>
@endpush
