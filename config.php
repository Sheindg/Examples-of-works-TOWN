<?php
class Conf {
	public static $tarif = array (
		"rent"=>7, 
		"waterCold"=>15, 
		"waterHot"=>25, 
		"gas"=>7, 
		"canalis"=>5,
		"heat"=>10,
		"electr"=>0.28,
		"phone"=>0.38,
		"garbage"=>9.2,
		"landHouse"=>5,
		"electrHouse"=>12,
		"cleanerStreet"=>500,
	);
        
 public static $flatType = array (
	1 => array ('rooms'=>1, 'square'=>35, 'balcony'=>1, 'balconysSquare'=>7),
	2 => array ('rooms'=>2, 'square'=>49, 'balcony'=>1, 'balconysSquare'=>7, 'heating'=>'АГВ.'),
	3 => array ('rooms'=>3, 'square'=>68, 'balcony'=>2, 'balconysSquare'=>14),
	4 => array ('rooms'=>4, 'square'=>82, 'balcony'=>3, 'balconysSquare'=>21),    
 );
        
 public static $onFloorType = array (
	1 => array (1, 2, 2, 3),
	2 => array (1, 3, 1, 2, 2),
	3 => array (1, 3, 4, 1),
);
  
public static $houseType = array (
	1 => array ('sections'=>2, 'floors'=>16),
	2 => array ('sections'=>2, 'floors'=>16),                       
	3 => array ('sections'=>4, 'floors'=>9),
	4 => array ('sections'=>4, 'floors'=>9),
	5 => array ('sections'=>6, 'floors'=>12),
);
    
public static $streetType = array (
	0 => array ('name'=>'Салтовское Шоссе', 'length'=>'1 км', 'coordinates'=> array ('start'=> array ('Широта'=>'40.123 c.ш.', 'Долгота'=>'24.157 в.д.'), 'finish'=> array ('Широта'=>'40.126 c.ш.', 'Долгота'=>'24.158 в.д.')),
		'houseType'   => array (  3,   1,   2,   2,    4,   3,   2,    5),
		'onFloorType' => array (  1,   1,   1,   3,    3,   2,   2,    1),
		'square'      => array (600, 650, 540, 720, 1100, 950, 870, 1230),
	),
    
	1 => array ('name'=>'улица Бакулина', 'length'=>'0.8 км', 'coordinates'=> array ('start'=> array ('Широта'=>'40.116 c.ш.', 'Долгота'=>'24.119 в.д.'), 'finish'=> array ('Широта'=>'40.118 c.ш.', 'Долгота'=>'24.122 в.д.')),
		'houseType'   => array (  3,   3,   1,   2,   4),
		'onFloorType' => array (  1,   2,   1,   1,   3),
		'square'      => array (410, 740, 680, 450, 820),
	),
    
	2 => array ('name'=>'Московский проспект', 'length'=>'1,8 км', 'coordinates'=> array ('start'=> array ('Широта'=>'40.128 c.ш.', 'Долгота'=>'24.150 в.д.'), 'finish'=> array ('Широта'=>'40.131 c.ш.', 'Долгота'=>'24.155 в.д.')),
		'houseType'   => array (  1,   5,   5,   5,    4,   4,   3,    5,   3,   3,   3),
		'onFloorType' => array (  2,   2,   1,   1,    3,   2,   2,    1,   2,   2,   2),
		'square'      => array (610, 540, 660, 450, 1020, 780, 770, 1230, 550, 560, 550),
	), 
);  
}
