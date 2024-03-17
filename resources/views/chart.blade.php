<x-layout>

    <div class="stackblitz-container material3">
        <div class="control-section">
            <div class="content-wrapper">
                <div id="Gantt"></div>
            </div>
        </div>
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
    @endpush
    @push('scripts')
        <script src="https://cdn.syncfusion.com/ej2/25.1.35/dist/ej2.min.js" type="text/javascript"></script>
        <script src="js/chart.js" type="text/javascript"></script>
    @endpush
</x-layout>
