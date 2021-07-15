<?php 

class UserController extends BaseController
{
	public function index() 
	{
		if(!isset($_SESSION['user']))
			header('location: index.php?rt=authentication');
		
		else
		header('location: index.php?rt=user/reservations');
	}

	public function reservations()
	{
		$user =unserialize($_SESSION['user']);
		$this->registry->template->type = $user->type;
		$this->registry->template->owner = false;
		$reservationList = $user->reservations();
		foreach($reservationList as $reservation){
			$reservation->name = Ship::find($reservation->id_ship)->name;
		}
		$this->registry->template->reservationList = $reservationList;
		$this->registry->template->show('personal');
	}

	public function ships()
	{
		$this->registry->template->owner = true;
		$user =unserialize($_SESSION['user']);
		$this->registry->template->type = $user->type;
		$shipList = $user->ships();
		$reservationList=[];
		foreach($shipList as $ship){
			$reservationList = array_merge($reservationList,Reservation::where('id_ship',$ship->id));
		}
		foreach($reservationList as $reservation){
			$reservation->name = Ship::find($reservation->id_ship)->name;
		}
		$this->registry->template->reservationList = $reservationList;
		$this->registry->template->show('personal');
	}

	public function comment()
	{
		if(isset($_POST['id']) && isset($_POST['comment']) && isset($_POST['rank'])){
			$reservation = Reservation::find($_POST['id']);
			$reservation->comment = $_POST['comment'];
			$reservation->rsnk = $_POST['rank'];
			$reservation->save();
		}
		header('location: index.php?rt=user/reservations');
	}
}; 

?>
