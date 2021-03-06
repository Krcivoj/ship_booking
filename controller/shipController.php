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
        $reservation->date_trip= $_POST['datum'];
        $reservation->ticket_adults = $_POST['adults'];
        $reservation->ticket_kids = $_POST['kids'];
        $reservation->ticket_baby = $_POST['babies'];
        $reservation->menu_meat = $_POST['meat'];
        $reservation->menu_fish = $_POST['fish'];
        $reservation->menu_veg = $_POST['vege'];
        if(isset($_POST['animals']))
        $reservation->menu_animals = $_POST['animals'];

        $code = '';
		for( $i = 0; $i < 20; ++$i )
			$code .= chr( rand(0, 25) + ord( 'a' ) );
        $reservation->code= $code;

        //upit za dobivanje id-broda
        $brod = Ship::whereOne('name', $_GET['name']);
        $reservation->id_ship = $brod->id;

        return $reservation;
    }

    public function reservation_make()
    {
        $this->registry->template->message ="";
        //postavljen user tj ulogiran
        if(isset($_SESSION['user']))
        {
            $user = unserialize($_SESSION['user']);
            if(isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['mail']) && isset($_POST['datum'])
             && isset($_POST['adults']) && isset($_POST['kids']) && isset($_POST['babies'])
             && isset($_POST['meat']) && isset($_POST['fish']) && isset($_POST['vege'])){


                //validacija i sanitizacija
                    // Provjeri ispravnost emaila
                    if( !isset($_POST['mail']) || !filter_var( $_POST['mail'], FILTER_VALIDATE_EMAIL) )
                    {
                        $this->registry->template->message ="Mail nije dobar!";
                        $this->registry->template->show('reservation_make');
                        return;
                    }

                    //sanitizacija name-a
                    if( !preg_match( "/^[a-zA-Z-' ]{1,50}$/", $_POST['ime'])){
                        $this->registry->template->message ="Ime nije dobro!";
                        $this->registry->template->show('reservation_make');
                        return;
                    }

                    //sanitizacija surname-a
                    if( !preg_match( "/^[a-zA-Z-' ]{1,50}$/", $_POST['prezime'])){
                        $this->registry->template->message ="Prezime nije dobro!";
                        $this->registry->template->show('reservation_make');
                        return;
                    }

                    //treba provjeriti je li odgovara broj karata
                    if((int)$_POST['meat']+(int)$_POST['fish']+(int)$_POST['vege'] !== (int)$_POST['adults']+(int)$_POST['kids']+(int)$_POST['babies']){
                        //nije dobro
                        $this->registry->template->message ="Broj karata i menija nije konzistentan!";
                        $this->registry->template->show('reservation_make');
                        return;

                    }
                    //upit za dobivanje id-broda
                    $brod = Ship::whereOne('name', $_GET['name']);
                    $ukupno=0;
                    //provjera jel dostupno
                    try
                    {
                        $db = DB::getConnection();
                        $st = $db->prepare( 'SELECT SUM(ticket_adults) AS r1, SUM(ticket_kids) AS r2, SUM(ticket_baby) AS r3 
                                                FROM project_reservations WHERE date_trip = :column1 AND id_ship=:column2');
                        $st->execute( array( 'column1' => $_POST['datum'], 'column2' => $brod->id ) );
                    }
                    catch( PDOException $e ) { exit( 'PDO (where) error ' . $e->getMessage() ); }

                        $row = $st->fetch();
                        $ukupno= (int)$row['r1'] +(int)$row['r2'] +(int)$row['r3'] ;
                                    //treba provjeriti je li mogu??e obaviti rezervaciju - ima li dovoljno dana
                   
                    
                    if($ukupno + (int)$_POST['adults']+(int)$_POST['kids']+(int)$_POST['babies'] > $brod->capacity){
                        $this->registry->template->message ="Nije mogu??a rezervacija, nema mjesta!";
                        $this->registry->template->show('reservation_make');
                        return;
                    }
                    if($user->email !== $_POST['mail'])
                    {
                        $user=User::whereOne('email', $_POST['mail']);
                        if($user === null){
                            $user = new User();
                            $user->name = $_POST['ime'];
                            $user->surname = $_POST['prezime'];
                            $user->email = $_POST['mail'];
                            $user->has_registered = 0;
                            $user->password_hash="";
                            $user->registration_sequence ="";
                            $user->type = "buyer";
                            $user->save();
    
                            $user=User::whereOne('email', $user->email);
                        }
                    }
                    $reservation = $this->makeReservationPost($user->id);
                    $reservation->save();

                    //dodaj poruku forme;
                    $this->registry->template->message ="Va?? izlet je registriran! Kod za izlet je: " . $reservation->code;
                    $this->registry->template->show('reservation_make');
            }
            else
                $this->registry->template->show('reservation_make');

        }
        else{
            //nije ulogiran
            //PROVJERI JE LI SE SALJE
            if(isset($_POST['ime'])!=="" && isset($_POST['prezime'])!=="" && isset($_POST['mail'])!=="" && isset($_POST['datum'])
             && isset($_POST['adults']) && isset($_POST['kids']) && isset($_POST['babies'])
             && isset($_POST['meat']) && isset($_POST['fish']) && isset($_POST['vege'])){
                    
                    //validacija i sanitizacija
                    // Provjeri ispravnost emaila
                    if( !isset($_POST['mail']) || !filter_var( $_POST['mail'], FILTER_VALIDATE_EMAIL) )
                    {
                        $this->registry->template->message ="Mail nije dobar!";
                        $this->registry->template->show('reservation_make');
                        return;
                    }

                    //sanitizacija name-a
                    if( !preg_match( "/^[a-zA-Z-' ]{1,50}$/", $_POST['ime'])){
                        $this->registry->template->message ="Ime nije dobro!";
                        $this->registry->template->show('reservation_make');
                        return;
                    }

                    //sanitizacija surname-a
                    if( !preg_match( "/^[a-zA-Z-' ]{1,50}$/", $_POST['prezime'])){
                        $this->registry->template->message ="Prezime nije dobro!";
                        $this->registry->template->show('reservation_make');
                        return;
                    }

                    //treba provjeriti je li odgovara broj karata
                    if((int)$_POST['meat']+(int)$_POST['fish']+(int)$_POST['vege'] != (int)$_POST['adults']+(int)$_POST['kids']+(int)$_POST['babies']){
                        //nije dobro
                        $this->registry->template->message ="Broj karata i menija nije konzistentan!";
                        $this->registry->template->show('reservation_make');
                        return;

                    }
                    //upit za dobivanje id-broda
                    $brod = Ship::whereOne('name', $_GET['name']);
                    $ukupno=0;
                    //provjera jel dostupno
                    try
                    {
                        $db = DB::getConnection();
                        $st = $db->prepare( 'SELECT SUM(ticket_adults) AS r1, SUM(ticket_kids) AS r2, SUM(ticket_baby) AS r3 
                                                FROM project_reservations WHERE date_trip = :column1 AND id_ship=:column2');
                        $st->execute( array( 'column1' => $_POST['datum'], 'column2' => $brod->id ) );
                    }
                    catch( PDOException $e ) { exit( 'PDO (where) error ' . $e->getMessage() ); }

                        $row = $st->fetch();
                        $ukupno= (int)$row['r1'] +(int)$row['r2'] +(int)$row['r3'] ;
                                    //treba provjeriti je li mogu??e obaviti rezervaciju - ima li dovoljno dana
                   
                    
                    if($ukupno + (int)$_POST['adults']+(int)$_POST['kids']+(int)$_POST['babies'] > $brod->capacity){
                        $this->registry->template->message ="Nije mogu??a rezervacija, nema mjesta!";
                        $this->registry->template->show('reservation_make');
                        return;
                    }
                    //treba provjeriti je li user vec postoji ili stvoriti novog
                    $user=User::whereOne('email', $_POST['mail']);
                    if($user === null){
                        $user = new User();
                        $user->name = $_POST['ime'];
                        $user->surname = $_POST['prezime'];
                        $user->email = $_POST['mail'];
                        $user->has_registered = 0;
                        $user->password_hash="";
                        $user->registration_sequence ="";
                        $user->type = "buyer";
                        $user->save();

                        $user=User::whereOne('email', $user->email);
                    }
                    $reservation = $this->makeReservationPost( $user->id);
                    $reservation->save();

                    //dodaj poruku ispod forme! mo??a po??alji mail 
                    $this->registry->template->message ="Va?? izlet je registriran! Kod za izlet je: " . $reservation->code;
                    $this->registry->template->show('reservation_make');
            }
            else{
                $this->registry->template->show('reservation_make');
            }
            
        }
    }

    public function show_page(){
        $ship = new Ship();
        $ship = Ship::whereOne('name', $_GET['name']);
        $this->registry->template->ship = $ship;
        $this->registry->template->locations = explode("," , $ship->locations);
        $this->registry->template->resList = Reservation::where('id_ship', $ship->id);
        $this->registry->template->show('boat_page');
    }

    public function attendance(){
        $ship = Ship::whereOne('name', $_GET['name']);
        $tablica=[];
        $red= [];
        $theDate = Date('Y-m-d');
        $date = new DateTime($theDate);
        for( $i = 0; $i<7 ; $i++)
        {
            $date->modify('-1 day');
            try
            {
                $db = DB::getConnection();
                $st = $db->prepare( 'SELECT SUM(ticket_adults) AS r1, SUM(ticket_kids) AS r2, SUM(ticket_baby) AS r3 
                                        FROM project_reservations WHERE date_trip = :column1 AND id_ship=:column2');
                $st->execute( array( 'column1' => $date->format('Y-m-d'), 'column2' => $ship->id ) );
            }
            catch( PDOException $e ) { exit( 'PDO (where) error ' . $e->getMessage() ); }

            $row = $st->fetch();
            $ukupno= (int)$row['r1'] +(int)$row['r2'] +(int)$row['r3'] ;
            $red['odrasli']=(int)$row['r1'];
            $red['djeca']=(int)$row['r2'];
            $red['bebe']=(int)$row['r3'];
            $red['ukupno']=$ukupno;
            $tablica[]=$red;
        }

        $date = new DateTime($theDate);
        $data = [];
        $dataEl = [];
        $points = [];
        for($i=0; $i<count($tablica); $i++){
            $date->modify('-1 day');
            $point = [];
            $point['label'] = $date->format('Y-m-d');
            $point['y'] = $tablica[$i]['odrasli'];
            $points[]= $point;
        }
        $dataEl['type']="column";
        $dataEl['name']="Odrasli";
        $dataEl['dataPoints']=$points;
        $data[]= $dataEl;

        $date = new DateTime($theDate);
        $dataEl = [];
        $points = [];
        for($i=0; $i<count($tablica); $i++){
            $date->modify('-1 day');
            $point = [];
            $point['label'] = $date->format('Y-m-d');
            $point['y'] = $tablica[$i]['djeca'];
            $points[]= $point;
        }
        $dataEl['type']="column";
        $dataEl['name']="Djeca";
        $dataEl['dataPoints']=$points;
        $data[]= $dataEl;

        $date = new DateTime($theDate);
        $dataEl = [];
        $points = [];
        for($i=0; $i<count($tablica); $i++){
            $date->modify('-1 day');
            $point = [];
            $point['label'] = $date->format('Y-m-d');
            $point['y'] = $tablica[$i]['bebe'];
            $points[]= $point;
        }
        $dataEl['type']="column";
        $dataEl['name']="Bebe";
        $dataEl['dataPoints']=$points;
        $data[]= $dataEl;

        $date = new DateTime($theDate);
        $dataEl = [];
        $points = [];
        for($i=0; $i<count($tablica); $i++){
            $date->modify('-1 day');
            $point = [];
            $point['label'] = $date->format('Y-m-d');
            $point['y'] = $tablica[$i]['ukupno'];
            $points[]= $point;
        }
        $dataEl['type']="column";
        $dataEl['name']="Ukupno";
        $dataEl['dataPoints']=$points;
        $data[]= $dataEl;
        
        header( 'Content-type:application/json;charset=utf-8' );
        echo json_encode($data);
        flush();
        exit( 0 );
    }
}; 

?>