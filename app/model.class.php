<?php 

// Zadatak (srednje-dosta težak.)
// Ovo je samo kostur apstraktne klase Model.
// Trebate sami napisati implementaciju svih funkcija tako da rade kao što je opisano.
// Uputa: trebat ćete koristiti funkcije poput get_called_class(), kao i stvari poput $obj = new $className();
//
// Pogledajte i moguće dodatne funkcije i relacije ovdje:
// https://laravel.com/docs/master/eloquent
// https://laravel.com/docs/master/eloquent-relationships


require_once __DIR__ . '/../app/database/db.class.php';

spl_autoload_register( function ($class_name) 
{
    $fileName = __DIR__ . '/' . strtolower($class_name) . '.class.php';

    if( file_exists( $fileName ) === false )
        return false;

    require_once $fileName;

    return true;
} );


abstract class Model
{
    // Tablica u bazi podataka pridružena modelu. Svaka izvedena klase će definirati svoju.
    protected static $table = null;
    protected static $attributes = [];

    // Asocijativno polje $columns:
    // - ključevi = imena stupaca u bazi podataka u tablici $table;
    // - svakom ključu je pridružena vrijednost koja u bazi piše za objekt $this (onaj čiji je id jedak $this->id).
    protected $columns = [];

    public function __get( $col )
    {
        // Omogućava da umjesto $this->columns['name'] pišemo $this->name.
        // (uoči: $this->columns može ostati protected!)
        if( isset( $this->columns[ $col ] ) )
            return $this->columns[ $col ];

        return null;
    }

    public function __set( $col, $value )
    {
        // Omogućava da umjesto $this->columns['name']='Mirko' pišemo $this->name='Mirko'.
        // (uoči: $this->columns može ostati protected!)
        $this->columns[$col] = $value;

        return $this;
    }

    protected function construct(){}

    public static function all()
    {
        // TODO:
        // Funkcija vraća polje koje sadrži sve objekte iz tablice $table.
        $className = get_called_class();
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM ' . $className::$table );
			$st->execute( );
		}
		catch( PDOException $e ) { exit( 'PDO (all) error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$obj = new $className();
            foreach($className::$attributes as $attribut=>$type){
                settype($row[$attribut], $type);
                $obj->$attribut = $row[$attribut];
            }
            $obj->construct();
            $arr[] = $obj;
		}

		return $arr;
    }


    public static function find( $id )
    {
        // TODO:
        // Funkcija vraća onaj (jedini!) objekt iz tablice $table kojem je id jednak $id.
        $thisClassName = get_called_class();
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM ' . $thisClassName::$table .' WHERE id=:id' );
			$st->execute( array( 'id' => $id ) );
		}
		catch( PDOException $e ) { exit( 'PDO (find) error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
        {
            $obj = new $thisClassName();
            foreach($thisClassName::$attributes as $attribut=>$type){
                settype($row[$attribut], $type);
                $obj->$attribut = $row[$attribut];
            }
            $obj->construct();
            return $obj;
        }
    }

    public static function where( $column, $value )
    {
        // TODO:
        // Funkcija vraća polje koje sadrži sve objekte iz tablice $table kojima u stupcu $column piše vrijednost $value.
        $thisClassName = get_called_class();
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM ' . $thisClassName::$table . ' WHERE '. $column . '=:column');
			$st->execute( array( 'column' => $value ) );
		}
		catch( PDOException $e ) { exit( 'PDO (where) error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$obj = new $thisClassName();
            foreach($thisClassName::$attributes as $attribut=>$type){
                settype($row[$attribut], $type);
                $obj->$attribut = $row[$attribut];
            }
            $obj->construct();
            $arr[] = $obj;
		}

		return $arr;
    }

    public static function whereLike($column, $value)
    {
        //Kao where sano se ovdije ne provjerava jednakost nego se koristi ključna riječ LIKE
        $thisClassName = get_called_class();
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM ' . $thisClassName::$table . ' WHERE '. $column . 'LIKE :column');
			$st->execute( array( 'column' => $value ) );
		}
		catch( PDOException $e ) { exit( 'PDO (where) error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$obj = new $thisClassName();
            foreach($thisClassName::$attributes as $attribut=>$type){
                settype($row[$attribut], $type);
                $obj->$attribut = $row[$attribut];
            }
            $obj->construct();
            $arr[] = $obj;
		}

		return $arr;
    }

    public function belongsTo( $className, $foreign_key )
    {
        // TODO
        // Objekt $this ima svojstvo $foreign_key koje predstavlja strani ključ. Taj strani ključ je id od objekta klase
        // $className. Funkcija vraća taj objekt (tipa $className).
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM ' . $className::$table .' WHERE id=:id' );
			$st->execute( array( 'id' => $this->$foreign_key ) );
		}
		catch( PDOException $e ) { exit( 'PDO (belongsTo) error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
        {
            $obj = new $className();
            foreach($className::$attributes as $attribut=>$type){
                settype($row[$attribut], $type);
                $obj->$attribut = $row[$attribut];
            }
            $obj->construct();
            return $obj;
        }
    }

    public function hasMany( $className, $foreign_key )
    {
        // TODO
        // Objekt $this ima puno objekata tipa $className.
        // U tablici od $className postoji stupac s imenom $foreign_key sadrži id-ove objekata istog tipa kao što je $this.
        // Objekti čiji je $foreign_key jednak $this->id su oni koji pripadaju $this-u.
        // Funkcija vraća polje tih objekata (tipa $className).
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM ' . $className::$table . ' WHERE '. $foreign_key . '=:id');
			$st->execute( array( 'id' => $this->id ) );
		}
		catch( PDOException $e ) { exit( 'PDO (hasMany) error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$obj = new $className();
            foreach($className::$attributes as $attribut=>$type){
                settype($row[$attribut], $type);
                $obj->$attribut = $row[$attribut];
            }
            $obj->construct();
            $arr[] = $obj;
		}

		return $arr;
    }    

    public function hasOne( $className, $foreign_key )
    {
        // TODO
        // Kao hasMany, ali postoji samo jedan takav objekt.
        // Funkcija vraća taj jedan objekt (a ne polje).
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM ' . $className::$table . ' WHERE '. $foreign_key . '=:id');
			$st->execute( array( 'id' => $this->id ) );
		}
		catch( PDOException $e ) { exit( 'PDO (hasOne) error ' . $e->getMessage() ); }

        $row = $st->fetch();
		if( $row === false )
			return null;
		else
        {
            $obj = new $className();
            foreach($className::$attributes as $attribut)
                $obj->$attribut = $row[$attribut];
            $obj->construct();
            return $obj;
        }
    }
    

    public function save()
    {
        // TODO: Možda se može bolje napravit?
        // Funkcija sprema novi ili ažurira postojeći redak u tablici $table koji pripada objektu $this.
        // ($this->id je ključ u tablici $table).
        $thisClassName = get_called_class();
        
        $keys = '';
        $values = '';
        $keyValue = array();
        foreach($thisClassName::$attributes as $attribut => $type)
        {
                $keys .= $attribut . ', ';
                $values .= ':' . $attribut . ', ';
                $keyValue[$attribut] =  $this->$attribut;
        }
        $keys = substr($keys, 0, -2);
        $values = substr($values, 0, -2);

        try
        {
            $db = DB::getConnection();
            $st = $db->prepare( 'REPLACE INTO ' . $thisClassName::$table . '('. $keys .') VALUES (' . $values . ')' );
            
            $st->execute( $keyValue );
        }
        catch( PDOException $e ) { exit( "PDO error [save]: " . $e->getMessage() ); }
        }
}

?>
