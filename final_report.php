<?php
/****************************************************************************
*																			*
*	File:		final_report.php     										*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This file defines the final report page, which summarizes   *
*               input settings and result. It also allows the user to       * 
*               print the report.                       					*
*																			*
****************************************************************************/

//	Initialize session

    require_once('includes/php_session/init.php');

//	Include headers

    $PAGE_TITLE = "Preview Report";
    $HTML_HEADER = '<script src="http://d3js.org/d3.v3.min.js"></script>';
    $HTML_HEADER .= '<script type="text/javascript" src="scripts/d3_graph.js"></script>';
    // $HTML_HEADER .= '<script type="text/javascript" src="includes/results/PrintReport/print_page.js"></script>';
    $HTML_HEADER .= '<script type="text/javascript" src="scripts/print_page.js"></script>';
    require_once('includes/page_parts/header.php');
    require_once('includes/page_parts/side_navigation.php');
    require_once('includes/results/operator_calculations.php');
    // require_once('includes/results/operator.html');
    require_once('includes/results/graph_CsvFile.php');
    require_once('includes/results/graphTextBox/graph_navBar_static.php');

    /****************************************************************************
    *																			*
    *	Function:	createSummary												*
    *																			*
    *	Purpose:	To pull in the utilization graphs for a human operator 	    *
    *																			*
    ****************************************************************************/

    function createSummary($assistant) {

        echo "<br><br><br>";
        include('includes/results/d3_graph.php');
        createGraphCsv($assistant);
        graphTextStatic($_SESSION['session_dir'] . "stats_" . $assistant. ".csv");
    }
?>

    <div id="print-content">
        <form>
            <div id="next_page" class="printPdf" onclick="var submit = getElementById('button'); button.click()" style="cursor: pointer;">
            </div>
            <input type="button" id="button" onclick="printDiv('print-content')" value="print a div!" style='display:none;'/>
        </form>

<?php
    // require_once("operator_calculations.php");
    require_once('includes/results/operator.html');
    echo "<br><br>";
    require_once('includes/results/input_summary.php');
    // require_once('input_summary.php');

    createSummary("engineer");

    if (in_array('conductor', $_SESSION['parameters']['assistants'])) {
        createSummary("conductor");
    }

    echo "</div>";
	require_once("includes/page_parts/footer.php");
?>
