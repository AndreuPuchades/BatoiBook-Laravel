<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\JsonResponse;

class FamilyController extends Controller
{
    public function index(): JsonResponse
    {
        $families = Family::all();
        return response()->json($families, 200);
    }
}
