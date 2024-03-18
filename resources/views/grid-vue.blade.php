<x-layout>
    <div id="app">
        <example-component></example-component>
    </div>

    @push('styles')
        <link href="https://cdn.syncfusion.com/ej2/25.1.35/material.css" rel="stylesheet">
        <style>
            body {
                touch-action: none;
            }
            .control-section {
                margin-top: 100px;
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endpush
    @push('scripts')
    @endpush
</x-layout>
