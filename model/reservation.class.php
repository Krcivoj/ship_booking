<?php

class Reservation extends Model
{
	static protected $table = 'project_reservations';
    static protected $attributes  = ['id', 'id_buyer', 'id_ship', 'date_buy', 'date_trip', 
    'ticket_kids', 'ticket_adults', 'code', 'menu_meat', 'menu_fish', 'menu_veg', 'animals', 
    'rating', 'comment'];
}

?>