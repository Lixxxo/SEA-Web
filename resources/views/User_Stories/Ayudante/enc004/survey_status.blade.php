@extends('layouts.base')
@section('contenido')
<!-- Chart's container -->
    <div>
        <a href="/dashboard">Menu Principal</a>
    </div>
    @for ($i = 0; $i < count($questions); $i++)
        <a> {{$questions[$i]->frase }} </a>
    @endfor
    <br>
    <label for="chart"> Graficos por pregunta </label>
        <br> 
        
        <br>
    <div id="chart" style="height: 300px;"></div> 
@endsection

@section('script')
<!-- Charting library -->
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
<!-- Your application script -->
<script>
    const chart = new Chartisan({
    el: '#chart',
    url: "@chart('survey_chart')",
    hooks: new ChartisanHooks()
            .colors(['#4299E1','#FE0045','#C07EF1','#67C560','#ECC94B'])
            .datasets('pie')
            .axis(false)
            .tooltip()
    });
</script>
@endsection

