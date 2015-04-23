<?php
include_once 'config.php';
  
class Town {
	protected $name;  
	protected $year;
	protected $streetInTown;
	protected $coordinates = array ('Широта' => 0, 'Долгота' => 0);
 	protected $streets = array();
 
	public function __construct ($ini) {
		$this->name = $ini['name'];  
		$this->year = $ini['year'];
		$this->coordinates = $ini['coordinates'];          
		$this->streetInTown = count ($ini['streets']); 
    
		for ($n=0; $n < $this->streetInTown; $n++) {
			$iniStreet = $ini['streets'][$n];       
			$this->streets[$n] = new Street ($iniStreet);
		}
	}
  
	public function getStreet ($number) { return $this->streets[$number]; }
   
	public function townInfo() {
		$info = array();   
		$info['name']    = array ('mes'=>'Название',      'val'=>$this->name);
		$info['year']    = array ('mes'=>'Год основания', 'val'=>$this->year);
		$info['coordX']  = array ('mes'=>'Координата Широта',  'val'=>$this->coordinates['Широта']);      
		$info['coordY']  = array ('mes'=>'Координата Долгота',  'val'=>$this->coordinates['Долгота']);
		$info['streets'] = array ('mes'=>'Улицы',         'val'=>$this->streetInTown);
	return $info;    
	}
  
	public function calcCostLandTown() {
		for ($sum=0, $n=0; $n < $this->streetInTown; $n++)
			for ($i=0; $i < $this->getStreet($n)->getHouseOnStreet(); $i++) 
				$sum += $this->getStreet($n)->getHouse($i)->calcCostLandHouse();
	return $sum;
	}
  
	public function calcNumberPeopleTown() {
		for ($sum=0, $n=0; $n < $this->streetInTown; $n++)    
			for ($m=0; $m < $this->getStreet($n)->getHouseOnStreet(); $m++)
				for ($i=0; $i < $this->getStreet($n)->getHouse($m)->getSections(); $i++)
					for ($j=0; $j < $this->getStreet($n)->getHouse($m)->getFloors(); $j++)
						for ($k=0; $k < $this->getStreet($n)->getHouse($m)->getFlatOnFlor(); $k++)
							$sum += $this->getStreet($n)->getHouse($m)->getFlat($i,$j,$k)->getPeople();
	return $sum;
	}  
}

 

 