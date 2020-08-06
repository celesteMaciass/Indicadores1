<?php  

include("bd/database_connection.php");

$query = "SELECT SUBSTRING(qna_pago,1,4) AS 'year' FROM indicador GROUP BY year DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

?>  

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INDICADORES</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
    
  </head>
  <body>
    
    <div class="wrapper d-flex align-items-stretch">
      <nav id="sidebar">
      <center><a class="navbar-brand" href="#">INDICADORES</a></center>  
        <div class="p-4 pt-5">
          <a href="" class="img logo thumbnailmb-5" style="background-image: url(images/zac.png);"></a>
          <br>
          <br>
          <ul class="list-unstyled components mb-5">
            <li>
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Global</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="grafica_concepto.html">Por concepto</a>
                </li>
                <li>
                    <a href="#">Por banco</a>
                </li>
                <li>
                    <a href="#">Por género</a>
                </li>
              </ul>
            </li>
            
            <li>
              <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Por subsistema</a>
              <ul class="collapse list-unstyled" id="pageSubmenu2">
                <li>
                    <a href="#">Page 1</a>
                </li>
                <li>
                    <a href="#">Page 2</a>
                </li>
                <li>
                    <a href="#">Page 3</a>
                </li>
              </ul>
            </li> 
          </ul>

         </div>
      </nav>
      

      

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Cerrar sesión</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        
          <center><h1>INDICADORES</h1></center>
          <div>
      

                <select name="id" class="form-control" id="id" style="width: 300px; height: 35px;">
                            <option value="">Selecciona el año </option>
                            <?php
                            foreach($result as $row)
                            {
                                echo '<option value="'.$row["year"].'">'.$row["year"].'</option>';
                            }
                            ?>
                </select>
          </div>

          <br>
          <br>
          <div class="panel-body">
           
              <div id="chart_area" style="width: 900px; height: 500px;"></div>
            
          </div>
          
          
          <div class="panel-body">
            
              <div id="chart_area2" style="width: 900px; height: 500px;"></div>
              
          </div>
          
          
          
          

        <!-- <h2 class="mb-4">Sidebar #01</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </div> -->
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   

    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    
    
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback();


// peticion a la base de datos grafica 1
function load_conceptowise_data(id, title)
{
    var temp_title = title + ' '+id+'';
    $.ajax({
        url:"bd/fetch.php",
        method:"POST",
        data:{id:id},
        dataType:"JSON",
        success:function(data)
        {
            drawMonthwiseChart(data, temp_title);
        }
    });
}
// peticion a la base de datos grafica 2
function load_conceptowise2_data(id, title)
{
    var temp_title = title + ' '+id+'';
    $.ajax({
        url:"bd/nuevo_fetch.php",
        method:"POST",
        data:{id:id},
        dataType:"JSON",
        success:function(data)
        {
            drawMonthwiseChart2(data, temp_title);
        }
    });
}

// dibujar grafica 1
function drawMonthwiseChart(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Quincenas');
    data.addColumn('number', 'Importe $');
    data.addColumn({
               type: 'string',
               role: 'style'
           });


    $.each(jsonData, function(i, jsonData){
        var concepto = jsonData.concepto;
        var importe = parseFloat($.trim(jsonData.importe));
        var style = jsonData.style;
        data.addRows([[concepto, importe, style]]);
    });
   

    data.setValue(0, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(1, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(2, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(3, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(4, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(5, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(6, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(7, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    var options = {
        title:chart_main_title,
        
        hAxis: {
            title: "Quincenas"
        },
        vAxis: {
            title: 'Importe',
            format: 'currency'
        }

    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
    chart.draw(data, options);
}
// dibujar grafica 2
function drawMonthwiseChart2(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Quincenas');
    data.addColumn('number', 'Importe $');
    data.addColumn({
               type: 'string',
               role: 'style'
           });
    $.each(jsonData, function(i, jsonData){
        var concepto = jsonData.concepto;
        var importe = parseFloat($.trim(jsonData.importe));
        var style = jsonData.style;
        data.addRows([[concepto, importe, style]]);


    });
    data.setValue(0, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(1, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(2, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(3, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(4, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(5, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(6, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(7, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(8, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(9, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(10, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(11, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(12, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(13, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    data.setValue(14, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    

    var options = {
        title:chart_main_title,
        hAxis: {
            title: "Quincenas"
        },
        vAxis: {
            title: 'Importe',
            format: 'currency'
        }
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area2'));
    chart.draw(data, options);
}

</script>


<script>
    // Detectar seleccion del select option
$(document).ready(function(){

    $('#id').change(function(){
        var id = $(this).val();
        if(id != '')
        {
            load_conceptowise_data(id, 'Importe Por Cada Mes, Quincenas del: ');
            load_conceptowise2_data(id, 'Importe Por Cada Quincena, Quincenas del: ');
        }
    });

});

</script>