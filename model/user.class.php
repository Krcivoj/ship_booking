<?php

class User extends Model
{
	static protected $table = 'project_users';
    static protected $attributes  = ['id'=>'int', 'name'=>'string', 'surname'=>'string', 'email'=>'string',
	 'password_hash'=>'string', 'registration_sequence'=>'string', 'has_registered'=>'int', 'type'=>'string'];

	public function reservations()
	{
		return $this->hasMany('Reservation', 'id_buyer');
	}

	public function ships()
	{
		return $this->hasMany('Ship', 'id_owner');
	}

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

