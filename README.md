# show
SHOW Web Platform

This webpage allows a user to interact with the Simulator of Human Operator Workload (SHOW), developed by Duke University researchers. A user can view and change simulation settings, run the simulation, and view the results. Finally, the user has the option to print a summary report detailing the latest run's results.

Webpage Mapping

Below is a description of how the webpages are connected together. Note that all pages call init.php, header.php, and footer.php while many call side_navigation.php.  

Home (index.php)
Basic Settings (basic_settings.php)
    - basic_settings.js
    - basic_settings_send.php
Advanced Settings (adv_settings.php)
    - adv_settings.js
    - task_settings_table.php
    - adv_settings_send.php
    - set_session_vars.php
View Results (view_results.php)
    - read_csv.php
    - operator_calculations.php
    - operator.html
View Detailed Results (view_detailed_results.php)
    - graph_navBar_calculations.php
    - graph_CsvFile.php
    - d3_graph.php
Preview Report (final_report.php)
    - d3_graph.js
    - operator_calculations.php
    - graph_navBar_static.php
    - graph_CsvFile.php
    - d3_graph.php
