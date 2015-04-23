<?php
include_once 'config.php';

class Flat {
	protected $number;
	protected $level;
	protected $square;
	protected $rooms;
	protected $people;
	protected $balcony;
	protected $balconysSquare;
	protected $heating;  
   	protected $counters = array ('electr'=>0, 'phone'=>0);   
    
	public function __construct ($ini) {
		$this->number = $ini['number'];  
		$this->level = $ini['level'];
		$this->square = $ini['square'];
		$this->rooms = $ini['rooms'];
		$this->people = isset ($ini['people']) ? $ini['people'] : 0;
		$this->balcony = $ini['balcony'];
		$this->balconysSquare = $ini['balconysSquare'];
		$this->heating = isset ($ini['heating']) ? $ini['heating'] : 'центральное';
	}
    
	public function apartmentInfo() {
		$info = array();   
		$info['number'] =          array ('mes'=>'Номер',              'val'=>$this->number);
		$info['level'] =           array ('mes'=>'Этаж',               'val'=>$this->level);
		$info['square'] =          array ('mes'=>'Общая площадь',      'val'=>$this->square);
		$info['rooms'] =           array ('mes'=>'Кол-во комнат',      'val'=>$this->rooms);
		$info['people'] =          array ('mes'=>'Жильцов',            'val'=>$this->people);
		$info['balcony'] =         array ('mes'=>'Кол-во балконов',    'val'=>$this->balcony);
		$info['balconysSquare'] =  array ('mes'=>'Площадь балконов',   'val'=>$this->balconysSquare);
		$info['heating'] =         array ('mes'=>'Вид отопления',      'val'=>$this->heating);
	return $info;
	}
  
	public function getPeople() { return $this->people; }
	public function setPeople($value) { $this->people = ($value <= 0 ? 0 : $value); }
  
	public function getCounter($key) { return $this->counters[$key]; }
	public function setCounter($key, $value) { $this->counters[$key] = ($value <= 0 ? 0 : $value); }
    
	public function calcCostRent() {
	return $this->square * Conf::$tarif['rent'];
	}
	public function calcCostWaterCold() {
	return $this->people * Conf::$tarif['waterCold'];
	}
	public function calcCostWaterHot() {
	return $this->people * Conf::$tarif['waterHot'];
	}
	public function calcCostGas() {
	return $this->people * Conf::$tarif['gas'];
	}
	public function calcCostCanalis() {
	return $this->people * Conf::$tarif['canalis'];
	}
	public function calcCostHeat() {
	return ($this->square - $this->balconysSquare) * Conf::$tarif['heat'];
	}
	public function calcCostElectr() {
	return $this->counters['electr'] * Conf::$tarif['electr'];
	}
	public function calcCostPhone() {
	return $this->counters['phone'] * Conf::$tarif['phone'];
	}
	public function calcCostGarbage() {
	return $this->people * Conf::$tarif['garbage'];
	}
    
	public function calcCostSummary() {
	return  $this->calcCostRent()   + $this->calcCostWaterCold() + $this->calcCostWaterHot() +  
            $this->calcCostGas()    + $this->calcCostCanalis()   + $this->calcCostHeat() +
            $this->calcCostElectr() + $this->calcCostPhone()     + $this->calcCostGarbage();
	}
	public function dobav_people() {                
		$this->people++;
	} 
	public function udrat_people() {               
		if ($this->people > 0)
		$this->people--;
	}
}
  
