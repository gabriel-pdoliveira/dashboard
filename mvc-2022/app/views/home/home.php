<?php if ( ! defined('URL_BASE')) exit; 

            
?>

<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Entrada', "Saída"],
            <?php
            $pdo = new PDO('mysql:host=localhost:3306;dbname=cash_book', 'root', '');
            $query="SELECT type, date, value FROM moviment ORDER BY date";
            $consulta=$pdo->prepare($query);
            $consulta->execute();
            $estáticoIN=0;
            $estáticoOUT=0;
            
            foreach ($consulta as $mostra) {
              
              $date=$mostra['date'];
              $date=explode('-', $date);
              $valor=$mostra['value'];
              $type=$mostra['type'];
              
              if ( $type=="input") {
              ?>
                  ['<?php echo $date[0];?>', <?php echo $estáticoIN=$valor;?>, <?php echo $estáticoOUT;?>],
              <?php 
              }
              else if($type=="output"){
                  ?>
                  ['<?php echo $date[0];?>',<?php echo $estáticoIN;?>, <?php echo $estáticoOUT=$valor;?>],
                  <?php
              }
            }
            ?>
        ]);
        var options = {
          title:'Gráfico de movimentos Anual',
          curveType: 'function',
          legend: { position: 'rigth' }
        };
        var chart = new google.visualization.LineChart(document.getElementById('graficoAnual'));
        chart.draw(data, options);
      }

      

      
      </script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mounth', 'Entrada', 'Saída'],
          <?php
            $pdo = new PDO('mysql:host=localhost:3306;dbname=cash_book', 'root', '');
            $query="SELECT type, date, value FROM moviment ORDER BY date";
            $con=$pdo->prepare($query);
            $con->execute();
            $estáticoIN=0;
            $estáticoOUT=0;
          foreach ($con as $dados) {

            $date=$dados['date'];
              $date=explode('-', $date);
              $valor=$dados['value'];
              $type=$dados['type'];
              
              if ( $type=="input") {
              ?>
                  ['<?php echo $date[1];?>', <?php echo $estáticoIN=$valor;?>, <?php echo $estáticoOUT;?>],
              <?php 
              }
              else if($type=="output"){
                  ?>
                  ['<?php echo $date[1];?>',<?php echo $estáticoIN;?>, <?php echo $estáticoOUT=$valor;?>],
                  <?php
              }
            
          }?>
        ]);

        var options = {
          title: 'Grafico de Movimentos Mensais',
          curveType: 'function',
          legend: { position: 'rigth' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }

      
      </script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Entrada', 'saída'],
          <?php
            $pdo = new PDO('mysql:host=localhost:3306;dbname=cash_book', 'root', '');
            $query="SELECT type, date, value FROM moviment ORDER BY date";
            $con=$pdo->prepare($query);
            $con->execute();
            $estáticoIN=0;
            $estáticoOUT=0;
          foreach ($con as $dados) {

            $date=$dados['date'];
              $date=explode('-', $date);
              $valor=$dados['value'];
              $type=$dados['type'];
              
              if ( $type=="input") {
              ?>
                  ['<?php echo $date[2];?>', <?php echo $estáticoIN=$valor;?>, <?php echo $estáticoOUT;?>],
              <?php 
              }
              else if($type=="output"){
                  ?>
                  ['<?php echo $date[2];?>',<?php echo $estáticoIN;?>, <?php echo $estáticoOUT=$valor;?>],
                  <?php
              }
            
          }?>
        ]);

        var options = {
          title: 'Grafico de Movimentos Diarios',
          curveType: 'function',
          legend: { position: 'rigth' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('graficodiario'));

        chart.draw(data, options);
    }

      
      </script>



  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-4 txt-center">
          <div class="card text-center" style="width: 18rem; background-color: #29DB01;">
            <div class="card-body">
              <strong> <p style="font-size: 16px;">Saldo atual:</p> </strong>
                <h5 class="card-title" id="saldo">R$ </h5>
            </div>
          </div>
        </div>
        <div class="col-4 txt-center">
          <div class="card text-center" style="width: 18rem; background-color: #FF0105;">
            <div class="card-body">
            <strong> <p style="font-size: 16px;">Média de valor de saída: </p> </strong>
              <h5 class="card-title" id="mediaSaida">R$ </h5>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="card text-center" style="width: 18rem; background-color: #1567FF;">
           <div class="card-body">
           <strong> <p style="font-size: 16px;">Média de valor de entrada:</p> </strong>
            <h5 class="card-title" id="mediaEntrada">R$ </h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    

    <?php
    
    ?>

    
    <div id="graficoAnual" style="width: 1350px; height: 500px"></div>
    <br>
    <div id="curve_chart" style="width: 1350px; height: 500px"></div>
    <br>
    <div id="graficodiario" style="width: 1350px; height: 500px"></div>
  </body>
  <script>

      let saldo=0;
      let quantidadeSaida=0;
      let quantidadeEntrada=0;
      let contEntrada=0;
      let contSaida=0;
      let mediaEntrada=0;
      let mediaSaida=0;

            <?php
            foreach($data['home'] AS $home){

              $valor= $home['value'];
              $type= $home['type'];
                
                if ( $type=="input") { ?>
                    saldo+=<?php echo $valor?>;
                    quantidadeEntrada+=<?php echo $valor?>;
                    contEntrada++;


                 <?php   
                }
                else if($type=="output"){?>
                    saldo-=<?php echo $valor?>; 
                    quantidadeSaida+=<?php echo $valor?>; 
                    contSaida++;

                    
                    <?php
                }
            }
              ?>

                saldo=saldo.toFixed(2);
                mediaEntrada=quantidadeEntrada/contEntrada;
                mediaEntrada=mediaEntrada.toFixed(2);
                mediaSaida=quantidadeSaida/contSaida;
                mediaSaida=mediaSaida.toFixed(2);

              <?php

          ?>
            console.log(saldo);
            document.querySelector("#saldo").innerHTML+=saldo;
            document.querySelector("#mediaEntrada").innerHTML+=mediaEntrada;
            document.querySelector("#mediaSaida").innerHTML+=mediaSaida;
    </script>
</html>
