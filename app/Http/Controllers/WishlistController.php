<?php

namespace App\Http\Controllers;

use App\Models\Wishlists;

class WishlistController extends Controller
{
    public function add()
    {
        $wishlist = session()->get('wishlist', []);
        $product = ["product_id" => 9, "name" => "ASUS", "price" => 1600];
        $wishlist[$product['product_id']] = $product;
        session()->put('wishlist', $wishlist);
        Wishlists::create($product);

        return response(["message" => "ok"]);
    }

    public function delete($product_id)
    {
        $wishlist = session()->get('wishlist', []);

        if (!isset($wishlist[$product_id])) {
            return response(["message" => "Product with product_id:$product_id not found in wishlist"], 404);
        }

        $productInDb = Wishlists::where('product_id', $product_id)->first();
        if (!$productInDb) {
            return response(["message" => "Product with product_id:$product_id not found in database"], 404);
        }

        unset($wishlist[$product_id]);
        session()->put('wishlist', $wishlist);

        $productInDb->delete();

        return response(["message" => "Product with product_id:$product_id deleted from wishlist"], 200);
    }

    public function clear()
    {
        session()->forget('wishlist');

        Wishlists::query()->delete();

        return response(["message" => "Wishlist cleared"], 200);
    }

    public function getAllProducts()
    {
        $wishlist = session()->get('wishlist', []);

        return response(['wishlist' => $wishlist], 200);
    }

    public function get($id)
    {
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$id])) {
            return response(['wishlist' => $wishlist[$id]], 200);
        }

        return response(['message' => "Product not found in wishlist"], 404);
    }
}
