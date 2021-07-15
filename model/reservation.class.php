<?php

class Reservation extends Model
{
	static protected $table = 'project_reservations';
    static protected $attributes  = ['id'=>'int', 'id_buyer'=>'int', 'id_ship'=>'int', 'date_buy'=>'string',
     'date_trip'=>'string', 'ticket_baby'=>'int', 'ticket_kids'=>'int',  'ticket_adults'=>'int', 'code'=>'string', 'menu_meat'=>'int',
      'menu_fish'=>'int', 'menu_veg'=>'int', 'animals'=>'int', 'rating'=>'int', 'comment'=>'string'];
}

?>