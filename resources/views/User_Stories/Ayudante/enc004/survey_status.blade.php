@extends('layouts.base')
@section('contenido')
<!-- Chart's container -->
<label for="chart"> Graficos por pregunta </label>
    <br>
<form action=""> 
    
</form>

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

