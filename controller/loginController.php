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
    else if( isset( $_POST["gumb" ] ) && $_POST["gumb"] === "novi" )
        $this->signup();
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
        if( !isset( $_POST["username"] ) || preg_match( '/[a-zA-Z]{1, 20}/', $_POST["username"] ) )
        {
            $this->login_failed();
            return;
        }

        // Možda se ne šalje password; u njemu smije biti bilo što.
        if( !isset( $_POST["password"] ) ){
            $this->login_failed();
            return;
        }
		//$user = $ss->getUserByName($_POST["username"]);
        $user = User::where('username', $_POST["username"])[0];

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
                header( 'Location: index.php?rt=user' );
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
        if( !isset( $_POST["username"] ) || preg_match( '/[a-zA-Z]{1, 20}/', $_POST["username"] ) )
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
        $db = DB::getConnection();

        try
        {
            $st = $db->prepare( 'SELECT password_hash FROM dz2_users WHERE username=:username' );
            $st->execute( array( 'username' => $_POST["username"] ) );
        }	
        catch( PDOException $e ) { $this->login_failed( 'Greška:' . $e->getMessage() ); return; }

        if( $st->rowCount() > 0 )
        {
            // Taj korisnik već postoji. Ponovno crtaj login.
            $this->login_failed( 'Taj korisnik već postoji.' );
            return;
        }
        else
        {
            // Stvarno nema tog korisnika. Dodaj ga u bazu.
            try
            {
                // Prvo pripremi insert naredbu.
                $st = $db->prepare( 'INSERT INTO dz2_users(username, password_hash, email, registration_sequence, has_registered) VALUES (:username, :password_hash, \'a@b.com\', \'abc\', \'1\')' );

                // Napravi hash od passworda kojeg je unio user.
                $hash = password_hash( $_POST["password"], PASSWORD_DEFAULT );

                // Izvrši sad tu insert naredbu. Uočite da u bazu stavljamo hash, a ne $_POST["password"]!
                $st->execute( array( 'username' => $_POST["username"], 'password_hash' => $hash ) );
            }
            catch( PDOException $e ) { $this->login_failed( 'Greška:' . $e->getMessage() ); return; }

            // Sad ponovno nacrtaj login formu, tako da se user proba ulogirati.
            $this->login_failed( 'Novi korisnik je uspješno dodan!' );//treba promjeniti
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