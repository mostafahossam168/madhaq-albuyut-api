<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\FamilyResorce;
use App\Models\Family;
use Illuminate\Http\Request;

class FamilyUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $families = FamilyResorce::collection(Family::active()->paginate(num_pag()));
        return successResponse($families);
    }

    public function show($id)
    {
        $family = new FamilyResorce(Family::find($id));
        return successResponse($family);
    }
}
