@extends('layouts.back-end.app')

@section('title', translate('category_Setup'))

@section('content')
    <div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-7 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="flex size-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300">
                    <svg viewBox="0 0 24 24" fill="none" class="size-6" aria-hidden="true">
                        <path d="M4 5.5A1.5 1.5 0 0 1 5.5 4h5l9.5 9.5-6.5 6.5L4 10.5v-5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                        <circle cx="8" cy="8" r="1" fill="currentColor"/>
                    </svg>
                </span>
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ translate('category') }}</p>
                    <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">
                        {{ translate('category_Setup') }}
                    </h1>
                </div>
            </div>
            <a href="#category-list" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-200 dark:hover:bg-slate-800">
                <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                    <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                {{ translate('category_list') }}
            </a>
        </div>

        <section class="mb-7 overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
            <div class="border-b border-slate-100 bg-slate-50/70 px-5 py-5 dark:border-slate-700/70 dark:bg-slate-900/40 sm:px-7">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">{{ translate('category_Setup') }}</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ translate('category_Name') }} · {{ translate('category_Logo') }}</p>
            </div>

            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data" class="p-5 sm:p-7">
                @csrf
                <div class="grid grid-cols-1 gap-7 lg:grid-cols-5">
                    <div class="space-y-6 lg:col-span-3">
                        <div>
                            <p class="mb-3 text-sm font-semibold text-slate-800 dark:text-slate-200">{{ translate('category_Name') }}</p>
                            <div class="flex flex-wrap gap-2 border-b border-slate-200 pb-3 dark:border-slate-700" role="tablist" aria-label="{{ translate('category_Name') }}">
                                @foreach ($languages as $lang)
                                    <button
                                        type="button"
                                        class="form-system-language-tab rounded-lg border px-3 py-2 text-sm font-medium capitalize transition focus:outline-none focus:ring-4 focus:ring-blue-500/10 {{ $lang == $defaultLanguage ? 'active border-blue-600 bg-blue-50 text-blue-700 dark:border-blue-400 dark:bg-blue-500/10 dark:text-blue-300' : 'border-transparent text-slate-600 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-800' }}"
                                        id="{{ $lang }}-link"
                                        role="tab"
                                        aria-selected="{{ $lang == $defaultLanguage ? 'true' : 'false' }}"
                                        aria-controls="{{ $lang }}-form"
                                    >
                                        {{ ucfirst(getLanguageName($lang)) }} <span class="text-xs opacity-70">({{ strtoupper($lang) }})</span>
                                    </button>
                                @endforeach
                            </div>

                            @foreach ($languages as $lang)
                                <div
                                    class="form-system-language-form mt-4 {{ $lang != $defaultLanguage ? 'hidden' : '' }}"
                                    id="{{ $lang }}-form"
                                    role="tabpanel"
                                    aria-labelledby="{{ $lang }}-link"
                                    @if ($lang != $defaultLanguage) hidden @endif
                                >
                                    <label for="category-name-{{ $lang }}" class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                        {{ translate('category_Name') }}
                                        <span class="text-rose-500">*</span>
                                        <span class="text-xs text-slate-500 dark:text-slate-400">({{ strtoupper($lang) }})</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="name[]"
                                        id="category-name-{{ $lang }}"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                        placeholder="{{ translate('new_Category') }}"
                                        @if ($lang == $defaultLanguage) required @endif
                                    >
                                </div>
                                <input type="hidden" name="lang[]" value="{{ $lang }}">
                            @endforeach
                            <input type="hidden" name="position" value="0">
                        </div>

                        <div>
                            <label for="category-priority" class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ translate('priority') }}
                                <span class="text-rose-500">*</span>
                            </label>
                            <select
                                name="priority"
                                id="category-priority"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                required
                            >
                                <option value="" disabled selected>{{ translate('set_Priority') }}</option>
                                @for ($i = 0; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                                {{ translate('the_lowest_number_will_get_the_highest_priority') }}
                            </p>
                        </div>

                        <div>
                            <label for="category-image" class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ translate('category_Logo') }}
                                <span class="text-rose-500">*</span>
                            </label>
                            <input
                                type="file"
                                name="image"
                                id="category-image"
                                class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-white text-sm text-slate-600 file:me-4 file:cursor-pointer file:border-0 file:bg-blue-50 file:px-4 file:py-3 file:font-semibold file:text-blue-700 hover:file:bg-blue-100 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-300 dark:file:bg-blue-500/15 dark:file:text-blue-300 dark:hover:file:bg-blue-500/25"
                                data-image-preview
                                accept="image/*"
                                required
                            >
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <p class="mb-3 text-sm font-semibold text-slate-800 dark:text-slate-200">{{ translate('category_Logo') }}</p>
                        <div class="flex min-h-64 items-center justify-center rounded-2xl border border-dashed border-slate-300 bg-slate-50/70 p-6 dark:border-slate-600 dark:bg-slate-900/30">
                            <img
                                id="category-image-preview"
                                class="max-h-56 w-full max-w-56 rounded-2xl object-contain"
                                src="{{ asset('assets/back-end/img/image-place-holder.png') }}"
                                alt="{{ translate('category_Logo') }}"
                                hidden
                            >
                            <div id="category-image-placeholder" class="flex h-56 w-full max-w-56 items-center justify-center rounded-2xl border border-dashed border-slate-300 text-slate-400 dark:border-slate-600 dark:text-slate-500">
                                <svg viewBox="0 0 24 24" fill="none" class="size-12" aria-hidden="true">
                                    <path d="M4 5.5A1.5 1.5 0 0 1 5.5 4h13A1.5 1.5 0 0 1 20 5.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 18.5v-13Z" stroke="currentColor" stroke-width="1.5"/>
                                    <circle cx="9" cy="9" r="1.5" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="m5 17 4-4 3 3 2-2 5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-3 text-center text-xs text-slate-500 dark:text-slate-400">{{ translate('choose_File') }}</p>
                    </div>
                </div>

                <div class="mt-7 flex flex-wrap justify-end gap-3 border-t border-slate-100 pt-5 dark:border-slate-700/70">
                    <button
                        type="reset"
                        class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-200 dark:hover:bg-slate-800"
                    >
                        {{ translate('reset') }}
                    </button>
                    <button
                        type="submit"
                        class="rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                    >
                        {{ translate('submit') }}
                    </button>
                </div>
            </form>
        </section>

        <section id="category-list" class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
            <div class="flex flex-col gap-5 border-b border-slate-100 bg-slate-50/70 px-5 py-5 dark:border-slate-700/70 dark:bg-slate-900/40 sm:px-7 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-center gap-3">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">{{ translate('category_list') }}</h2>
                    <span class="rounded-full bg-slate-200 px-2.5 py-1 text-xs font-semibold text-slate-700 dark:bg-slate-700 dark:text-slate-200">{{ $categories->total() }}</span>
                </div>

                <form action="{{ url()->current() }}" method="GET" class="flex w-full gap-2 sm:max-w-md">
                    <label for="category-search" class="sr-only">{{ translate('search_here') }}</label>
                    <input
                        id="category-search"
                        type="search"
                        name="searchValue"
                        class="min-w-0 flex-1 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                        placeholder="{{ translate('search_here') }}"
                        value="{{ request('searchValue') }}"
                    >
                    <button type="submit" class="rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                        {{ translate('search') }}
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700/70">
                    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:bg-slate-900/40 dark:text-slate-400">
                        <tr>
                            <th scope="col" class="whitespace-nowrap px-5 py-4 text-start">{{ translate('ID') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4 text-center">{{ translate('category_Image') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4 text-start">{{ translate('name') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4 text-start">{{ translate('priority') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4 text-center">{{ translate('home_category_status') }}</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-4 text-center">{{ translate('action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 dark:divide-slate-700/70 dark:text-slate-300">
                        @forelse ($categories as $category)
                            <tr class="transition hover:bg-slate-50/80 dark:hover:bg-slate-800/40">
                                <td class="whitespace-nowrap px-5 py-4 text-slate-500 dark:text-slate-400">{{ $category['id'] }}</td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    <div class="mx-auto flex size-12 items-center justify-center overflow-hidden rounded-xl border border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-900/40">
                                        <img
                                            class="size-full object-contain p-1"
                                            alt="{{ $category['defaultname'] }}"
                                            src="{{ getValidImage(path: 'storage/app/public/category/'.$category['icon'], type: 'backend-category') }}"
                                        >
                                    </div>
                                </td>
                                <td class="min-w-48 px-5 py-4 font-medium text-slate-900 dark:text-slate-100">{{ $category['defaultname'] }}</td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    <span class="inline-flex min-w-9 items-center justify-center rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">
                                        {{ $category['priority'] }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-center">
                                    <form action="{{ route('admin.category.status') }}" method="post" id="category-status{{ $category['id'] }}-form">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $category['id'] }}">
                                        <label class="relative inline-flex cursor-pointer items-center">
                                            <input
                                                type="checkbox"
                                                class="swal-status-toggle peer sr-only"
                                                name="home_status"
                                                id="category-status{{ $category['id'] }}"
                                                value="1"
                                                {{ $category['home_status'] == 1 ? 'checked' : '' }}
                                                data-current-status="{{ $category['home_status'] ? '1' : '0' }}"
                                                data-on-title="{{ translate('Want_to_Turn_ON').' '.$category['defaultname'].' '.translate('status') }}"
                                                data-off-title="{{ translate('Want_to_Turn_OFF').' '.$category['defaultname'].' '.translate('status') }}"
                                                data-on-message="{{ translate('if_enabled_this_category_it_will_be_visible_from_the_category_wise_product_section_in_the_website_and_customer_app_in_the_homepage') }}"
                                                data-off-message="{{ translate('if_disabled_this_category_it_will_be_hidden_from_the_category_wise_product_section_in_the_website_and_customer_app_in_the_homepage') }}"
                                                data-confirm-button="{{ translate('confirm') }}"
                                                data-cancel-button="{{ translate('cancel') }}"
                                                data-error-title="{{ translate('error') }}"
                                                data-error-message="{{ translate('something_went_wrong') }}"
                                                data-success-message="{{ translate('update_successfully') }}"
                                            >
                                            <span class="relative h-6 w-11 rounded-full bg-slate-300 transition peer-checked:bg-blue-600 peer-focus-visible:ring-4 peer-focus-visible:ring-blue-500/20 after:absolute after:left-0.5 after:top-0.5 after:size-5 after:rounded-full after:bg-white after:shadow after:transition-transform after:content-[''] peer-checked:after:translate-x-5 dark:bg-slate-600 dark:peer-checked:bg-blue-500"></span>
                                        </label>
                                    </form>
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a
                                            class="inline-flex size-9 items-center justify-center rounded-lg border border-blue-200 text-blue-700 transition hover:bg-blue-50 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-blue-900/70 dark:text-blue-300 dark:hover:bg-blue-500/10"
                                            title="{{ translate('edit') }}"
                                            aria-label="{{ translate('edit') }}"
                                            href="{{ route('admin.category.update', [$category['id']]) }}"
                                        >
                                            <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                                                <path d="m14 5 5 5M4 20l4.2-.8L19 8.4a2.1 2.1 0 0 0-3-3L5.2 16.2 4 20Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        <form
                                        action="{{ route('admin.category.delete', ['id' => $category['id']]) }}"
                                                method="POST"
                                                id="category-delete-form-{{ $category['id'] }}"
                                            >
                                        <button
                                            type="button"
                                            class="inline-flex size-9 items-center justify-center rounded-lg border border-rose-200 text-rose-600 transition hover:bg-rose-50 focus:outline-none focus:ring-4 focus:ring-rose-500/10 dark:border-rose-500/30 dark:text-rose-300 dark:hover:bg-rose-500/10 category-delete-button"
                                            title="{{ translate('delete') }}"
                                            aria-label="{{ translate('delete') }}"
                                            id="{{ $category['id'] }}"
                                        >
                                            <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                                                <path d="M4 7h16m-10 4v6m4-6v6M6 7l1 14h10l1-14M9 7V4h6v3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                        </form>
                                    </div>
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
                                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ translate('no_data_found') }}</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end border-t border-slate-100 px-5 py-4 dark:border-slate-700/70 sm:px-7">
                {{ $categories->links() }}
            </div>
        </section>
    </div>

    <span id="route-admin-category-delete" data-url="{{ route('admin.category.delete') }}"></span>
    <span id="message-yes-word" data-text="{{ translate('yes') }}"></span>
    <span id="message-cancel-word" data-text="{{ translate('cancel') }}"></span>
    <span id="message-are-you-sure-delete-this" data-text="{{ translate('Are_you_sure_to_delete_this') }}"></span>
    <span id="message-you-will-not-be-able-to-revert-this" data-text="{{ translate('you_will_not_be_able_to_revert_this') }}"></span>
@endsection

@push('script')
    <script src="{{ asset('assets/back-end/js/products-management.js') }}"></script>
    <script>
        const categoryImageInput = document.querySelector('[data-image-preview]');
        const categoryImagePreview = document.getElementById('category-image-preview');
        const categoryImagePlaceholder = document.getElementById('category-image-placeholder');
        let categoryImagePreviewUrl;

        categoryImageInput?.addEventListener('change', () => {
            const image = categoryImageInput.files?.[0];

            if (!image || !categoryImagePreview || !categoryImagePlaceholder) {
                return;
            }

            if (categoryImagePreviewUrl) {
                URL.revokeObjectURL(categoryImagePreviewUrl);
            }

            categoryImagePreviewUrl = URL.createObjectURL(image);
            categoryImagePreview.src = categoryImagePreviewUrl;
            categoryImagePreview.hidden = false;
            categoryImagePlaceholder.hidden = true;
        });
    </script>
@endpush
