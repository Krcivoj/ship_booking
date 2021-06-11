<?php

class Product extends Model
{
	static protected $table = 'dz2_products';
    static protected $attributes  = ['id', 'id_user', 'name', 'description', 'price'];

    protected function construct()
    {
        $this->feedback();
    }

    public function feedback()
    {
        $salesList = $this->hasMany('Sale', 'id_product');
        $this->rating = 0;
        $this->count = 0;
        foreach($salesList as $sale)
        {
            $this->rating += $sale->rating;
            $this->count++;
        }
        if( $this->count !== 0)
            $this->rating /= $this->count;
    }
}

?>