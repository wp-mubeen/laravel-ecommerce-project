<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ModelCategories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $allCategories = ModelCategories::all();
        $user = auth()->user();
       return view('admin.categories.index',['allCategories' => $allCategories, 'user' => $user ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        $allCategories = ModelCategories::all();
        return view('admin.categories.create',['allCategories' => $allCategories, 'user' => $user ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);


       $catslug = Str::slug($request->input('name'), "-");


        $request->request->add(['slug' => $catslug]);
        $input = $request->all();
        ModelCategories::create($input);
        return redirect('admin/categories')->with('message', 'Category Added!');
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
        $user = auth()->user();
        $category = ModelCategories::find($id);

        $allCategories = ModelCategories::all();
        return view('admin.categories.edit',['allCategories' => $allCategories, 'category'=>$category , 'user' => $user ]);
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
        $request->validate([
            'name' => 'required'
        ]);

        $category = ModelCategories::find($id);

        $catslug = Str::slug($request->input('name'), "-");

        $request->request->add(['slug' => $catslug]);
        $inputData = $request->all();

        $category->update($inputData);


        return redirect('admin/categories')->with('message', 'Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ModelCategories::destroy($id);
        return redirect('admin/categories')->with('message', 'Category deleted!');
    }
}
