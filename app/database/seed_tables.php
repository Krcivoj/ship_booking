<?php

// Popunjavamo tablice u bazi "probnim" podacima.
require_once __DIR__ . '/db.class.php';

seed_table_users();
seed_table_ships();
seed_table_reservations();

exit( 0 );

// ------------------------------------------
function seed_table_users()
{
	$db = DB::getConnection();

	// Ubaci neke korisnike unutra
	try
	{
		$st = $db->prepare( 'INSERT INTO project_users(name, surname,  
													   email, password_hash, 
													   registration_sequence, 
													   has_registered, type) 
							VALUES (:name, :surname, :email, 
									:password, :registration_sequence, :has_registered, :type)' );

		$st->execute( array( 'name' => 'Mirko', 'surname' => 'Mirković' , 'password' => '', 'email' => 'mirko.mirkovic@m.com', 'registration_sequence' => '', 'has_registered' => '0', 'type' => 'buyer' ) );
		$st->execute( array( 'name' => 'Slavko', 'surname' => 'Slavkić' , 'password' => password_hash( 'slavkovasifra', PASSWORD_DEFAULT ), 'registration_sequence' => 'abc', 'has_registered' => '1','email' => 'slavko.slavkic@s.com','type' => 'owner' ) );
		$st->execute( array( 'name' => 'Ana', 'surname' => 'Anić', 'password' => password_hash( 'aninasifra', PASSWORD_DEFAULT ), 'registration_sequence' => 'abc', 'has_registered' => '1','email' => 'ana.anic@a.com', 'type' => 'owner' ) );
		$st->execute( array( 'name' => 'Maja', 'surname' => 'Majić', 'password' => password_hash( 'majinasifra', PASSWORD_DEFAULT ), 'registration_sequence' => 'abc', 'has_registered' => '1','email' => 'maja.majic@m.com', 'type' => 'registered' ) );
		$st->execute( array( 'name' => 'Pero', 'surname' => 'Perić' , 'password' => password_hash( 'perinasifra', PASSWORD_DEFAULT ), 'registration_sequence' => 'abc', 'has_registered' => '1','email' => 'pero.peric@p.com', 'type' => 'registered' ) );
	}
	catch( PDOException $e ) { exit( "PDO error project_users: " . $e->getMessage() ); }

	echo "Ubacio u tablicu project_users.<br />";
}


// ------------------------------------------
function seed_table_ships()
{
	$db = DB::getConnection();

	// Ubaci neke proizvode unutra (ovo nije bas pametno ovako raditi, preko hardcodiranih id-eva usera)
	try
	{
		$st = $db->prepare( 'INSERT INTO project_ships(id_owner, name, capacity, 
													   price_kids, price_adults, 
													   locations, description,
													   departure_time, arrival_time, 
													   start_place, start_lat, 
													   start_lon, animal_friendly) 
							VALUES (:id_owner, :name, :capacity, 
									:price_kids, :price_adults,
									:locations, :description,
									:departure_time, :arrival_time,
									:start_place, :start_lat,
									:start_lon, :animal_friendly )' );

		$st->execute( array('id_owner' => 2, 'name' => 'Marlena', 'capacity' => 50,
							':price_kids' => 120, ':price_adults' => 220,
							'locations' => 'Plavnik,Uvala Krusija,Ljubavna spilja,Zlatna plaza',
							'description' => 'Provedite svoj dan kupajući se na najljepšim lokacijama u okolini Krka. Lokacije koje je moguće posjetiti jedino brodom! Zabava na brodu i izvan njega zagarantirana.', 
							'departure_time' => '11:00:00', 'arrival_time' => '17:00:00',
							'start_place' => 'Punat', 'start_lat' => 45.0088199647, 
							'start_lon' => 14.6240041706, 'animal_friendly' => 0 ) ); // mirko
		$st->execute( array('id_owner' => 2, 'name' => 'SeaDream', 'capacity' => 30,
							':price_kids' => 175, ':price_adults' => 290,
							'locations' => 'Plavnik,Uvala Krusija,Mali Plavnik,Cres',
							'description' => 'Pridružite nam se na avanturističkom putovanju na četiri otoka i istražite prekrasnu prirodu oko sebe. Povedite obitelj i prijatelje sa sobom i uronite u mediteranski duh. Plivajte i osunčajte svoj odmor i podignite svoj odmor na potpuno novu razinu!', 
							'departure_time' => '09:30:00', 'arrival_time' => '18:00:00',
							'start_place' => 'Krk', 'start_lat' => 45.02583, 
							'start_lon' =>  14.57306,'animal_friendly' => 1 ) );
		$st->execute( array('id_owner' => 2, 'name' => 'Nemo', 'capacity' => 40,
							':price_kids' => 150, ':price_adults' =>300,
							'locations' => 'Plavnik,Uvala Krusija,Ljubavna spilja,Otok Sveti Grgur',
							'description' => 'Da Vaš odmor bude potpun, nudimo Vam jedinstveno iskustvo tradicionalnog ulova ribe uz obilazak poznatih lokacija. Ispraćeni zvukovima galeba krenut ćemo ploviti
							plavetnilom Kvarnerića, gledajući prekrasne krajolike naše obale. Uz riblje zagriske, upoznat ćete ulov ribe kako to rade krčki ribari - povlačnom mrežom. Nakon ulova i prebiranja ribe,
							autohtonom ćemo kuhinjom zadovoljiti Vaša nepca ribom koju ste upravo sami ulovili. Kako bi avantura bila potpuna, ne propušta se ni kupanje u životopisnim kvarnerskim uvalama.', 
							'departure_time' => '09:00:00', 'arrival_time' => '17:45:00',
							'start_place' => 'Krk', 'start_lat' => 45.02583, 
							'start_lon' =>  14.57306, 'animal_friendly' =>1 ) );
		$st->execute( array('id_owner' => 3, 'name' => 'Veglia', 'capacity' => 80,
							':price_kids' => 250, ':price_adults' => 420,
							'locations' => 'Otok Sveti Grgur,Goli otok,Rajska plaza,Rab',
							'description' => 'Nudimo jedinstveni izlet, s potpuno drugačijom rutom od drugih izleta. Vodimo Vas u raj, na poznatu Rajsku plažu na otoku Rabu.
							No, prije ćemo pristati na predivnom tihom otočiću Sv. Grgur i zloglasni Goli otok. Budite drugačiji i pridružite nam se na putovanju!', 
							'departure_time' => '9:00:00', 'arrival_time' => '18:00:00',
							'start_place' => 'Malinska', 'start_lat' => 45.1333328 , 
							'start_lon' => 14.5333312, 'animal_friendly' =>0 ) );	
	}
	catch( PDOException $e ) { exit( "PDO error [project_ships]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu project_ships.<br />";
}


// ------------------------------------------
function seed_table_reservations()
{
	$db = DB::getConnection();

	// Ubaci neke prodaje unutra (ovo nije bas pametno ovako raditi, preko hardcodiranih id-eva usera i proizvoda)
	try
	{
		$st = $db->prepare( 'INSERT INTO project_reservations(id_buyer, id_ship, date_buy, date_trip,
															  ticket_baby,ticket_kids, ticket_adults, code, 
															  menu_meat, menu_fish, menu_veg, 
															  animals, rating, comment) 
							VALUES (:id_buyer, :id_ship, :date_buy, :date_trip,
									:ticket_baby,:ticket_kids, :ticket_adults, :code, 
									:menu_meat, :menu_fish, :menu_veg, 
									:animals, :rating, :comment)' );

		$st->execute( array('id_buyer' => 1, 'id_ship' => 1, 'date_buy' => '2021-06-21', 'date_trip' => '2021-07-10',
							'ticket_baby' => 1,'ticket_kids' => 2, 'ticket_adults' => 2, 'code' => 'a75jfbeo2bfzw5sncws',
							'menu_meat' => 4, 'menu_fish' => 0, 'menu_veg' => 0,
							'animals' => 0, 'rating' => 5, 'comment' => 'Very good experience. Try it yourself! Fun, fun, fun!'
		));
		$st->execute( array('id_buyer' => 4, 'id_ship' => 2, 'date_buy' => '2021-07-01', 'date_trip' => '2021-07-12',
							'ticket_baby' => 2,'ticket_kids' => 4, 'ticket_adults' => 5, 'code' => 'jcricnfbeo92fzw5snc',
							'menu_meat' => 4, 'menu_fish' => 4, 'menu_veg' => 1,
							'animals' => 2, 'rating' => 4, 'comment' => 'Expected more. Little bit boring and monotonous. But, service, safety, food great. '
		));
		$st->execute( array('id_buyer' => 3, 'id_ship' => 2, 'date_buy' => '2021-06-20', 'date_trip' => '2021-07-12',
							'ticket_baby' => 0,'ticket_kids' => 3, 'ticket_adults' => 2, 'code' => 'a75982hzr56fzwsncww',
							'menu_meat' => 0, 'menu_fish' => 0, 'menu_veg' => 5,
							'animals' => 1, 'rating' => 5, 'comment' => 'Very good, we enjoyed!'
		));
		$st->execute( array('id_buyer' => 2, 'id_ship' => 3, 'date_buy' => '2021-05-30', 'date_trip' => '2021-07-15',
							'ticket_baby' => 1,'ticket_kids' => 3, 'ticket_adults' => 5, 'code' => 'wa75jfbeo9298hz5ncw',
							'menu_meat' => 0, 'menu_fish' => 8, 'menu_veg' => 0,
							'animals' => 0, 'rating' => 5, 'comment' => 'Totally new experience, interesting and fun. Food is great and fresh!'
		));
		$st->execute( array('id_buyer' => 5, 'id_ship' => 3, 'date_buy' => '2021-6-10', 'date_trip' => '2021-07-21',
							'ticket_baby' => 0,'ticket_kids' => 0, 'ticket_adults' => 7, 'code' => 'a75jfbeo92fz7hgtr4f5',
							'menu_meat' => 0, 'menu_fish' => 7, 'menu_veg' => 0,
							'animals' => 0, 'rating' => null, 'comment' => null
		));
		$st->execute( array('id_buyer' => 4, 'id_ship' => 4, 'date_buy' => '2021-06-01', 'date_trip' => '2021-07-22',
							'ticket_baby' => 1,'ticket_kids' => 2, 'ticket_adults' => 2, 'code' => '4a75jfbelkjhgfdsncw',
							'menu_meat' => 1, 'menu_fish' => 3, 'menu_veg' => 0,
							'animals' => 0, 'rating' => null, 'comment' => null
		));
		

	}
	catch( PDOException $e ) { exit( "PDO error [project_reservations]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu project_reservations.<br />";
}

?> 
 
 