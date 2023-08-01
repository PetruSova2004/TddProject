<?php

namespace App\Http\Controllers\Api\Pub\Cart\Services;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class CartService extends Controller
{
    public function getUserCart(Authenticatable $user): array|bool
    {
        $cartProducts = DB::table('products')
            ->join('carts', 'products.id', '=', 'carts.product_id')
            ->where('user_id', $user->getAuthIdentifier())
            ->select('carts.quantity', 'carts.product_id', 'products.title', 'products.price', 'products.image_path')
            ->get();

        $cart = [];

        if (!$cartProducts->isEmpty()) {
            foreach ($cartProducts as $cartProduct) {
                $cart[] = [
                    'product_id' => $cartProduct->product_id,
                    'title' => $cartProduct->title,
                    'quantity' => $cartProduct->quantity,
                    'price_x1' => $cartProduct->price,
                    'image_path' => $cartProduct->image_path,
                ];
            }

            return $cart;
        } else {
            return false;
        }
    }

    public function getSpecificCartProducts($productId, Authenticatable $user): Builder
    {
        return Cart::query()->where('product_id', $productId)
            ->where('user_id', $user->getAuthIdentifier());
    }

    public function addProductsToCart($productId, $quantity, Authenticatable $user): void
    {
        $existProduct = Cart::query()
            ->where('product_id', $productId)
            ->where('user_id', $user->getAuthIdentifier())
            ->first();

        if ($existProduct) {
            $existProduct['quantity'] += $quantity;
            $existProduct->save();
        } else {
            Cart::query()->create([
                'user_id' => $user->getAuthIdentifier(),
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }
    }

}
