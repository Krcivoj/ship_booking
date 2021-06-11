<?php

require_once __DIR__ . '/../model/product.class.php';
require_once __DIR__ . '/../model/user.class.php';
require_once __DIR__ . '/../model/sale.class.php';

class ProductController
{
    public function index()
    {
        header( 'Location: index.php?rt=product/search' );
    }

    public function new()
    {
        if(!isset($_POST['name']) && !isset($_POST['price']) &&  !isset($_POST['description']))
        {
            require_once __DIR__ . '/../view/product_new.php';
            return;
        }
        $user =unserialize($_SESSION['user']);
        $product = new Product();

        $product->id_user = $user->id;
        $product->name = $_POST['name'];
        $product->price = (float)$_POST['price'];
        $product->description = $_POST['description'];
        $product->save();
        header('Location: index.php?rt=user/index');
    }
    
    public function search()
    {
 		$title = 'Search';
		$user =unserialize($_SESSION['user']);
		$username = $user->username;
        $productList = [];
        $heading = '';
        if(isset($_POST['search']))
        {
            $heading = 'SEARCH RESULTS FOR: ' . $_POST['search'];
            $param = '%' . $_POST['search'] . '%';
		    $productList = Product::whereLike($param);
        }
		require_once __DIR__ . '/../view/product_search.php';
    }

    public function buy()
    {
        $sale = new Sale();
        $user = unserialize($_SESSION['user']);

        $sale->id_product = $_POST['id_product'];
        $sale->id_user = $user->id;
        $sale->save();
        header('Location: index.php?rt=product/show&id_product=' . $_POST['id_product']);
    }

    public function comment()
    {
        $user = unserialize($_SESSION['user']);
        $sale = Sale::find($_POST['id']);
        $sale->rank = $_POST['rank'];
        $sale->comment = $_POST['comment'];
        $sale->save();
        header('Location: index.php?rt=product/show&id_product=' . $sale->id_product);
    }

    public function show()
    {
        if(!isset($_GET['id_product']))
        {
            require_once __DIR__ . '/../view/404_index.php';
            echo print_r($_GET);
            return;
        }
        $user = unserialize($_SESSION['user']);
		$username = $user->username;
        require_once __DIR__ . '/../view/_header.php';

        $product = Product::find( $_GET['id_product']);
        require_once __DIR__ . '/../view/product_index.php';

        $saleList = $product->hasMany('Sale', 'id_product');
        $saller = false;
        $user_s = $product->belongsTo('User', 'id_user');
        if($user_s->id === $user->id)
                $saller = true;
        
        $bought = false;
        $commented = false;
        $sale_d = null;
        foreach($saleList as $sale)
        {
            $user_c = $sale->belongsTo('User', 'id_user');
            if($user_c->id === $user->id)
            {
                $bought = true;
            }

            if(!isset($sale->rating))
            {
                if($user_c->id === $user->id)
                {
                    $bought = true;
                    $commented = false;
                    $sale_d = $sale;
                }
                else
                    require __DIR__ . '/../view/sale_index.php';  
            }    
        }
        if(!$saller && !$bought)
            require_once __DIR__ . '/../view/product_buy.php';

        if($bought && !$commented)
            require_once __DIR__ . '/../view/product_comment.php';

        require_once __DIR__ . '/../view/_footer.php';
    }
};

?>