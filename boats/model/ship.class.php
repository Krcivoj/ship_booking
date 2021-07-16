<?php

class Ship extends Model
{
	static protected $table = 'project_ships';
    static protected $attributes  = ['id'=>'int', 'id_owner'=>'int', 'name'=>'string', 'capacity'=>'int', 
    'price_kids'=>'float', 'price_adults'=>'float', 'web_link'=>'string', 'locations'=>'string', 
    'description'=>'string', 'departure_time'=>'string', 'arrival_time'=>'string', 'start_place'=>'string', 'start_lat'=>'float',
     'start_lon'=>'float', 'animal_friendly'=>'bool'];
}

?>