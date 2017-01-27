<?php

$a = array("");
print_r($a);

 ?>

 <?php
     $chars = ['h', 'm', 'l'];
     $labels = ['High', 'Med', 'Low'];

     // for ($i = 0; $i < $_SESSION['parameters']->hours; $i++)
     // {
             // $val = $_SESSION['parameters']->traffic[0];

     // foreach ($_SESSION['parameters']->traffic as $tl)
     // {
     // 	echo "<td>" . Util::printRadioButtons($labels, $chars, array($tl));
     // 	echo "</td>";
     // }

         // <td>

         // for ($j = 0; $j < sizeof($labels); $j++):
         // 	$selected = '';
         // 	if ($chars[$j] == $val) $selected = ' checked';
         // 		<input type='radio' name='traffic_levels[$i] value='$chars[$j]'$selected>$labels[$j]</input><br>";
         // 	'</td>'
     // }
 ?>
 </tr>

 <br><br>
 <div class="assistantsSelectStepOuter stepBox centerOuter">
     <div class='stepCircle'>4</div>
     <h3 id='assistants' class='whiteFont'>Who Will Assist the Engineer? <span class="hint--right hint--rounded hint--large" aria-label= "Identify any humans or technologies that will support the locomotive engineer. SHOW models their interaction by offloading certain tasks from the engineer."><sup>(?)</sup></span></h3>
     <div id="assist">
         <table id="assistantsTable" cellspacing="0">
             <tr>
                 <?php
                     $assistants = $_SESSION['parameters']->agents;
                     for ($i = 0; $i < sizeof($assistants); $i++)
                     {
                         $assistant = $assistants[$i];
                         $selected = '';
                         if ($assistant->active)
                         {
                             $selected = ' checked';
                         }
                         echo '<td><input ';
                         if ($assistant->type == 'custom') echo 'id="custom_assistant" onchange="toggle_custom_settings();"';
                         echo 'type="checkbox" name="assistants[' . $assistant->name . ']"' . $selected . '>' . ucwords($assistant->name) . ' ';
                         echo "<span class='hint--right hint--rounded hint--large' aria-label= '". $assistant->description . "'><sup>(?)</sup></span>";
                         echo '</td>';
                     }
                 ?>
             </tr>
         </table>
     </div>
 </div>
 <br>
 <div class="custom remove" id="custom_assistant_settings">
     <div class='stepCircle'>5</div>

     <h3 id='custom_heading' class='whiteFont'>Which Tasks Will This Custom Assistant Handle? <span class="hint--right hint--rounded hint--large" aria-label= "Identify which tasks the custom assistant can offload from the locomotive engineer."><sup>(?)</sup></span></h3>
     <br>
     <table id='custom_table'>
         <tr>
             <?php $op = $_SESSION['parameters']->getOperatorByType('custom')?>
             <th>Assistant Name:</td>
             <td><input type='text' name="custom_op_name" value="<?php if ($op->name != 'custom') echo ucwords($op->name); ?>"></input></td>
         </tr>
     <?php
         $i = 0;
         foreach ($_SESSION['parameters']->getOperatorByName('engineer')->tasks as $task)
         {
             echo "<tr><td>" . ucwords($task->name) . " <span class='hint--right hint--rounded hint--large' aria-label= '".  $ENGINEER_TASK_DESCRIPTIONS[$task->name] . "'>";
             // echo "<tr><td>" . ucwords($task) . " <span class='hint--right hint--rounded hint--large' aria-label= '".  $ENGINEER_TASK_DESCRIPTIONS[$task] . "'>";
             echo '<sup>(?)</sup></span></td><td>';
             echo '<input type="checkbox" name="custom_op_task_' . $i . '"';
             // echo '<input type="checkbox" name="assistants[' . $op->name . '][tasks][' . $i . ']"';
             if (in_array($i++, $op->tasks)) echo ' checked';
             echo '></input>';
             echo '</td></tr>';
         }
     ?>
     </table>
 </div>
