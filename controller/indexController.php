<?php 

class IndexController
{
	public function index() 
	{
		// Samo preusmjeri na product podstranicu.
		if( isset($_SESSION['user']))
			header( 'Location: index.php?rt=product' );
		else
			// header( 'Location: index.php?rt=login' );
			//Ovo je privremeno da radi
			header( 'Location: index.php?rt=product' );
	}
}; 

?>
