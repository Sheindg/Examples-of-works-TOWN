<?php

include_once 'config.php';
include_once 'flat.php';
include_once 'house.php';
include_once 'street.php';
include_once 'town.php';
  
echo '<h3>КВАРТИРА</h3>';

	$iniFlat = array_merge (array ('number'=>13, 'level'=>3), Conf::$flatType[$type=3]); 
	$ap = new Flat ($iniFlat);
 	$ap->setPeople(7);
	$ap->setPeople ($ap->getPeople() - 2);
	$apInfo = $ap->apartmentInfo();
	foreach ($apInfo as $key => $value) 
	echo $value['mes'].': '.$value['val'].'</br>';
	$ap->setCounter('electr', 180);
	$ap->setCounter('phone', 80);
	echo '------------------------------------------------------------</br>';
	echo ' Квартплата за месяц: '.round ($ap->calcCostSummary(), 2).'</br></br></br>';
    
	
echo '<h3>ДОМ</h3>';
   
	$iniHouse = array_merge (array ('number'=>8, 'square'=>1100), Conf::$houseType[$type=2]); 
	$iniOnFloor = array();
	for ($i=0; $i < count (Conf::$onFloorType[$type=1]); $i++)
	$iniOnFloor[$i] = Conf::$flatType[Conf::$onFloorType[$type][$i]];
	$iniHouse = array_merge ($iniHouse, array ('flats'=> $iniOnFloor)); 
	$hs = new House ($iniHouse);
  
	$hsInfo = $hs->houseInfo();  
	foreach ($hsInfo as $key => $value) {
		if ($key == 'flats') echo $value['mes'].': '.
		$hsInfo['sections']['val'] * $hsInfo['floors']['val'] * $hsInfo['flatOnFloor']['val'].'</br>';
		else echo $value['mes'].': '.$value['val'].'</br>';
	}
  
echo '------------------------------------------------------------</br>';
echo ' Квартплата за месяц по всему дому: '.round ($hs->calcCostSummaryHouse(), 2).'</br>';
$sum=0;
echo ' Ежемесячная оплата за освещение подъездов дома: '.round ($hs->calcCostElectrHouse(), 2).'</br>';
echo ' Ежемесячная оплата налога на прилегающую территорию дома: '.round ($hs->calcCostLandHouse(), 2).'</br>';
$sum = $hs->calcCostSummaryHouse() + $hs->calcCostElectrHouse() + $hs->calcCostLandHouse();
echo " ИТОГОВАЯ СУММА ПО ДОМУ ЗА МЕСЯЦ: $sum </br></br></br>";
  

echo '<h3>УЛИЦА</h3>';
	$iniStreet = Conf::$streetType[$type=0];      
	$st = new Street ($iniStreet);
	$stInfo = $st->streetInfo();  
	foreach ($stInfo as $key => $value) {
		if ($key == 'houses') echo $value['mes'].': '.$houseOnStreet = $value['val'].'</br>';
		else echo $value['mes'].': '.$value['val'].'</br>';
	}
  
	$sum=0;

echo '------------------------------------------------------------</br>';
echo ' Количество  дворников на улицу необходимо: '.$st->calcNumberCleaner().'</br>';
echo ' Квартплата за месяц по улице со всех домов: '.round ($st->calcCostSummaryStreet(), 2).'</br></br></br>';
  
 
echo '<h3>ГОРОД</h3>';
	$iniTown = array ('name'=>'Город', 'year'=>'1955', 'coordinates'=> array ('Широта'=>'40.120 c.ш.', 'Долгота'=>'24.140 в.д.'), 'streets'=>Conf::$streetType);    
	$town = new Town ($iniTown);
	$townInfo = $town->townInfo();  
	foreach ($townInfo as $key => $value) {
		if ($key == 'streets') echo $value['mes'].': '.$streetInTown = $value['val'].'</br>';
		else echo $value['mes'].': '.$value['val'].'</br>';
	}
  
	$sum=0;
echo '------------------------------------------------------------</br>';
echo ' Поступления от земельного налога: '.round ($town->calcCostLandTown(), 2).'</br>';
echo ' Население города: '.$town->calcNumberPeopleTown().'</br>'; 
  
  