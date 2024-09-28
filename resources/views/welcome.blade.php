@extends('layouts.app')

@section('pageTitle')
    Cognitive
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

    <section class="section-container">
        <span class="section-container__title-container">
            Usuarios
        </span>








    </section>

    <section class="section-container">
        <span class="section-container__title-container">
            Estadisticas
        </span>





    </section>

    <section class="section-container">
        <span class="section-container__title-container">
            Test principal
        </span>





    </section>

    <section class="section-container">
        <span class="section-container__title-container">
            Actividades
        </span>





    </section>

    @for($i = 0; $i < 10; $i++)
        <section class="section-container">
            <span class="section-container__title-container">
                Pregunta: {{ $i }}
            </span>


            {{--<script>

                let canvas = document.getElementById('myChart');
                let ctx = canvas.getContext('2d');
    
                let etiquetas = [];
                let valores = [];
                let colores = [];
    
                // arr.push('Fourth item');
                let etiqueta = "", valor = "", color = "";
    
                @foreach ($rutas as $ruta)
                    etiqueta = "{{ $ruta->nombre }}";
                    valor = "{{ $ruta->obtenerLitrosTotales() }}";
                    color = "{{ $ruta->color }}";
                    etiquetas.push(etiqueta.toString());
                    valores.push(valor.toString());
                    colores.push(color.toString());
                @endforeach
    
                const data = {
                labels: etiquetas,
                datasets: [{
                    label: "Respuestas",
                    data: valores,
                    backgroundColor: colores
                }]
                };
    
                let options = {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                    display: false
                    }
                };
    
                let myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: data,
                    options: options
                });
    
                let canvasContainer = document.getElementById('section-container__canva-container');
    
                new ResizeObserver(function() {
                    myChart.resize();
                }).observe(canvasContainer);
            </script>--}}
        </section>
        
    @endfor


@endsection

@push('script')

@endpush