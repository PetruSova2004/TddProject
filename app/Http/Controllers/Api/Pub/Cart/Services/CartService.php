<?php

namespace App\Http\Controllers\Api\Pub\Cart\Services;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class CartService extends Controller
{
    public function getUserCart(User $user): array|bool
    {
        $cartProducts = DB::table('products')
            ->join('carts', 'products.id', '=','carts.product_id')
            ->where('user_id', $user->id)
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

    public function getSpecificCartProducts($productId, User $user): Builder
    {
        $query = Cart::query()->where('product_id', $productId)
            ->where('user_id', $user->id);

        return $query;
    }

    public function addProductsToCart($productId, $quantity, User $user): void
    {
        $existProduct = Cart::query()
            ->where('product_id', $productId)
            ->where('user_id', $user->id)
            ->first();

        if ($existProduct) {
            $existProduct['quantity'] += $quantity;
            $existProduct->save();
        } else {
            Cart::query()->create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }
    }

}
