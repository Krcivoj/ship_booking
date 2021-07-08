<?php


class AuthenticationController extends BaseController
{
    public function index()
    {
        $this->registry->template->title = 'Prijava';
		$this->registry->template->message = '';
        if( isset( $_POST["gumb" ] ) && $_POST["gumb"] === "login" )
            $this->login();
        else if( isset( $_POST["gumb" ] ) && $_POST["gumb"] === "novi" ){
            header( 'Location: index.php?rt=authentication/signup_index' );
            return;
        }
        else
            $this->registry->template->show('login');

    }

    private function login_failed($message = '')
    {
        $this->registry->template->title = 'Greška prilkom prijave';
        $this->registry->template->message = $message;
		$this->registry->template->show('login');
    }

    public function login()
    {
        // Provjeri ispravnost emaila
        if( !isset($_POST['email']) || !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) )
	    {
            $this->login_failed("Email is not valid!");
            return;
	    }


        // Možda se ne šalje password; u njemu smije biti bilo što.
        if( !isset( $_POST["password"] ) ){
            $this->login_failed("Password is empty!");
            return;
        }

        $user = User::where('email', $_POST["email"])[0];

        if( $user === null )
        {
            // Taj user ne postoji, upit u bazu nije vratio ništa.
            $this->login_failed( 'Ne postoji korisnik s tim imenom.' );
            return;
        }
        else
        {
            // Postoji user. Dohvati hash njegovog passworda.
            $hash = $user->password_hash;
            // Da li je password dobar?
            if( password_verify( $_POST['password'], $hash ) )
            {
                // Dobar je. Ulogiraj ga.
                $_SESSION['user'] = serialize($user);
                header( 'Location: index.php?rt=user' );  //TODO
                return;
            }
            else
            {
                // Nije dobar. Crtaj opet login formu s pripadnom porukom.
                $this->login_failed( 'Postoji user, ali password nije dobar.' );
                return;
            }
        }
    }

    public function signup_index()
    {
		$this->registry->template->title = 'Izradi svoj račun';
		$this->registry->template->message = '';
        if( isset( $_POST["novi" ] ) && $_POST["novi"] === "novi" )
            $this->signup();
        else
            $this->registry->template->show('signup');

    }

    private function signup_failed($message = '')
    {
        $this->registry->template->title = 'Greška prilikom registracije';
        $this->registry->template->message = $message;
		$this->registry->template->show('signup');
    }

    
    // Funkcija koja procesira sto se dogodi nakon klika na gumb "Registriraj se!"
    public function signup()
    {
        //nisu postavljeni
        if( !isset( $_POST['name']) || !isset( $_POST['surname'])){
            $this->signup_failed("Name or surname is missing!");
            return;
        }

        //sanitizacija name-a
        if( !preg_match( '/^[a-zA-Z0-9]{1,50}$/', $_POST['name'])){
            $this->signup_failed("Name is not valid!");
            return;
        }

        //sanitizacija surname-a
        if( !preg_match( '/^[a-zA-Z0-9]{1,50}$/', $_POST['surname'])){
            $this->signup_failed("Surname is not valid!");
            return;
        }
        
        
        // Provjeri sastoji li se ime samo od slova; ako ne, crtaj login formu.
        if( !isset($_POST['email']) || !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) )
	    {
            $this->signup_failed("Email is not valid!");
            return;
	    }
        
        
        // Možda se ne šalje password; u njemu smije biti bilo što.
        if( !isset( $_POST["password"] ) ){
            $this->signup_failed("Password is empty!");
            return;
        }

        //provjeri je li password prazan
        if( $_POST['password'] === ""){
            $this->signup_failed("Password is not valid!");
            return;
        }
        
        // Sve je OK, provjeri jel ga ima u bazi.
        if( User::where('email', $_POST["email"] ) )
        {
            // Taj korisnik vec postoji. Ponovno crtaj login.
            $this->signup_failed( 'Taj korisnik već postoji.' );
            return;
        }
        else
        {
            //Prvo mu generiraj random string od 20 znakova za registracijski link.
            $reg_seq = '';
		    for( $i = 0; $i < 20; ++$i )
			    $reg_seq .= chr( rand(0, 25) + ord( 'a' ) );
            // Stvarno nema tog korisnika. Dodaj ga u bazu.
            $user = new User();
            $user->name = $_POST["name"];
            $user->surname = $_POST["surname"];
            $user->email = $_POST["email"];
            $user->password_hash = password_hash( $_POST['password' ], PASSWORD_DEFAULT );
            $user->has_registered = 0;
            $user->registration_sequence = $reg_seq;
            $user->type = "buyer";
            $user->save();

            // Sad mu jos posalji mail
		    $to       = $_POST['email'];
		    $subject  = 'Molimo potvrdite prijavu';
		    $message  = 'Poštovani/a ' . $user->name .' '. $user->surname .",\n\n";
            $message .= 'Dobrodošli i hvala što ste se prijavili. Kako bi dovršili proces prijave molimo Vas da potvrdite primitak ovog e-maila klikom na link: ';
		    $message .= 'http://'. $_SERVER['SERVER_NAME'] . __SITE_URL . '/index.php?rt=authentication/verify&registration_sequence=' . $reg_seq . 
            '&email=' . $_POST["email"] ."\n";
            $headers  = 'From: rp2@studenti.math.hr' . "\r\n" .
		            'Reply-To: rp2@studenti.math.hr' . "\r\n" .
		            'X-Mailer: PHP/' . phpversion();

		    $isOK = mail($to, $subject, $message, $headers);

		    if( !$isOK )
			    exit( 'Greska: ne mogu poslati mail. (Pokrenite na rp2 serveru.)' );

            // Sad ponovno nacrtaj login formu, tako da se user proba ulogirati.
            header( 'Location: index.php?rt=login' );
        }
    }

    public function verify()
    {
        if(!isset( $_GET["email"] ) || !isset( $_GET["registration_sequence"] ))
            echo "Nesto nije u redu";
        $user=User::where("email", $_GET["email"])[0];

        //Ako je ključna riječ točna napravi promjenu u bazi.
        if($user->registration_sequence === $_GET["registration_sequence"]){
            $user->has_registered = 1;
            $user->save();
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header( 'Location: index.php?rt=authentication/index' );
    }
};

?>