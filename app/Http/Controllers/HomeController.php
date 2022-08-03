<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemMaster;
use DataTables;
use App\Models\Subscribes;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {  
        if ($request->ajax()) {
           $data =  DB::table('item_master')
            ->select('containsName','description')
            ->join('subscriptions', 'subscriptions.item_id', '=', 'item_master.id')
            ->where('subscriptions.subscribeStatus', '1')
            ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" "class="subscribe btn btn-primary" id="subscribe">Subscribes</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
         }    
          return view('users.allSubscribes');
    }
}
