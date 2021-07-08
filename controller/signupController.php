<?php

class SignupController extends BaseController
{
    public function index()
    {
		$this->registry->template->title = 'Sign up';
		$this->registry->template->message = '';
        if( isset( $_POST["novi" ] ) && $_POST["novi"] === "novi" )
            $this->signup();
        else
            $this->registry->template->show('signup');

    }

    private function signup_failed($message = '')
    {
        $this->registry->template->title = 'Sign up failed';
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
            $this->signup_failed( 'Taj korisnik vec postoji.' );
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
		    $subject  = 'Registration mail';
		    $message  = 'For validation click this: ';
		    $message .= 'http://' . $_SERVER['SERVER_NAME'] . htmlentities( dirname( $_SERVER['PHP_SELF'] ) ) . '/index.php?rt=signup/verify&registration_sequence=' . $reg_seq . 
            '&email=' . $_POST["email"] ."\n";
            $headers  = 'From: rp2@studenti.math.hr' . "\r\n" .
		            'Reply-To: rp2@studenti.math.hr' . "\r\n" .
		            'X-Mailer: PHP/' . phpversion();

		    $isOK = mail($to, $subject, $message, $headers);

		    if( !$isOK )
			    exit( 'Greska: ne mogu poslati mail. (Pokrenite na rp2 serveru.)' );

            // Sad ponovno nacrtaj login formu, tako da se user proba ulogirati.
            $this->signup_failed( 'Novi korisnik je uspjesno dodan!' );//treba promjeniti
        }
    }

    public function verify()
    {
        if(!isset( $_GET["email"] ) || !isset( $_GET["registration_sequence"] ))
            echo "Nesto nije u redu";
        $user=User::where("email", $_GET["email"])[0];
        if($user->registration_sequence === $_GET["registration_sequence"]){
            $user->has_registered = 1;
            $user->save();
        }
    }
};

?>