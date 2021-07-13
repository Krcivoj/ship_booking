<?php


class ExcursionsController extends BaseController
{
    public function index()
    {
        $this->registry->template->show('excursions');
    }

    public function searchByPlace()
    {       
        if(!isset($_GET['place']))
            exit(0);
        $shipList = Ship::where('start_place', $_GET['place']);
        header( 'Content-type:application/json;charset=utf-8' );
        echo json_encode( $shipList );
        flush();
        exit( 0 );
    }

    public function searchByLocation()
    {
        if(!isset($_GET['location']))
            exit(0);
        $shipList = Ship::whereLike('locations', $_GET['location']);
        header( 'Content-type:application/json;charset=utf-8' );
        echo json_encode($shipList);
        flush();
        exit( 0 );
    }

}


?>