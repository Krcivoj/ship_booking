<?php


require_once __DIR__ . '/db.class.php';

create_table_users();
create_table_ships();
create_table_reservations();

exit( 0 );

// --------------------------
function has_table( $tblname )
{
	$db = DB::getConnection();
	
	try
	{
		$st = $db->query( 'SELECT DATABASE()' );
		$dbname = $st->fetch()[0];

		$st = $db->prepare( 
			'SELECT * FROM information_schema.tables WHERE table_schema = :dbname AND table_name = :tblname LIMIT 1' );
		$st->execute( ['dbname' => $dbname, 'tblname' => $tblname] );
		if( $st->rowCount() > 0 )
			return true;
	}
	catch( PDOException $e ) { exit( "PDO error [show tables]: " . $e->getMessage() ); }

	return false;
}


function create_table_users()
{
	$db = DB::getConnection();

	if( has_table( 'project_users' ) )
		exit( 'Tablica project_users vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS project_users (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'name varchar(20) NOT NULL,' .
			'surname varchar(20) NOT NULL,' . 
			'email varchar(50) NOT NULL,' .
			'password_hash varchar(255) NOT NULL,'.
			'registration_sequence varchar(20) NOT NULL,' .
			'has_registered int,' .
			'type varchar(15))'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create project_users]: " . $e->getMessage() ); }

	echo "Napravio tablicu project_users.<br />";
}


function create_table_ships()
{
	$db = DB::getConnection();

	if( has_table( 'project_ships' ) )
		exit( 'Tablica project_ships vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS project_ships (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_owner int NOT NULL,' .
            'name varchar(50) NOT NULL,' .
			'capacity int NOT NULL,' .
			'price_kids decimal(15,2) NOT NULL,' .
			'price_adults decimal(15,2) NOT NULL,' .
			'web_link varchar(1000),' .
			'locations varchar(1000) NOT NULL,' .
			'description varchar(1000) NOT NULL,' .
			'departure_time time NOT NULL,' .
			'arrival_time time NOT NULL,' .
			'start_place varchar(50) NOT NULL,' .
			'start_lat float NOT NULL,' .
			'start_lon float NOT NULL,' . 
			'animal_friendly bool NOT NULL)'
            );

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create project_ships]: " . $e->getMessage() ); }

	echo "Napravio tablicu project_ships.<br />";
}


function create_table_reservations()
{
	$db = DB::getConnection();

	if( has_table( 'project_reservations' ) )
		exit( 'Tablica project_reservations vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS project_reservations (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_buyer int NOT NULL,' .
			'id_ship int NOT NULL,' .
			'date_buy date NOT NULL,' .
			'date_trip date NOT NULL,' .
			'ticket_kids int NOT NULL,' .
			'ticket_adults int NOT NULL,' .
			'code varchar(20) NOT NULL,' .
			'menu_meat int NOT NULL,' .
			'menu_fish int NOT NULL,' .
			'menu_veg int NOT NULL,' .
			'animals int,' .
			'rating int,' .
			'comment varchar(1000))'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create project_reservations]: " . $e->getMessage() ); }

	echo "Napravio tablicu project_reservations.<br />";
}

?> 