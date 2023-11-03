<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    @class([
            'fi min-h-screen',
            'dark' => filament()->hasDarkModeForced(),
        ])
>
<head>
    <meta charset="utf-8">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if ($favicon = filament()->getFavicon())
        <link rel="icon" href="{{ $favicon }}" />
    @endif
    <title>
        {{ filled($title = strip_tags($title)) ? "{$title} - " : null }}
        {{ filament()->getBrandName() }}
    </title>
    {{ \Filament\Support\Facades\FilamentView::renderHook('panels::styles.before') }}

    <style>
        [x-cloak=''],
        [x-cloak='x-cloak'],
        [x-cloak='1'] {
            display: none !important;
        }

        @media (max-width: 1023px) {
            [x-cloak='-lg'] {
                display: none !important;
            }
        }

        @media (min-width: 1024px) {
            [x-cloak='lg'] {
                display: none !important;
            }
        }
    </style>
    @filamentStyles
    {{ filament()->getTheme()->getHtml() }}
    {{ filament()->getFontHtml() }}
    <style>
        :root {
            --font-family: {!! filament()->getFontFamily() !!};
            --sidebar-width: {{ filament()->getSidebarWidth() }};
            --collapsed-sidebar-width: {{ filament()->getCollapsedSidebarWidth() }};
        }
    </style>
    @if (! filament()->hasDarkMode())
        <script>
            localStorage.setItem('theme', 'light')
        </script>
    @elseif (filament()->hasDarkModeForced())
        <script>
            localStorage.setItem('theme', 'dark')
        </script>
    @else
        <script>
            const theme = localStorage.getItem('theme') ?? 'system'

            if (
                theme === 'dark' ||
                (theme === 'system' &&
                    window.matchMedia('(prefers-color-scheme: dark)')
                        .matches)
            ) {
                document.documentElement.classList.add('dark')
            }
        </script>
    @endif
    @vite('resources/css/app.css')
    @vite('resources/css/career.css')
    @vite('resources/css/career-job-post.css')
</head>

<body class="fi-body min-h-screen bg-gray-50 font-normal text-gray-950 antialiased dark:bg-gray-950 dark:text-white">
{{ $slot }}
@livewire('notifications')
@filamentScripts(withCore: true)
@vite('resources/js/app.js')
@stack('scripts')
</body>
</html>
