<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stats extends MY_Controller {
	public function index()
	{	
		if (!$this->auth_model->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }else if (!$this->has_permissions('stats')) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('No tienes permisos para ver esta pagina');
        }
		date_default_timezone_set('UTC');
		$this->data['dropdown'] = $this->stat_model->dropdown_date_range();
		$this->data['range'] = $this->stat_model->get_date_range();
		$range = array();
		$fecha = date('Y-m-j');
		$min = null;
		$max = null;
		//echo $fecha;
		$nuevafecha = strtotime ( '-7 day' , strtotime ( $fecha ) ) ;
		$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
		$this->db->select_min('fecha');
		$db_min = $this->db->get('asistencias')->row();
		$day = date ("D", strtotime($db_min->fecha));
		//echo $day .'<br>';
		//echo $db_min->fecha .'<br>';
		//echo 'MAX' . $max = date('Y-m-j',strtotime('next Saturday', strtotime($db_min->fecha)));
		//echo 'MIN' .	$min = date('Y-m-j',strtotime('last Sunday', strtotime($db_min->fecha)));
		//Sat Sun
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
		$initial = $range[0]['min'];
		do {
			//echo $initial;
			//echo '<br>';
			$initial = date('Y-m-j',strtotime('+1 days',strtotime($initial)));
		} while ( $initial <= $range[0]['max']);
	
		
		//while($)
		//echo $dia_actual;
		//var_dump($range);
		// echo $min->fecha .'<br>'; 
		// echo $ultima_semana_min = date('Y-m-j',strtotime('next Saturday', strtotime($min->fecha)));
		// echo "\n <br>";
		// echo $ultima_semana_max = date('Y-m-j',strtotime('last Sunday', strtotime($min->fecha)));
		// echo "\n <br>";
		// echo $max_limit = date('Y-m-j',strtotime('next Saturday'));
		// echo $min_limit = date('Y-m-j',strtotime('last Sunday'));
		echo "\n";
		
		//echo $nuevafecha;
		


    // // Start date
    // $date = '2017-01-29';
    // // End date
    // $end_date = '2017-12-29';


		//var_dump($range);
		// foreach ($range as $date){
		// 	echo $date."\n";
		// }
		

		
		
		// $record = $this->db->where('fecha <=', $fecha)
		// 		 ->where('fecha >=', $nuevafecha)
		// 		 ->get('asistencias')->result();
		//echo $this->db->last_query();
		//var_dump($record);
		$this->_render('stats/assists', $this->data);
	}

	public function ajax_assists_charts()
	{   
		$key = $this->input->post('key');
		
		$response = $this->stat_model->charts_data($key);


        // $metrics = $this->member_model->get_user_metrics($id);
        // $newData = array();
        // $firstLine = TRUE;
        // foreach($metrics as $metric)
        // {
        //     if($firstLine)
        //     {
        //        $newData[] = array('Fecha','Masa Muscular Esquelética','Masa Grasa Corporal','Agua Corporal Total','Índice de Masa Corporal','Porcentaje de Masa Corporal','Relación Cintura-Cadera','Metabolismo Basal');
        //        $firstLine = FALSE; 
        //     }

        //     $newData[] = array($metric->fecha_creacion,(float) $metric->mme, (float) $metric->mgc, (float)$metric->act, (float)$metric->imc, (float) $metric->pmc,(float) $metric->rcc,(float) $metric->mb);
        // }
    	return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
    }
}