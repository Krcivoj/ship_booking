<?php

class Sale extends Model
{
	static protected $table = 'dz2_sales';
    static protected $attributes  = ['id', 'id_product', 'id_user', 'rating', 'comment'];
}

?>