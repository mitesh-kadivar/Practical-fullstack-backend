<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $cartList = Cart::with(['user', 'product'])->get();

        try {
            return response()->json([
                'status' => config('constantapiresponse.success_status'),
                'message' => 'Cart list',
                'data' => $cartList ?? [],
            ], config('constantapiresponse.success_status_code'));

        } catch (\Throwable $th) {
            Log::error('--------something went wrong with cart list api ----------', [
                'Message' => $th->getMessage(),
                'Line' => $th->getLine(),
                'File' => $th->getFile(),
                'code' => $th->getCode(),
            ]);

            return response()->json([
                'status' => config('constantapiresponse.fail_status'),
                'message' => $th->getMessage(),
                'data' => null,
            ], config('constantapiresponse.fail_status_code'));
        }
    }
}
