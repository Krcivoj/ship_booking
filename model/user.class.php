<?php

class User extends Model
{
	static protected $table = 'project_users';
    static protected $attributes  = ['id', 'name', 'surname', 'email', 'password_hash', 'registration_sequence', 'has_registered', 'type'];

	// public function products()
	// {
	// 	return $this->hasMany('Product', 'id_user');
	// }

	// public function history()
	// {
	// 	$salesList = $this->hasMany('Sale', 'id_user');
	// 	$productList = [];
	// 	foreach($salesList as $sale)
	// 	{
	// 		$productList[] = $sale->belongsTo('Product', 'id_product');
	// 	}
	// 	return $productList;
	// }
}

?>

