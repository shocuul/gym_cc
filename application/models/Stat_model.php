<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Stat_model extends My_Model
{

	public function dropdown_date_range(){
		$range = $this->get_date_range();
		$result = array();
		$len = count($range);
		foreach($range as $index => $date){
			$result['options'][$index] = ''.$date['min'].' - '.$date['max'];
			if($index == $len -1 ){
				$result['select'] = $index;
			}
		}
		return $result;
	}

	public function charts_data($array_key){
		$range = $this->get_date_range();
		$min = $range[$array_key]['min'];
		$max = $range[$array_key]['max'];
		$between_days = array();
		$chartData = array();
		$initial = $min;
		do{
			$between_days[] = $initial;
			$initial = date('Y-m-j',strtotime('+1 days',strtotime($initial)));
			
		}while($initial <= $max);
		if(count($between_days) != 7){
			$between_days = array();
			$initial = $min;
			for($i = 1; $i <= 7; $i++)
			{
				$between_days[] = $initial;
				$initial = date('Y-m-j',strtotime('+1 days',strtotime($initial)));
			} 
		}
		$chartTitles = array();
		$chartTitles[] = 'Dias de la semana';
		$label = '';
		foreach($between_days as $index => $day){

			switch ($index) {
				case 0:
					# code...
					$label = 'Domingo '. $day ;
					break;
				case 1:
					# code...
					$label = 'Lunes '. $day ;
				break;

				case 2:
					# code...
					$label = 'Martes '. $day ;
				break;

				case 3:
					# code...
					$label = 'Miercoles '. $day ;
				break;
				case 4:
					# code...
					$label = 'Jueves '. $day ;
					break;
				case 5:
					# code...
					$label = 'Viernes '. $day ;
				break;

				case 6:
					# code...
					$label = 'Sabado '. $day ;
				break;
				
				default:
					# code...
					break;
			}
			$chartTitles[] = $label;
		}
		$chartData[] = $chartTitles;
		$chartData[1][] = "";
		foreach($between_days as $day){
			$chartData[1][] = (float) $this->get_count_assits($day)->total;
		}

		return $chartData;
	}

	public function get_count_assits($day)
	{
		return $this->db->select('COUNT(fecha) as total')
				->where('fecha',$day)
				->get($this->tables['assists'])->row();
	}



	public function get_date_range()
	{
		date_default_timezone_set('UTC');
		$range = array();
		$this->db->select_min('fecha');
		$db_min = $this->db->get($this->tables['assists'])->row();
		$day = date ("D", strtotime($db_min->fecha));
		if($day === 'Sun'){
			$max = date('Y-m-j',strtotime('next Saturday', strtotime($db_min->fecha)));
			$min = $db_min->fecha;
			$range[] = array(
				'min' => $min,
				'max' => $max);
		}elseif ($day === 'Sat') {
			$max = $db_min->fecha;
			$min = date('Y-m-j',strtotime('last Sunday', strtotime($db_min->fecha)));
			$range[] = array(
				'min' => $min,
				'max' => $max);
		}else{
			$max = date('Y-m-j',strtotime('next Saturday', strtotime($db_min->fecha)));
			$min = date('Y-m-j',strtotime('last Sunday', strtotime($db_min->fecha)));
			$range[] = array(
				'min' => $min,
				'max' => $max
			);
		}
		$actual = date('Y-m-j', strtotime('2018-10-20'));
		$dia_actual = date("D", strtotime($actual));
		do {
				$max = date('Y-m-j',strtotime('+7 days',strtotime($max)));
				$min = date('Y-m-j',strtotime('+7 days',strtotime($min)));
				$range[] = array(
				'min' => $min,
				'max' => $max
			);
		} while ($min <= $actual);
		if($dia_actual === 'Sun'){
			$max = date('Y-m-j',strtotime('next Saturday', strtotime($actual)));
			$min = $actual;
			$range[] = array(
				'min' => $min,
				'max' => $max
			);
		}elseif($dia_actual === 'Sat')
		{
			$max = $actual;
			$min = date('Y-m-j',strtotime('last Sunday', strtotime($actual)));
			$range[] = array(
				'min' => $min,
				'max' => $max
			);
		}else{
			$max = date('Y-m-j',strtotime('next Saturday', strtotime($actual)));
			$min = date('Y-m-j',strtotime('last Sunday', strtotime($actual)));
			$range[] = array(
				'min' => $min,
				'max' => $max
			);
		}

		return $range;

	}
}
