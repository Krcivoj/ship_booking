<?php 

class IndexController
{
	public function index() 
	{
		// Samo preusmjeri na users podstranicu.
		if( isset($_SESSION['user']))
			header( 'Location: index.php?rt=user' );
		else
			// header( 'Location: index.php?rt=login' );
			//Ovo je privremeno da radi
			header( 'Location: index.php?rt=users' );
	}
}; 

?>
