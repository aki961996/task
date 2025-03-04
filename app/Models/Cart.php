<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_name',
        
        'detail',
        'prize',
        'quantity',
        
        'product_id',
        'user_id',

    ];

    public static function getData($id)
    {
        // $cart = self::where('user_id', $id)->paginate(2);
        $cart = self::where('user_id', $id)->get();
        return $cart;
    }

      //getgetCartData
      public static function getCartData($userId)
      {
          $cartData = self::where('user_id', $userId)->get();
          return $cartData;
      }
}
