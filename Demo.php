<!DOCTYPE html>
<html>
<head>
  <title>Github Contribution Graph Demo</title>
  <script type="text/javascript" src="js/jquery-2.1.1.js" ></script>
  <script type="text/javascript" src="js/github_contribution.js"></script>
  <link href="css/github_contribution_graph.css" media="all" rel="stylesheet" />
  <?php
  $j = 0;
  $cntAnm[$j] = 'Urbano';
  $j = 1;
  $cntAnm[$j] = 'Roberto';
  $j = 0;
  $xntAnm[$j] = 2;
  $j = 1;
  $xntAnm[$j] = 5;
  $j = 2;
  $xntAnm[$j] = 7;
  $j = 3;
  $xntAnm[$j] = 8;
  $j = 4;
  $xntAnm[$j] = 9;

	// busca la cantidad de datos para cada usuaio
	$SQL = "SELECT count(usrid) FROM usos order by usrid,fecha";
	include("conect.php");
	$link = Conectarse();
	$p = mysql_query($SQL,$link);
	$cntPrg = 0;
	while ($fila = mysql_fetch_array($p)) { 
		$j = 0;
		$xntAnm[$j] = $fila[0];
	}
	// Debe hacer la resta de la fecha para sacar los días
	$start = date("Y-m-d");
	//$start = date ( 'Y-m-j' , $start );
	echo $start.' - Inicio<br>';	
	// busca las fechas y registros para cada usuario
	$SQL = "SELECT usoid,usrid,fecha,registros FROM usos order by usrid,fecha";
	$p = mysql_query($SQL,$link);
	$cntPrg = 0;
	$j = 0; 
	while ($fila = mysql_fetch_array($p)) {  
	    $end = $fila[2];
	    echo $end.' - fin<br>'; 
	    $diff = floor((strtotime($start)- strtotime($end))/24/3600);
	    print $dias[0][$j] = $diff;
		$j++;
	  
	}

  
  
  $dias[1][0] = 11;
  $dias[1][1] = 11;
  $dias[1][2] = 11;
  $dias[1][3] = 11;
  $dias[1][4] = 11;

  $dias[2][0] = 11;
  $dias[2][1] = 11;
  $dias[2][2] = 7;
  $dias[2][3] = 7;
  $dias[2][4] = 7; 
  $dias[2][5] = 7;
  $dias[2][6] = 17;
  
  $dias[3][0] = 11;
  $dias[3][1] = 11;
  $dias[3][2] = 11;
  $dias[3][3] = 11;
  $dias[3][4] = 11; 
  $dias[3][5] = 11;  
  $dias[3][6] = 12; 
  $dias[3][7] = 11;   

  $dias[4][0] = 11;
  $dias[4][1] = 11;
  $dias[4][2] = 11;
  $dias[4][3] = 11;
  $dias[4][4] = 11; 
  $dias[4][5] = 11;  
  $dias[4][6] = 11; 
  $dias[4][7] = 11;  
  $dias[4][8] = 11;  

  ?>
  <script type="text/javascript">
  var cntAnm = <?php echo json_encode($cntAnm);?>;
  var entries = <?php echo json_encode($xntAnm);?>; 
  var dias = <?php echo json_encode($dias);?>; 
    //Generate random number between min and max

    function getRandomTimeStamps(usr){
      var return_list = [];
      
      // cantidad de datos para cada usuario
      for ( var i =0; i < entries[usr]; i++){
        var day = new Date();
        
        //Genrate random
        var previous_date = dias[usr][i];
        day.setDate( day.getDate() - previous_date );
        
        return_list.push( day.getTime() );
      }

      return return_list;

    }
    $(document).ready(function(){
      
        
        $('#github_chart_0').github_graph( {
          //Generate random entries from 50-> 200 entries
          data: getRandomTimeStamps(0) ,
          texts: cntAnm //['completed task','completed tasks']
        });
        $('#github_chart_1').github_graph( {
          //Generate random entries from 50-> 200 entries
          data: getRandomTimeStamps(1) ,
          texts: cntAnm //['completed task','completed tasks']
        });
        $('#github_chart_2').github_graph( {
          //Generate random entries from 50-> 200 entries
          data: getRandomTimeStamps(2) ,
          texts: cntAnm //['completed task','completed tasks']
        });
        $('#github_chart_3').github_graph( {
          //Generate random entries from 50-> 200 entries
          data: getRandomTimeStamps(3) ,
          texts: cntAnm //['completed task','completed tasks']
        });
        $('#github_chart_4').github_graph( {
          //Generate random entries from 50-> 200 entries
          data: getRandomTimeStamps(4) ,
          texts: cntAnm //['completed task','completed tasks']
        });		
        
    });
  </script>
</head>
<body>
  <h2>GITHUB CONTRIBUTION GRAPH DEMO</h2>
  <div id="github_chart_0"></div>
  <div id="github_chart_1"></div>
  <div id="github_chart_2"></div>
  <div id="github_chart_3"></div>
  <div id="github_chart_4"></div>

</body>
</html>