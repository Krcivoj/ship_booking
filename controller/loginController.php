<?php

require_once __DIR__ . '/../model/product.class.php';
require_once __DIR__ . '/../model/user.class.php';
require_once __DIR__ . '/../model/sale.class.php';

class LoginController
{
    public function index()
    {
		$title = 'login';
		$message = '';
        if( isset( $_POST["gumb" ] ) && $_POST["gumb"] === "login" )
            $this->login();
        else if( isset( $_POST["gumb" ] ) && $_POST["gumb"] === "novi" ){
            header( 'Location: index.php?rt=signup' );
            return;
        }
        else
            require_once __DIR__ . '/../view/login.php';

    }

    private function login_failed($message = '')
    {
        $title = 'login failed';

		require_once __DIR__ . '/../view/login.php';
    }

    public function login()
    {
        // Provjeri sastoji li se ime samo od slova; ako ne, crtaj login formu.
        if( !isset($_POST['email']) || !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) )
	    {
		    $this->message = "Email is not valid!";
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

    // Funkcija koja procesira što se dogodi nakon klika na gumb "Stvori novog korisnika!"
    public function signup()
    {
        // Provjeri sastoji li se ime samo od slova; ako ne, crtaj login formu.
        if( !isset( $_POST["email"] ) /*|| preg_match( '/[a-zA-Z]{1, 20}/', $_POST["username"] )*/ )
        {
            $this->login_failed();
            return;
        }

        // Možda se ne šalje password; u njemu smije biti bilo što.
        if( !isset( $_POST["password"] ) )
        {
            $this->login_failed();
            return;
        }

        // Sve je OK, provjeri jel ga ima u bazi.
        if( User::where('email', $_POST["email"] ) )
        {
            // Taj korisnik već postoji. Ponovno crtaj login.
            $this->login_failed( 'Taj korisnik već postoji.' );
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
            $user->type = "owner";
            $user->save();

            // Sad mu još pošalji mail
		    $to       = $_POST['email'];
		    $subject  = 'Registration mail';
		    $message  = 'For validation click this: ';
		    $message .= 'http://' . $_SERVER['SERVER_NAME'] . htmlentities( dirname( $_SERVER['PHP_SELF'] ) ) . '/index.php?rt=login/verify&registration_sequence=' . $reg_seq . 
            '&email=' . $_POST["email"] ."\n";
            $headers  = 'From: rp2@studenti.math.hr' . "\r\n" .
		            'Reply-To: rp2@studenti.math.hr' . "\r\n" .
		            'X-Mailer: PHP/' . phpversion();

		    $isOK = mail($to, $subject, $message, $headers);

		    if( !$isOK )
			    exit( 'Greška: ne mogu poslati mail. (Pokrenite na rp2 serveru.)' );

            // Sad ponovno nacrtaj login formu, tako da se user proba ulogirati.
            $this->login_failed( 'Novi korisnik je uspješno dodan!' );//treba promjeniti
        }
    }

    public function verify()
    {
        if(!isset( $_GET["email"] ) || !isset( $_GET["registration_sequence"] ))
            echo "Nesto nije u redu";
        $user=User::where("email", $_GET["email"])[0];
        if($user->registration_sequence === $_GET["registration_sequence"]){
            echo "mjenjam bool";
            $user->has_registered = 1;
            $user->save();
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header( 'Location: index.php?rt=login/index' );
    }
};

?>