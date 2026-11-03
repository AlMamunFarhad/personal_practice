@extends('layouts.admin')

@section('admin-head')
    <meta name="_token" content="{{ csrf_token() }}">

    @php
        $companyFavIcon = getWebConfig(name: 'company_fav_icon');
    @endphp

    @if (is_string($companyFavIcon) && $companyFavIcon !== '')
        <link rel="shortcut icon" href="{{ asset('storage/company/'.$companyFavIcon) }}">
    @endif
@endsection


@section('admin-runtime')
    @if ($errors->any())
        <div
            class="fixed right-4 top-4 z-[100] w-[min(24rem,calc(100vw-2rem))] space-y-3"
            aria-live="polite"
        >
            <div
                class="space-y-1 rounded-xl border border-rose-200 bg-white p-4 text-sm text-rose-800 shadow-lg dark:border-rose-900/70 dark:bg-[#121d30] dark:text-rose-300"
                role="alert"
            >
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif
        {{-- <script>
        'use strict'
        setInterval(function() {
            $.get({
                url: '{{ route('vendor.get-order-data') }}',
                dataType: 'json',
                success: function(response) {
                    let data = response.data;
                    if (data.new_order > 0) {
                        playAudio();
                        $('#popup-modal').appendTo("body").modal('show');
                    }
                },
            });
        }, 10000);
        </script> --}}

@endsection


