<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemMaster;
use DataTables;
use App\Models\Subscribes;
use DB;

class SubscribesController extends Controller
{
 
 // For Display 
	public function index(Request $request) {
		if ($request->ajax()) {
            $data = ItemMaster::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
      				    $id = $row->id;
                        $btn = '<a href="javascript:void(0)" data-id="' . $id . '"class="subscribe btn btn-primary" id="subscribe">Subscribes</a>';
                    	return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
       	return view('users.subscription');
	}

// Subscribes Users

	public function subscribeUsers(Request $request) 
	{
        try{
        	$subdata = DB::table('subscriptions')->where('id', $request->id)->get();
        	foreach ($subdata as $subsvalue) {
        	}
         
        	$numData = count($subdata);
	    	if($numData == 1) {
	        	if($subsvalue->subscribeStatus == 1 ){
	        		$data = Subscribes::where('id', $request->id)->update(array('subscribeStatus' => '0'));
	        		 return response()->json([
			          'status'    => 200,
			          'message' => "User Un-Subscribes!!!!"
			        ]);
	         	}else 
	         		$data = Subscribes::where('id', $request->id)->update(array('subscribeStatus' => '1'));
	        		 return response()->json([
			          'status'    => 200,
			          'message' => "User Subscribes Update!!!!"
			        ]);
	        }else{
	        	$subscribes = new Subscribes();
				$subscribes->item_id = $request->id;
				$subscribes->subscribeStatus = "1";
				$subscribes->save();
			    return response()->json([
		          'status'    => 200,
		          'message' => "User Subscribed!!!!"
		        ]);
	        }

       } catch (Exception $e) {
		     return $e->getMessage();
		}
	
	}

// End Of Class
}
