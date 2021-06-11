<?php

class Ship extends Model
{
	static protected $table = 'project_ship';
    static protected $attributes  = ['id', 'id_owner', 'name', 'capacity', 
    'price_kids', 'price_adults', 'web_link', 'locations', 'description', 
    'departure_time', 'arrival_time', 'start_place', 'start_lat', 'start_lon', 'animal_friendly'];
}

?>