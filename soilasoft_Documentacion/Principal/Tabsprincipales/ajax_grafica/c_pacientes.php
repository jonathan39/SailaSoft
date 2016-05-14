
        <link rel="stylesheet" href="/soilasoft/Principal/chart/samples/style.css" type="text/css">
        <script src="/soilasoft/Principal/chart/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="/soilasoft/Principal/chart/amcharts/pie.js" type="text/javascript"></script>

        <script>
            var chart;
            var legend;
        <?php
        include_once('../conexion/conexion.php');
            
        $conexionSacadatos = new Conexion();
        $mysqli = $conexionSacadatos->con();
            
         $consulta = "SELECT  exp_paciente.nombre, COUNT(consulta.idconsulta) as total FROM exp_paciente, consulta WHERE exp_paciente.matricula_idpaciente=consulta.matricula_idpaciente GROUP BY exp_paciente.nombre";
        $resultado = $mysqli->query($consulta);

        $prefix = '';
echo "var chartData =[\n";
while ( $fila = $resultado->fetch_row() ) {
  echo $prefix . " {\n";
  echo '  "country": "' . $fila[0] . '",' . "\n";
  echo '  "litres": ' . $fila[1] . ',' . "\n";
  echo " }";
  $prefix = ",\n";
}
echo "\n];";

?>
            


            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = "country";
                chart.valueField = "litres";
                chart.outlineColor = "#FFFFFF";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;

                // WRITE
                chart.write("chartdiv");
            });
        </script>
    