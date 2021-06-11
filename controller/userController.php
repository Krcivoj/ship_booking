<?php 

require_once __DIR__ . '/../model/product.class.php';
require_once __DIR__ . '/../model/user.class.php';
require_once __DIR__ . '/../model/sale.class.php';

class UserController
{
	public function index() 
	{

		$title = 'My products';
		$user =unserialize($_SESSION['user']);
		$username = $user->username;
		$heading = 'PRODUCTS AVAILABLE IN <font class="name">' . $username . '\'s</font> SHOP';
		$productList = $user->products();
		require_once __DIR__ . '/../view/user_products.php';
	}

	public function history()
	{
		$title = 'My history';
		$user =unserialize($_SESSION['user']);
		$username = $user->username;
		$heading = 'PRODUCTS PURCHASED BY <font class="name">'. $username . '</font>';
		$productList = $user->history();
		require_once __DIR__ . '/../view/user_products.php';
	}
}; 

?>
