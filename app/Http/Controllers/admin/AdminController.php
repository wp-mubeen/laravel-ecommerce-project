<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ModelCategories;
use App\Models\ModelOrder;
use App\Models\ModelProducts;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $allUsers = User::all();

       $user = auth()->user();

       $totalproducts = ModelProducts::count();
       $totalcatg = ModelCategories::count();
       $totalusers = User::count();

       return view('admin.overview',['totalcatg' => $totalcatg ,'totalproducts' => $totalproducts , 'totalusers' => $totalusers , 'users' => $allUsers, 'user' =>$user]);
    }


    public function listUsers(Request $request)
    {
        $user = auth()->user();
        $allUsers = User::paginate(10);

       if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $deleteButton2 = '<form method="get" action="/admin/users/'. $row->id.'" accept-charset="UTF-8" style="display:inline">

                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete User" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>';
                    //return $updateButton." ".$deleteButton;
                    return $deleteButton2;

                })
                ->make(true);
        }



       return view('admin.all-users',[ 'users' => $allUsers,  'user' =>$user ]);
    }

    public function AllOrders(Request $request){
        $user = auth()->user();

        if ($request->ajax()) {
            $data = ModelOrder::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $deleteButton1 = '<a href="/order-detail/'. $row->id.'" ><button type="button" class="btn btn-success btn-sm" title="View User" >View</button></a>';
                    $deleteButton2 = '<form method="get" action="/admin/order/'. $row->id.'" accept-charset="UTF-8" style="display:inline">

                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete User" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>';
                    return $deleteButton1.' '.$deleteButton2;

                })
                ->make(true);
        }



        return view('admin.orders.all-orders',[   'user' =>$user ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function deleteuser($id)
    {
        User::destroy($id);
        return redirect()->back()->with('message', 'User deleted!');
    }

    public function DeleteOrder($id)
    {
        ModelOrder::destroy($id);
        return redirect()->back()->with('message', 'Order deleted!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('message', 'User deleted!');
    }
}
