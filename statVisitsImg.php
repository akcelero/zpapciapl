<?php
	require_once("baseConnect.php");
	require_once("jpgraph-4.0.2/src/jpgraph.php");
	require_once("jpgraph-4.0.2/src/jpgraph_bar.php");
	$months = array('styczeń','luty','marzec','kwiecień','maj','czerwiec','lipiec','sierpień','wrzesien','pazdziernik','listopad','grudzien');
	
	// Create the graph. These two calls are always required
	$graph = new Graph(600,400,'auto');
	$graph->SetScale("textlin");
	
	$theme_class=new UniversalTheme;
	$graph->SetTheme($theme_class);
	
	$graph->yaxis->SetTickPositions(array(0,2,4,6,8,10,12,14), array(1,3,5,7,9,11,13));
	$graph->SetBox(false);
	
	$graph->ygrid->SetFill(false);

	$id = $_GET['id'];
	$year = $_GET['y'];
	$result = $con -> query("
			select Month(date) as month, count(*) as visits
			from visits where idPlace = '$id' and Year(date)='$year'
			group by Month(date)
		;");
	
	$values = array();
	$labels = array();
	while($row = $result -> fetch_assoc()){
		$values[] = $row['visits'];
		$labels[] = $months[$row['month']-1];
	}

	$graph->xaxis->SetTickLabels($labels);
	$graph->xaxis->SetLabelAngle(50);
	
	$graph->yaxis->HideLine(false);
	$graph->yaxis->HideTicks(false,false);
	
	// Create the bar plots
	$plot = new BarPlot($values);
	
	// Create the grouped bar plot
	$gbplot = new GroupBarPlot(array($plot));
	// ...and add it to the graPH
	$graph->Add($gbplot);

	$plot->SetColor("white");
	$plot->SetFillColor("#333399");
	
	$graph->title->Set("Odwiedziny w roku ".$_GET['y']);
	$graph->SetFrame(true,'black',2);

	// Display the graph
	$graph->Stroke();
?>
