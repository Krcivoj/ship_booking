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
		if(!isset($_SESSION['user']))
			header('location: index.php?rt=authentication');
		$user =unserialize($_SESSION['user']);
		$this->registry->template->type = $user->type;
		$this->registry->template->owner = false;
		$this->registry->template->title = 'Vaše rezervacije:';
		$reservationList = $user->reservations();
		foreach($reservationList as $reservation){
			$reservation->name = Ship::find($reservation->id_ship)->name;
		}
		$this->registry->template->reservationList = $reservationList;
		$this->registry->template->show('personal');
	}

	public function ships()
	{
		if(!isset($_SESSION['user']))
		header('location: index.php?rt=authentication');
		$this->registry->template->owner = true;
		$this->registry->template->title = 'Sve rezervacije na Vašim brodovima:';
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
		if(isset($_POST['id']) && isset($_POST['comment']) && isset($_POST['rating'])){
			$reservation = Reservation::find($_POST['id']);
			$reservation->comment = $_POST['comment'];
			$reservation->rating = $_POST['rating'];
			$reservation->save();
		}
		header('location: index.php?rt=user/reservations');
	}
}; 

?>
