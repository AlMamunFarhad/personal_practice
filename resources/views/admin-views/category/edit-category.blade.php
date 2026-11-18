@extends('layouts.back-end.app')

@section('title', translate('category').' '.translate('update'))

@section('content')
    <div class="mx-auto w-full max-w-6xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-7 overflow-hidden rounded-3xl border border-blue-100 bg-gradient-to-br from-blue-50 via-white to-indigo-50 shadow-sm dark:border-slate-700 dark:from-blue-950/30 dark:via-[#121d30] dark:to-indigo-950/30">
            <div class="flex flex-col gap-5 p-6 sm:flex-row sm:items-center sm:justify-between sm:p-8">
                <div class="flex items-center gap-4">
                    <span class="flex size-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/25">
                        <svg viewBox="0 0 24 24" fill="none" class="size-7" aria-hidden="true">
                            <path d="M4 5.5A1.5 1.5 0 0 1 5.5 4h5l9.5 9.5-6.5 6.5L4 10.5v-5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                            <path d="m14 5 5 5M4 20l4.2-.8L19 8.4a2.1 2.1 0 0 0-3-3L5.2 16.2 4 20Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <div>
                        <p class="mb-1 text-xs font-semibold uppercase tracking-[0.16em] text-blue-600 dark:text-blue-300">
                            {{ translate('category') }} #{{ $category['id'] }}
                        </p>
                        <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100 sm:text-3xl">
                            @if ($category['position'] == 1)
                                {{ translate('sub') }}
                            @elseif ($category['position'] == 2)
                                {{ translate('sub_Sub') }}
                            @endif
                            {{ translate('category') }} {{ translate('update') }}
                        </h1>
                    </div>
                </div>
                <a
                    href="{{ route('admin.category.view') }}"
                    class="inline-flex items-center justify-center gap-2 self-start rounded-xl border border-blue-200/80 bg-white/80 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/50 dark:text-slate-200 dark:hover:bg-slate-800 sm:self-auto"
                >
                    <svg viewBox="0 0 24 24" fill="none" class="size-4" aria-hidden="true">
                        <path d="m15 18-6-6 6-6M9 12h12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{ translate('back') }}
                </a>
            </div>
        </div>

        <form
            action="{{ route('admin.category.update', [$category['id']]) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6 text-left"
        >
            @csrf
            <input type="hidden" name="id" value="{{ $category['id'] }}">

            <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/10">
                <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/70 px-5 py-4 dark:border-slate-700/70 dark:bg-slate-900/40 sm:px-7">
                    <span class="flex size-10 items-center justify-center rounded-xl bg-blue-100 text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">
                        <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                            <path d="M4 5.5A1.5 1.5 0 0 1 5.5 4h5l9.5 9.5-6.5 6.5L4 10.5v-5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                            <circle cx="8" cy="8" r="1" fill="currentColor"/>
                        </svg>
                    </span>
                    <div>
                        <h2 class="font-semibold text-slate-900 dark:text-slate-100">{{ translate('general_information') }}</h2>
                        <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ translate('category') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-8 p-5 sm:p-7 lg:grid-cols-5">
                    <div class="{{ $category['parent_id'] == 0 || $category['position'] == 1 ? 'lg:col-span-3' : 'lg:col-span-5' }} space-y-6">
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
                                        {{ getLanguageName($lang) }} <span class="text-xs opacity-70">({{ strtoupper($lang) }})</span>
                                    </button>
                                @endforeach
                            </div>

                            @foreach ($languages as $languageIndex => $lang)
                                @php
                                    $categoryTranslation = $category->translations->first(
                                        fn ($translation) => $translation->locale === $lang && $translation->key === 'name',
                                    );
                                    $categoryName = $lang == $defaultLanguage
                                        ? $category['name']
                                        : ($categoryTranslation?->value ?? '');
                                @endphp
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
                                        value="{{ old('name.'.$languageIndex, $categoryName) }}"
                                        class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                        placeholder="{{ translate('new_Category') }}"
                                        @if ($lang == $defaultLanguage) required @endif
                                    >
                                </div>
                                <input type="hidden" name="lang[]" value="{{ $lang }}">
                            @endforeach
                        </div>

                        <div>
                            <label for="category-priority" class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ translate('priority') }}
                                <span class="text-rose-500">*</span>
                            </label>
                            <select
                                name="priority"
                                id="category-priority"
                                class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                required
                            >
                                @for ($index = 0; $index <= 10; $index++)
                                    <option value="{{ $index }}" {{ $category['priority'] == $index ? 'selected' : '' }}>
                                        {{ $index }}
                                    </option>
                                @endfor
                            </select>
                            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">{{ translate('the_lowest_number_will_get_the_highest_priority') }}</p>
                        </div>
                    </div>

                    <div class="{{ $category['parent_id'] == 0 || $category['position'] == 1 ? 'lg:col-span-2' : 'lg:col-span-5' }}">
                        <label for="category-image" class="mb-3 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            {{ translate('category_Logo') }}
                            <span class="ml-1 font-normal text-blue-600 dark:text-blue-300">({{ translate('ratio') }} 1:1)</span>
                        </label>
                        <div class="mb-4 flex min-h-64 items-center justify-center rounded-2xl border border-dashed border-slate-300 bg-slate-50/70 p-5 dark:border-slate-600 dark:bg-slate-900/30">
                            <img
                                id="category-image-preview"
                                class="h-56 w-56 rounded-2xl border border-slate-200 bg-white object-contain p-2 shadow-sm dark:border-slate-700 dark:bg-slate-900/40"
                                src="{{ getValidImage(path: 'storage/app/public/category/'.$category['icon'], type: 'backend-category') }}"
                                alt="{{ $category['name'] }}"
                            >
                        </div>
                        <input
                            type="file"
                            name="image"
                            id="category-image"
                            class="image-input block w-full cursor-pointer rounded-xl border border-slate-200 bg-white text-sm text-slate-600 transition hover:border-blue-300 file:mr-4 file:cursor-pointer file:rounded-lg file:border-0 file:bg-slate-100 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-blue-50 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:border-blue-800 dark:file:bg-slate-800 dark:file:text-slate-200 dark:hover:file:bg-slate-700"
                            accept="image/*"
                            data-image-id="category-image-preview"
                        >
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">{{ translate('choose_File') }}</p>
                    </div>
                </div>

                @if ($category['parent_id'] == 0 || $category['position'] == 1)
                    <div class="flex flex-wrap justify-end gap-3 border-t border-slate-100 bg-slate-50/60 px-5 py-4 dark:border-slate-700/70 dark:bg-slate-900/30 sm:px-7">
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
                            {{ translate('update') }}
                        </button>
                    </div>
                @endif
            </section>
        </form>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/back-end/js/products-management.js') }}"></script>
@endpush
