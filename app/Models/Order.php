<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'orders';

    protected $guarded = [];

    /**
     * Get all the products for the order.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id');
    }
    //////// Ne pas oublier de réucpérer la quantité de chaque produit et mettre le détail sur un pdf à part

    /**
     * Get all the address for the product. => facturation et livraison
     */
    public function address()
    {
        return $this->belongsToMany(Address::class, 'order_address', 'order_id', 'address_id');
    }
    /**
     * Get the invoice for the order.
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    //Relation polymorph manytomany with tags
    /**
     * Get all of the tags for the orders.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }


    //Relation polymorph one to many with companies and customers
     /**
     * Get all of the model that are assigned this order.
     */
    public function model()
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
       
    }
}
