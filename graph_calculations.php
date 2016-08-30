<?php
	
	function graphText($fname){
		session_start();
		$traffic=array();
		if(isset($_SESSION['traffic_time'])){
			$time=$_SESSION['traffic_time'];
			for($i=0;$i<$time;$i++){
				$traffic[$i]=$_SESSION['traffic_level'.$i];
			}
		}
		
		
		
		$type_names=array();
		$type_names[0]="Communicating";
		$type_names[1]="Exception Handling";
		$type_names[2]="Paperwork";
		$type_names[3]="Maintenance of Way";
		$type_names[4]="Temporary Speed Restrictions";
		$type_names[5]="Signal Response Management";
		$type_names[6]="Monitoring Inside";
		$type_names[7]="Monitoring Outside";
		$type_names[8]="Planning Ahead";

		$file_handle=fopen($fname,'r');
		$count=array();
		$temp_count=0;
		$skip=1;
		$num=0;

		while (! feof($file_handle))
		{
			if($temp_count==1)
			{
				$skip=1;
			}

			$line_of_text = fgetcsv($file_handle,2048,',');

			if($line_of_text[0]=="Service Time")
			{
				break;
			}

			if($skip==1)
			{
				$num=count($line_of_text);
				$count[$temp_count]=array();
				for($i=1;$i<$num;$i++)
				{
					if($temp_count==0)
					{
						$count[$temp_count][$i-1]=$line_of_text[$i];
					}
					else
					{
						$count[$temp_count][$i-1]=(float)$line_of_text[$i];
					}

				}
				$skip=0;
				$temp_count++;
				continue;
			}

			if($skip==0)
			{
				$skip=1;
				continue;
			}
		}

		fclose($file_handle);

		$type_byPhase1=array();
		$type_byPhase2=array();
		$type_byPhase3=array();
		$type_byPhase=array();

		for($j=1;$j<$temp_count-1;$j++)
		{
			$type_byPhase1[$j]=array();
			$type_byPhase2[$j]=array();
			$type_byPhase3[$j]=array();
			$type_byPhase[$j]=array();

			for($i=2;$i<$num;$i++)
			{
				if($i<5)
				{
					/* $type_byPhase1[$j][]=$count[$j][$i]; */
					array_push($type_byPhase1[$j], $count[$j][$i]);
					array_push($type_byPhase[$j], $count[$j][$i]);
				}
				else
				{
					if($i>($num-4))
					{
						array_push($type_byPhase3[$j], $count[$j][$i]);
						array_push($type_byPhase[$j], $count[$j][$i]);
					}
					else
					{
						array_push($type_byPhase2[$j], $count[$j][$i]);
						array_push($type_byPhase[$j], $count[$j][$i]);
					}
				}
			}
		}

		$count_type_high1=array();
		$count_type_high2=array();
		$count_type_high3=array();
		$count_type_low1=array();
		$count_type_low2=array();
		$count_type_low3=array();

		$count_type_low=array();
		$count_type_high=array();
		
		$length=$num-2;
		
		$length_phase1=3;
		$length_phase2=$length-6;
		$length_phase3=3;
		
		

		for($j=1;$j<$temp_count-1;$j++)
		{
			$count_type_high1[$j]=0;
			$count_type_low1[$j]=0;
			$count_type_high2[$j]=0;
			$count_type_low2[$j]=0;
			$count_type_high3[$j]=0;
			$count_type_low3[$j]=0;
			$count_type_high[$j]=0;
			$count_type_low[$j]=0;
		}

		for($i=2;$i<$num;$i++)
		{
			for($j=1;$j<$temp_count-1;$j++)
			{
				if($count[10][$i]>0.7)
				{
					if($i<5)
					{
						if($count[$j][$i]>(array_sum($type_byPhase1[$j])/count($type_byPhase1[$j])))
						{
							$count_type_high1[$j]++;
							$count_type_high[$j]++;
						}
					}
					else
					{
						if($i>($num-4))
						{
							if($count[$j][$i]>(array_sum($type_byPhase3[$j])/count($type_byPhase3[$j])))
							{
								$count_type_high3[$j]++;
								$count_type_high[$j]++;
							}
						}
						else
						{
							if($count[$j][$i]>(array_sum($type_byPhase2[$j])/count($type_byPhase2[$j])))
							{
								$count_type_high2[$j]++;
								$count_type_high[$j]++;
							}
						}
					}
					continue;
				}

				if($count[10][$i]<0.3)
				{
					if($i<5)
					{
						if($count[$j][$i]<(array_sum($type_byPhase1[$j])/count($type_byPhase1[$j])))
						{
							$count_type_low1[$j]++;
							$count_type_low[$j]++;
						}
					}
					else
					{
						if($i>($num-4))
						{
							if($count[$j][$i]<(array_sum($type_byPhase3[$j])/count($type_byPhase3[$j])))
							{
								$count_type_low3[$j]++;
								$count_type_low[$j]++;
							}
						}
						else
						{
							if($count[$j][$i]<(array_sum($type_byPhase2[$j])/count($type_byPhase2[$j])))
							{
								$count_type_low2[$j]++;
								$count_type_low[$j]++;
							}
						}
					}
					continue;
				}
			}
		}

		arsort($count_type_low);
		arsort($count_type_high);
		
		
		
		$count_ops=0;
		for($i=1;$i<5;$i++)
		{
			if(isset($_SESSION['operator'.$i]))
				{
					if($_SESSION['operator'.$i]==1){
						$count_ops++;
					}
				}
				
		}
		
		$penalty_high=0;
		$count_high=0;
		$count_low=0;
		$count_norm=0;
		for($i=2;$i<$num;$i++)
		{
			if($count[10][$i]>0.7)
			{
				$penalty_high=$penalty_high+(3.33*$count[10][$i]-2.33);
				$count_high++;
				
			}
			else{
				if($count[10][$i]<0.3){
					$count_low++;
				}
				else{$count_norm++;}
			}
			
		}
		
		$penalty_high=$penalty_high/$count_high;
		
		
		if ($fname=='sessions/Engineer_stats.csv'){
			$user_name='engineer';
		}
		else{
			$user_name='conductor';
		}
		require_once("graph_nav.php");
		require_once("graph_when.php");
		require_once("graph_how.php");
		require_once("graph_why.php");
		
		
		
	}
	
	
	
?>