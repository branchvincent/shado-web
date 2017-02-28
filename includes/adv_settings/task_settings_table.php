<?php

/****************************************************************************
*																			*
*	File:	    task_settings_table.php										*
*																			*
*	Purpose:	To define the advanced settings table for a given task type *
*																			*
****************************************************************************/

    $service_time_tip = "How long does it typically take a human operator to complete this task?" . str_repeat(' &nbsp ', 82) . "Exponential: Specify the mean service time. For this distribution, the probability of each time occuring decreases exponentially as the time increases." . str_repeat(' &nbsp ', 62) . "Lognormal: Specify the mean and standard deviation of the service time. For this distribution, the logarithm of each time forms a normal distribution. This results in a skewed distribution with many small values and fewer large values. Therefore, the mean is usually greater than the mode." . str_repeat(' &nbsp ', 52) . "Uniform: Specify the minimum and maximum service time. For this distribution, any time within the bounds has an equally likely chance of occurring.";

    // if ($task->name == "new") {
    //     $task = new ;
    // }
    // else {
    //     $taskName = $task;
    //     $taskArr = $_SESSION['tasks'][$task];
    // }
    $name = $task->name;
?>
<table align="center" style="margin-top: 10px; margin-bottom: 10px;">
    <caption><h3>
        <span style="float: left; color: #f44336; font-weight: bold;">
            <button class="roundButton" type="button" onclick=<?php echo "deleteTask(".$taskNum.")"; ?> style="background-color: #f44336;"><strong>x</strong></button> Delete
        </span>
        <span style="margin-left: -90px;">
            <?php echo ucwords($task->name);?>
        </span>
        </h3>
    </caption>
    <tr>
        <th>Task Parameter</th>
        <th>Phase 1 <span class="hint--right hint--rounded hint--large" aria-label= "The startup phase is generally the first 30 minutes of any shift in which the operators are preparing for the trip while in the vicinity of a station. By regulatory requirement, it includes tasks like communicating with dispatch and testing the emergency braking system."><sup>(?)</sup></span></th>
        <th>Phase 2 <span class="hint--right hint--rounded hint--large" aria-label= "The full motion phase begins once the train has passed its braking tests from the startup phase. The engineer operates the locomotive beyond the station and into the mainline following speed allowances from the physical characteristics of the region and responding to signals of the rail system."><sup>(?)</sup></span></th>
        <th>Phase 3 <span class="hint--right hint--rounded hint--large" aria-label= "The yard phase is the final 30 minutes of the shift. It is important to distinguish this final phase as reports from the FRA show that the highest rates of accidents occur on yard track."><sup>(?)</sup></span></th>
    </tr>
    <tr>
        <td>Name:</td>
        <td colspan="3"><input type="text" name=<?php echo "tasks[$name][name]";?> size="30" maxlength="30" value="<?php echo ucwords($task->name);?>"></td>
    </tr>
    <tr>
    <td>
        Priority
		<span class="hint--right hint--rounded hint--large" aria-label= "What is the priority level of this task, relative to the others?"><sup>(?)</sup></span>
    </td>
        <?php
            $labels = ["Not a", "Low", "Somewhat", "Neutral", "Moderate", "High", "Essential"];
            for ($i = 0; $i < 3; $i++) {
                echo "<td align='center'><select name='tasks[$name][priority][$i]'>";
                for ($j = 6; $j >= 0; $j--) {
                    $selected = '';
                    if ($task->priority[$i] == $j) $selected = ' selected="selected"';
                    echo "<option value='$j'$selected>$labels[$j] Priority </option>";
                }
                echo '</select></td>';
            }
        ?>
  </tr>
    <tr>
        <td>
            Mean Arrival Time
            <span class="hint--right hint--rounded hint--large" aria-label= "What is the average arrival rate for this (exponentially distributed) task?"><sup>(?)</sup></span>
        </td>
        <?php
            for ($i = 0; $i < 3; $i++) {
                $arrival = $task->interarrival['vals'][$i];
                if ($arrival != 0) $arrival = round(1/$arrival, 2);
                echo "<td align='center'>Once every <input type='text' name='tasks[$name][interarrival][vals][$i]' size='4' maxlength='4' ";
                echo "value='$arrival'> mins</td>";
            }
        ?>
    </tr>
    <tr>
        <td>
            Service Time:
            <span class="hint--right hint--rounded hint--large" aria-label='<?php echo $service_time_tip; ?>'><sup>(?)</sup></span>
        </td>
        <td colspan="3">Distribution:
            <?php
                $dist_char = ["E", "L", "U"];
                $dist_name = ["Exponential", "Lognormal", "Uniform"];
                echo "<select id='t$taskNum" . "_serTimeDist' name='tasks[$name][service][type]'";
                echo "style='margin-right: 10px' onchange='updateSerDist($taskNum)'>";
                for ($i = 0; $i < 3; $i++) {
                    $selected = '';
                    if ($task->service['type'] == $dist_char[$i])
                        $selected = ' selected="selected"';
                    echo "<option value='$dist_char[$i]'$selected>$dist_name[$i]</option>";
                }
                echo '</select>' . str_repeat(' &nbsp ', 2);

                $dist_string = ["exp", "log", "uni"];
                for ($i = 0; $i < 3; $i++) {

                    $style = 'none';
                    if ($task->service['type'] == $dist_char[$i])
                        $style = 'inline-block';
                    echo "<div id='t$taskNum" . "_$dist_string[$i]Pms' style='display: $style;'>";
                    if ($i == 0) {
                        $param = $task->service['vals'][0];
                        if ($param != 0) $param = round(1/$param, 2);
                        echo "Mean: <input type='text' name='tasks[$name][service][vals][$dist_string[$i]][0]'";
                        echo 'size="4" maxlength="4" value="' . $param . '"';
                        echo '> min</div>';
                    } else if ($i == 1) {
                        echo "Mean: <input type='text' name='tasks[$name][service][vals][$dist_string[$i]][0]'";
                        echo 'size="4" maxlength="4" value="' . round($task->service['vals'][0], 2) . '"';
                        echo '> min ' . str_repeat(' &nbsp ', 2);
                        echo "Std dev:<input type='text' name='tasks[$name][service][vals][$dist_string[$i]][1]'";
                        echo 'size="4" maxlength="4" value="' . round($task->service['vals'][1], 2) . '"';
                        echo '> min</div>';
                    } else {
                        echo "Min: <input type='text' name='tasks[$name][service][vals][$dist_string[$i]][0]'";
                        echo 'size="4" maxlength="4" value="' . round($task->service['vals'][0], 2) . '"';
                        echo '> min ' . str_repeat(' &nbsp ', 2) ;
                        echo "Max: <input type='text' name='tasks[$name][service][vals][$dist_string[$i]][1]'";
                        echo 'size="4" maxlength="4" value="' . round($task->service['vals'][1], 2) . '"';
                        echo '> min</div>';
                    }
                }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            Affected by Traffic Levels
            <span class="hint--right hint--rounded hint--large" aria-label= "Is the arrival of this task affected by lower/higher levels of traffic?"><sup>(?)</sup></span>
        </td>
        <?php
            $options = ["No", "Yes"];
            for ($i = 0; $i < 3; $i++) {
                echo '<td align="center"><select name="tasks[' . $taskNum . '][traffic][' . $i . ']">';
                for ($j = 1; $j >= 0; $j--) {
                    $selected = '';
                    if ($task->traffic[$i] == $j)
                        $selected = ' selected="selected"';
                    echo "<option value='$j'$selected>$options[$j]</option>";
                }
                echo '</select></td>';
            }
        ?>
    </tr>
    <!-- <tr>
        <td>Associated Assistants:</td>
        <td colspan="3">
            <?php
                $i = 0;
                foreach ($_SESSION['parameters']->agents as $agt) {
                    $checked = '';
                     if (in_array($taskNum, $agt->tasks)) $checked = ' checked';
                    echo "<input type='checkbox' name='tasks[$name][operators][$i]' value='on' style='margin-left: 10px;'$checked>";
                    if ($agt == 'custom')
                        echo ucwords($_SESSION['assistants']['custom']['name']) . " ";
                    else
                        echo ucwords($agt->name);
                    $i++;
                }
            ?>
        </td>
    </tr> -->
</table>
