<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Server;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index()
    {
        $servers = Server::with('subServers')->get();
        return response()->json([
            'status' => true,
            'servers' => $servers
        ], 200);
    }

    public function plans()
    {
        $plans = Plan::where('id', '!=', 1)->get();
        return response()->json([
            'status' => true,
            'plans' => $plans
        ], 200);
    }
}
