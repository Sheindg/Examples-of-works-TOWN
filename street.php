<?php
include_once 'config.php';
  
class Street {
	protected $name;  
	protected $length;
	protected $houseOnStreet;
	protected $coordinates = array (
    'start' => array ('Широта' => 0, 'Долгота' => 0),
    'finish' => array ('Широта' => 0, 'Долгота' => 0),
  ); 
   
	protected $houses = array();
 
	public function __construct ($ini) {
		$this->name = $ini['name'];  
		$this->length = $ini['length'];
		$this->coordinates = $ini['coordinates'];          
		$this->houseOnStreet = count ($ini['houseType']); 
    
		for ($n=0; $n < $this->houseOnStreet; $n++) {
			$iniHouse = array ('number'=> $n+1, 'square'=> $ini['square'][$n]);
			$type = $ini['houseType'][$n];  
			$iniHouse = array_merge ($iniHouse, Conf::$houseType[$type]);
      
			$iniOnFloor = array();
			$type = $ini['onFloorType'][$n];      
		for ($i=0; $i < count (Conf::$onFloorType[$type]); $i++)
			$iniOnFloor[$i] = Conf::$flatType[Conf::$onFloorType[$type][$i]]; 
      
			$iniHouse = array_merge ($iniHouse, array ('flats'=> $iniOnFloor)); 
			$this->houses[$n] = new House ($iniHouse);
		}
	}
   
	public function streetInfo() {
		$info = array();   
		$info['name']        = array ('mes'=>'Название',        'val'=>$this->name);
		$info['length']      = array ('mes'=>'Протяженность',   'val'=>$this->length);
		$info['stXcoord']    = array ('mes'=>'Начало улицы Широта',  'val'=>$this->coordinates['start']['Широта']);      
		$info['stYcoord']    = array ('mes'=>'Начало улицы Долгота',  'val'=>$this->coordinates['start']['Долгота']);
		$info['finXcoord']   = array ('mes'=>'Конец улицы Широта',   'val'=>$this->coordinates['finish']['Широта']);
		$info['finYcoord']   = array ('mes'=>'Конец улицы Долгота',   'val'=>$this->coordinates['finish']['Долгота']);
		$info['houses']      = array ('mes'=>'Домов: ',            'val'=>$this->houseOnStreet);
	return $info;    
	}
  
	public function getHouseOnStreet() { return $this->houseOnStreet; }  
	public function getHouse ($number) { return $this->houses[$number]; }
  
	public function calcNumberCleaner() {
		for ($sum=0, $n=0; $n < $this->houseOnStreet; $n++)    
		$sum += $this->houses[$n]->getSquare();
	return ceil ($sum / Conf::$tarif['cleanerStreet']);
	}
  
	public function calcCostSummaryStreet() {
		for ($sum=0, $n=0; $n < $this->houseOnStreet; $n++)    
		$sum += $this->houses[$n]->calcCostSummaryHouse();
	return $sum;
	}
}

 

 