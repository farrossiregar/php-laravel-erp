<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;

class SitesController extends Controller
{
    public function getAll()
    {
        return response()->json(Site::limit(100)->get(), 200);
    }
}
