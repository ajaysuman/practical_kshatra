<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemMaster;
use DataTables;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ItemMaster::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
      				    $id = $row->id;
                        $btn = '<a href="javascript:void(0)" data-id="' . $id . '"class="edit btn btn-primary" id="edit">Edit</a>'." ".'<a href="javascript:void(0)" class="softdelete btn btn-danger btm-sm" id="softdelete">Delete</a>';
                
                    	return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('users.itemListing');
    }

    // ++++++++++++++++++++ Add Items ++++++++++++++++++++

    public function addItem(Request $request) 
    {
    	try {
		     $newItems = new ItemMaster();
			 $newItems->containsName = $request->containsName;
			 $newItems->description = $request->description;
			 $newItems->redUrl = $request->url;
			 if($newItems->save() == 1){
				return response()->json([
		          'status'    => 200,
		          'message' => "Insert User Success..!!!!"
		        ]);
	 		}else{
	 			return response()->json([
		          'status'    => 400,
		          'message' => "Insert Faild..!!!!"
	        	]);
	 		}
		}catch (Exception $e) {
		     return $e->getMessage();
			}	
    }


    // For EditCustomer
	public function editUser(Request $request) {
		try {
			$ItemsData = ItemMaster::where('id', $request->id)->get();
	 		return $ItemsData;
		}catch (Exception $e) {
		     return $e->getMessage();
			}
	}

// FOR UPDATE
	public function updateUser(Request $request) {
		try{
			$data = ItemMaster::where('id', $request->id)->update(array('containsName' => $request->containsName, 'description' => $request->description, 'redUrl' => $request->url));
		   
		    return response()->json([
	          'status'    => 200,
	          'message' => "Update Data Success!!!!"
	        ]);

       } catch (Exception $e) {
		     return $e->getMessage();
			}
	 }

// For Delete
	public function destroy(Request $request) {  
	  	try {
	 		 ItemMaster::find($request->id)->delete();
		     return response()->json([
	          'status'    => 200,
	          'message' => "Delete Data Success!!!!"
	        ]);
	   }catch (Exception $e) {
		     return $e->getMessage();
			}
	}

}
