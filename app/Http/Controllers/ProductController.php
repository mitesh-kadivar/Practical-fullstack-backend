<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => config('constantapiresponse.success_status'),
                'message' => 'Products list',
                'data' => [Product::latest()->paginate()],
            ], config('constantapiresponse.success_status_code'));

        } catch (\Throwable $th) {
            Log::error('--------something went wrong with product list api ----------', [
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

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);

        try {
            return response()->json([
                'status' => config('constantapiresponse.success_status'),
                'message' => 'Product details listing',
                'data' => $product ?? [],
            ], config('constantapiresponse.success_status_code'));

        } catch (\Throwable $th) {
            Log::error('--------something went wrong with product Details api ----------', [
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
