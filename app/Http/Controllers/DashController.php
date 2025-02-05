<?php

namespace App\Http\Controllers;

use App\Models\Crud;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashController extends Controller
{
    
    public function index(Request $request): View
{
    $query = DB::table('cruds')
        ->join('users', 'users.id', '=', 'cruds.iduser')
        ->select('cruds.title','cruds.id')
        ->latest('cruds.created_at');

    if ($request->has('cari')) {
        $data = $query->where('title', 'like', '%' . $request->input('cari') . '%')->paginate(10);
    } else {
        $data = $query->paginate(10);
    }

    return view('dashboard.dash-user', compact('data'));
}

    

}
    
