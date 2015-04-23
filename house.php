<?php
include_once 'config.php';
  
class House {
	protected $number;  
	protected $floors;
	protected $sections;  
	protected $flatOnFloor;
	protected $square; 
    protected $flats = array();
    
	public function __construct ($ini) {
		$this->number = $ini['number'];  
		$this->floors = $ini['floors'];
		$this->sections = $ini['sections'];
		$this->square = $ini['square'];       
		$this->flatOnFloor = count ($ini['flats']);
		for ($n=0, $i=0; $i < $this->sections; $i++) 
			for ($j=0; $j < $this->floors; $j++) 
				for ($k=0; $k < $this->flatOnFloor; $k++, $n++) {
					$iniFlat = array_merge (array ('number'=>$n+1, 'level'=>$j+1), $ini['flats'][$k]);
					$this->flats[$i][$j][$k] = new Flat ($iniFlat);
					$this->flats[$i][$j][$k]->setPeople (rand (1, $ini['flats'][$k]['rooms'] + 1));
				}
	}

	public function houseInfo() {
		$info = array();   
		$info['number']         = array ('mes'=>'Номер',                   'val'=>$this->number);
		$info['floors']         = array ('mes'=>'Количествово этажей',           'val'=>$this->floors);
		$info['sections']       = array ('mes'=>'Количествово подъездов',        'val'=>$this->sections);
		$info['flatOnFloor']    = array ('mes'=>'Количествово квартир на этаж',  'val'=>$this->flatOnFloor);
		$info['square']         = array ('mes'=>'Придомовая площадь',      'val'=>$this->square);      
		$info['flats']          = array ('mes'=>'Квартир',                'val'=>$this->flats);
	return $info;    
	}
 
	public function getSections()       { return $this->sections; }
	public function getFloors()         { return $this->floors; } 
	public function getFlatOnFlor() { return $this->flatOnFloor; }
	public function getSquare()         { return $this->square; }
    
	public function getFlat ($section, $level, $onFloor){
	return $this->flats[$section][$level][$onFloor];
	}
  
	public function getFlartByNumber ($number) {
		for ($i=0; $i < $this->sections; $i++)
			for ($j=0; $j < $this->level; $j++)		  
				for ($k=0; $k < $this->flatOnFloor; $k++)
					if ($this->flats[$i][$j][$k]->number = $number) 
	return $this->flats[$i][$j][$k];
	}	
	
	public function calcCostSummaryHouse() {
		for ($sum=0, $i=0; $i < $this->sections; $i++) 
			for ($j=0; $j < $this->floors; $j++) 
				for ($k=0; $k < $this->flatOnFloor; $k++) 
				$sum += $this->flats[$i][$j][$k]->calcCostSummary();
	return $sum;        
	}
    
	public function calcCostLandHouse() {
	return $this->square * Conf::$tarif['landHouse'];
	}
    
	public function calcCostElectrHouse() {
	return $this->sections * $this->floors * Conf::$tarif['electrHouse'];
	} 
}
  
 

 