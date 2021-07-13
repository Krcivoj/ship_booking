<?php 

class ShipController extends BaseController
{
	public function index() 
	{
		header('location: index.php?rt=searchController');
	}

    public function show()
    {
        if(isset($_GET['id_ship'])){

        }
        else
        header('location: index.php?rt=_404Controller');
    }

    private function makeReservationPost( $id_buyer)
    {
        $reservation = new Reservation();
        $reservation->id_buyer = $id_buyer;
        $reservation->date_buy = date("Y-m-d");
        $reservation->date_trip= $_POST['date'];
        $reservation->ticket_adults = $_POST['adults'];
        $reservation->ticket_kids = $_POST['adults'];
        $reservation->ticket_babies = $_POST['adults'];
        $reservation->menu_meat = $_POST['meat'];
        $reservation->menu_fish = $_POST['fish'];
        $reservation->menu_vege = $_POST['vege'];
        if(isset($_POST['animals']))
        $reservation->menu_animals = $_POST['animals'];
        return $reservation;
    }

    public function reservation()
    {
        if(isset($_SESSION['user']))
        {
            $user = unserialize($_SESSION['user']);
            if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['date'])
             && isset($_POST['adults']) && isset($_POST['kids']) && isset($_POST['babies'])
             && isset($_POST['meat']) && isset($_POST['fish']) && isset($_POST['vege'])){
                if($_POST['email'] === $user->email){
                    $reservation = $this->makeReservationPost( $user->id);
                    $reservation->save();
                }
                else{
                    $user = new User();
                    $user->name = $_POST['name'];
                    $user->surname = $_POST['surname'];
                    $user->email = $_POST['email'];
                    $user->has_registered = 0;
                    $user->type = "buyer";
                    $user->save();

                    $user=User::where('email', $user->email)[0];
                    $reservation = $this->makeReservationPost( $user->id);
                    $reservation->save();
                }
            }

        }
        else{
            if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['date'])
                 &&isset($_POST['adults']) && isset($_POST['kids']) && isset($_POST['babies'])){
                    $user = new User();
                    $user->name = $_POST['name'];
                    $user->surname = $_POST['surname'];
                    $user->email = $_POST['email'];
                    $user->has_registered = 0;
                    $user->type = "buyer";
                    
                    $user=User::where('email', $user->email)[0];
                    if(!$user){
                        $user->save();
                        $user=User::where('email', $user->email)[0];
                    }
                    $reservation = $this->makeReservationPost( $user->id);
                    $reservation->save();
            }
            else{
                $this->registry->template->show('reservation');
            }
            
        }
    }
}; 

?>