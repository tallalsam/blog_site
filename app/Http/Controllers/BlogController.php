<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Blog;
use DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.user.blogs');
    }

    public function BlogsData(Request $request)
    {
        if($request->id !=null)
        {
            $data = Blog::where('blogger_id',$request->id)->get();
        }
        else
        {
            $data = Blog::latest()->get();
        }
        
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('blogger', function($row){
                    return $row->blogger->name;
                })
                ->rawColumns(['action', 'blogger'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'blogger_id' => 'required',
            'description' => 'required'
        ]);

        $user = Blog::create($data);

        return response([ 'error'=>'','user' => $user]);
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
    public function edit(Request $request)
    {
        $user = Blog::find($request->id);

        return response()->json(['error'=>'','user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Blog::findOrFail($request->id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'blogger_id' => 'required',
            'description' => 'required'
        ]);

        $input = $request->all();

        

        $user->fill($input)->save();

        return response()->json(['error'=>'', 'success'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = Blog::find($request->id);
        $user->delete();

        return response()->json(array('error'=>'','success' =>true));
    }
}
