<?php 

class UserController extends BaseController
{
	public function index() 
	{
		if(!isset($_SESSION['user']))
			header('location: index.php?rt=authentication');
		
		//require_once __DIR__ . '/../view/user_products.php';
	}

	public function reservations()
	{
		$this->registry->template->title = 'Moje rezervacije';
		$user =unserialize($_SESSION['user']);
		$reservationList = $user->reservations();
		foreach($reservationList as $reservation){
			$this->registry->template->reservation = $reservation;
			$this->registry->template->show('reservation');
		}
	}

	public function ships()//TODO
	{
		$this->registry->template->title = 'Moje rezervacije';
		$user =unserialize($_SESSION['user']);
		$shipList = $user->ships();
		foreach($shipList as $ship){
			$this->registry->template->reservation = $ship;
			$this->registry->template->show('reservation');
		}
	}
}; 

?>
