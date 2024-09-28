@extends('layouts.app')

@section('pageTitle')
    Estadisticas
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/containers.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mainDashboard.css') }}">
@endpush

@push('headerScript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
    {{-- Importar menu --}}
    <x-menu-component />

    @foreach($questions as $questionSection)
    <section class="section-container">
        <span class="section-container__title-container">
            {{ $questionSection[0]->area }}
        </span>

        @foreach($questionSection as $currentQuestion)
            @php
                $dynamicId = generateRandomId(10);
            @endphp
            <div class="classic-section__question">
                <div class="classic-section__question-title">
                    {{ $currentQuestion->question_title }}
                </div>

                @php
                    $answers = $currentQuestion->answers;
                @endphp

                <div class="classic-section__question-canvas">
                    <canvas id="{{ $dynamicId }}" class="canva"></canvas>
                </div>

                <div class="classic-section__question-counter">
                    @foreach($answers as $currentAnswer)
                        <div class="classic-section__question-counter-line">
                            <span>{{ $currentAnswer->answer_text }}: </span>{{ $currentAnswer->answers_selected_count }}
                        </div>
                    @endforeach
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function(){
                        let canvas = document.getElementById('{{ $dynamicId }}');
                        
                        if(canvas){
                            let ctx = canvas.getContext('2d');

                            let etiquetas = [];
                            let valores = [];

                            @foreach($answers as $currentAnswer)
                                etiquetas.push("{{ $currentAnswer->answer_text }}");
                                valores.push("{{ $currentAnswer->answers_selected_count }}");
                            @endforeach

                            const data = {
                                labels: etiquetas,
                                datasets: [{
                                    label: "Respuestas",
                                    data: valores
                                }]
                            };

                            let options = {
                                responsive: true,
                                maintainAspectRatio: false,
                                legend: {
                                    display: true
                                },
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                }
                            };

                            let myChart = new Chart(ctx, {
                                type: 'pie',
                                data: data,
                                options: options
                            });
                        } else {
                            console.error('No se pudo encontrar el canvas con el ID: {{ $dynamicId }}');
                        }
                    });
                </script>
            </div>
        @endforeach
    </section>
@endforeach



@endsection

@push('script')

@endpush