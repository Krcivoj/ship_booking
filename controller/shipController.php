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
        $reservation->ticket_kids = $_POST['adults'];
        $reservation->ticket_babies = $_POST['adults'];
        $reservation->menu_meat = $_POST['meat'];
        $reservation->menu_fish = $_POST['fish'];
        $reservation->menu_vege = $_POST['vege'];
        if(isset($_POST['animals']))
        $reservation->menu_animals = $_POST['animals'];

        $code = '';
		for( $i = 0; $i < 20; ++$i )
			$reg_seq .= chr( rand(0, 25) + ord( 'a' ) );
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
                    if($_POST['meat']+$_POST['fish']+$_POST['vege'] != $_POST['adults']+$_POST['kids']+$_POST['babies']){
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
                        $ukupno= $row['r1'] +$row['r2'] +$row['r3'] ;
                                    //treba provjeriti je li moguće obaviti rezervaciju - ima li dovoljno dana
                   
                    
                    if($ukupno + $_POST['adults']+$_POST['kids']+$_POST['babies'] > $brod->capacity){
                        $this->registry->template->message ="Nije moguća rezervacija, nema mjesta!";
                        $this->registry->template->show('reservation_make');
                        return;
                    }
                else{
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
                    $reservation = $this->makeReservationPost( $user->id);
                    $reservation->save();

                    //dodaj poruku forme;
                    $this->registry->template->message ="Vaš izlet je registriran! Kod za izlet je: " + $reservation->code;
                }
            }

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
                        $this->registry->template->show('reservation_make');
                        return;
                    }

                    //sanitizacija name-a
                    if( !preg_match( "/^[a-zA-Z-' ]{1,50}$/", $_POST['ime'])){
                        $this->registry->template->show('reservation_make');
                        return;
                    }

                    //sanitizacija surname-a
                    if( !preg_match( "/^[a-zA-Z-' ]{1,50}$/", $_POST['prezime'])){
                        $this->registry->template->show('reservation_make');
                        return;
                    }

                    //treba provjeriti je li odgovara broj karata
                    if($_POST['meat']+$_POST['fish']+$_POST['vege'] != $_POST['adults']+$_POST['kids']+$_POST['babies']){
                        //nije dobro
                        $this->registry->template->message ="Broj karata i menija nije konzistentan!";
                        $this->registry->template->show('reservation_make');

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
                        $ukupno= $row['r1'] +$row['r2'] +$row['r3'] ;
                                    //treba provjeriti je li moguće obaviti rezervaciju - ima li dovoljno dana
                   
                    
                    if($ukupno + $_POST['adults']+$_POST['kids']+$_POST['babies'] > $brod->capacity){
                        $this->registry->template->message ="Nije moguća rezervacija, nema mjesta!";
                        $this->registry->template->show('reservation_make');
                        return;
                    }

                    //treba provjeriti je li user vec postoji ili stvoriti novog
                    $user = new User();
                    $user->name = $_POST['ime'];
                    $user->surname = $_POST['prezime'];
                    $user->email = $_POST['mail'];
                    $user->password_hash="";
                    $user->registration_sequence ="";
                    $user->has_registered = 0;
                    $user->type = "buyer";
                    $user->save();

                    $user=User::whereOne('email', $user->email);
                    $reservation = $this->makeReservationPost( $user->id);
                    $reservation->save();

                    //dodaj poruku ispod forme! moža pošalji mail 
                    $this->registry->template->message ="Vaš izlet je registriran!";
            }
            else{
                
                $this->registry->template->show('reservation_make');
            }
            
        }
    }

    public function reservation_validate(){
        //postavljene su sve vrijednosti
        if(isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['mail']) && isset($_POST['datum'])
             && isset($_POST['adults']) && isset($_POST['kids']) && isset($_POST['babies'])
             && isset($_POST['meat']) && isset($_POST['fish']) && isset($_POST['vege'])){
                echo $_POST['ime'];
                echo $_POST['prezime'];
                echo $_POST['mail'];
                echo $_POST['datum'];

/*
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
            */
        }

    }
}; 

?>