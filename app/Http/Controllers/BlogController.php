<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'category_name' => 'blog',
            'page_name' => 'blog',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        );
        return view('blog.index')->with($data);
    }

    /*
     *   AJAX request
     */
    public function getBlog(Request $request)
    {

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Blog::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Blog::select('count(*) as allcount')
            ->join('users', 'blog.user_id', '=', 'users.id')
            ->where('blog.name', 'like', '%' . $searchValue . '%')
            ->orWhere('blog.detail', 'like', '%' . $searchValue . '%')
            ->orWhere('users.first_name', 'like', '%' . $searchValue . '%')
            ->count();
        // Fetch records
        $records = Blog::orderBy($columnName, $columnSortOrder)
            ->join('users', 'blog.user_id', '=', 'users.id')
            ->where('blog.name', 'like', '%' . $searchValue . '%')
            ->orWhere('blog.detail', 'like', '%' . $searchValue . '%')
            ->orWhere('users.first_name', 'like', '%' . $searchValue . '%')
            ->select('blog.*', 'users.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            if (Auth::user()->id == $record->user_id) {
                $name = $record->name;
                $detail = $record->detail;
                $user_id = $record->first_name;
                $data_arr[] = array(
                    "name" => $name,
                    "detail" => $detail,
                    "user_id" => $user_id,
                );
            }
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
