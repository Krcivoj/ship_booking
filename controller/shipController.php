<?php 

class UsersController extends BaseController
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

    public function reservation()
    {
        if(isset($_SESSION['user']))
        {
            $user = unserialize($_SESSION['user']);
            if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['adults'])
                && isset($_POST['kids']) && isset($_POST['babies'])){
                
            }

        }
    }
}; 

?>