<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Skill;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestValueResolver;

use Illuminate\Support\Facades\Validator;
use  Illuminate\Support\MessageBag;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('trim');
    }

    public function index()
    {
        $data = array(
            'category_name' => 'users',
            'page_name' => 'users',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        );

        return view('users.index')
            ->with($data);
    }

    /*
     *   AJAX request
     */
    public function getUsers(Request $request)
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
        $totalRecords = User::select('count(*) as allcount')->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')
            ->where('first_name', 'like', '%' . $searchValue . '%')
            ->orWhere('last_name', 'like', '%' . $searchValue . '%')
            ->orWhere('email', 'like', '%' . $searchValue . '%')
            ->orWhere('phone', 'like', '%' . $searchValue . '%')
            ->count();

        // Fetch records
        $records = User::orderBy($columnName, $columnSortOrder)
            ->where('users.first_name', 'like', '%' . $searchValue . '%')
            ->orWhere('users.last_name', 'like', '%' . $searchValue . '%')
            ->orWhere('users.email', 'like', '%' . $searchValue . '%')
            ->orWhere('users.phone', 'like', '%' . $searchValue . '%')
            ->select('users.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $first_name = $record->first_name;
            $last_name = $record->last_name;
            $email = $record->email;
            $phone = $record->phone;
            $status = $record->status == 1 ? 'checked' : '';
            $status_class = $record->status == 1 ? 'primary' : 'danger';
            $data_arr[] = array(
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email" => $email,
                "phone" => $phone,

                "status" => '<label class="switch s-icons s-outline s-outline-warning mr-2">
                    <input type="checkbox" data-id="' . $record->id . '" class="checkbox" name="status_id[' . $record->id . ']" ' . $status . ' > <span class="slider"></span></label>',

                "action" => '<ul class="table-controls" style="margin-bottom: 0rem;">
                <li>
                    <a href="' . route('users.edit', $record->id) . '" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </a>
                </li>

                <li>
                    <button type="submit" class="remove-user" style="border: none; padding: 0; background: none;" data-id="' . $record->id . '" data-action="' . route('users.destroy', $record->id) . '">
                        <a class="bs-tooltip warning confirm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg></a>
                    </button>
                </li>
            </ul>',
            );
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
    public function create(Request $data)
    {
        $data = [
            'category_name' => "users",
            'page_name' => 'user_add',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        return view('users.create', ['users' => User::all()])->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users,email',
                'phone' => 'required',
            ]);

            if ($validator->fails()) {
                $data = array(
                    'category_name' => 'users',
                    'page_name' => 'user_add',
                    'has_scrollspy' => 0,
                    'scrollspy_offset' => '',
                );

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.background', '#e7515a');
                $request->session()->flash('message.content', $validator->errors());
                return redirect()->route('users.create')->with($data);
            }

            
            if (!empty($request->email)) {
                $user = User::where('email', '=', $request->email)->first();

                if ($user != null) {
                    $data = array(
                        'category_name' => 'users',
                        'page_name' => 'user_add',
                        'has_scrollspy' => 0,
                        'scrollspy_offset' => '',
                    );

                    // email exist
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.background', '#e7515a');
                    $request->session()->flash('message.content', Lang::get('alert.user_email_already_exist'));

                    return redirect()->route('users.create')->with($data);
                }
            }
            
            $request->request->add(['password' => Hash::make($request->password)]);
            $request->request->add(['create_by' => Auth::id()]);

            if (!empty($request)) {
                $insert_user = User::create($request->all());
                $token = Str::random(12);
                $mail_data = array(
                    "to_name" => ucfirst($request->first_name . " " . $request->last_name),
                    "to_email" => $request->email,
                    "token" => $token,
                    "email_type" => "welcome"
                );

                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.background', '#8dbf42');
                    $request->session()->flash('message.content', Lang::get("alert.user_created_successfully"));
                } else {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.background', '#e7515a');
                    $request->session()->flash('message.content',  Lang::get('alert.somthing_wrong'));
                }
           
            $data = array(
                'category_name' => 'users',
                'page_name' => 'user_add',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
            );

            return redirect()->route('users.index')->with($data);
        } catch (Exception $ex) {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.background', '#e7515a');
            $request->session()->flash('message.content', $ex->getMessage());
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id) 
    public function edit(User $user)
    {
        try {
            if (empty($user)) {
                $user->session()->flash('message.level', 'danger');
                $user->session()->flash('message.background', '#e7515a');
                $user->session()->flash('message.content', 'Something went wrong!');
            }

            $user_data = User::where('id', '!=', $user->id)->get();
            $data = [
                'category_name' => 'users',
                'page_name' => 'user_edit',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
            ];

            return view('users.edit', compact('user', 'user_data'))->with($data);
        } catch (Exception $e) {
            $user->session()->flash('message.level', 'danger');
            $user->session()->flash('message.background', '#e7515a');
            $user->session()->flash('message.content', $e->getMessage());
            return redirect()->route('users.index');
        }
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
        try {

            if (empty($id) || !is_numeric($id)) {
                $data = array(
                    'category_name' => 'users',
                    'page_name' => 'user_edit',
                    'has_scrollspy' => 0,
                    'scrollspy_offset' => '',
                );

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.background', '#e7515a');
                $request->session()->flash('message.content', Lang::get('alert.direct_access_denied'));
                return redirect()->route('users.index')->with($data);
            }

 
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users,email,' . $id,
                'phone' => 'required',
            ]);

            if ($validator->fails()) {
                $data = array(
                    'category_name' => 'users',
                    'page_name' => 'user_edit',
                    'has_scrollspy' => 0,
                    'scrollspy_offset' => '',
                );
                // $valid_message = $validator->fails();

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.background', '#e7515a');
                $request->session()->flash('message.content', $validator->errors());

                return redirect()->route('users.edit', $id)->with($data);
            }

            $check_exist = User::find($id);
            if (empty($check_exist)) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.background', '#e7515a');
                $request->session()->flash('message.content', Lang::get('alert.user_update_successfully'));
                $data = array(
                    'category_name' => 'users',
                    'page_name' => 'user_edit',
                    'has_scrollspy' => 0,
                    'scrollspy_offset' => '',
                );
                return redirect()->route('users.edit', $id)->with($data);
            }

            $check_exist->first_name = $request->input('first_name');
            $check_exist->last_name = $request->input('last_name');
            $check_exist->email = $request->input('email');
            $check_exist->dob = $request->input('dob');
            $check_exist->phone = $request->input('phone');
          
            $check_exist->update_by = Auth::id();
            // $check_exist->password = Hash::make('123456789');

            $data = array(
                'category_name' => 'users',
                'page_name' => 'user_edit',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
            );

            if ($check_exist->save()) {
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.background', '#8dbf42');
                $request->session()->flash('message.content', Lang::get('alert.user_update_successfully'));
            } else {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.background', '#e7515a');
                $request->session()->flash('message.content',  Lang::get('alert.somthing_wrong'));
            }

            return redirect()->route('users.index')->with($data);
        } catch (Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.background', '#e7515a');
            $request->session()->flash('message.content', $e->getMessage());
            return redirect()->route('users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $users = user::find($id);

        if (!$users) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.background', '#e7515a');
            $request->session()->flash('message.content', Lang::get('alert.user_not_found'));
        } else {
            if ($users->delete()) {
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.background', '#8dbf42');
                $request->session()->flash('message.content', Lang::get('alert.user_deleted'));
            } else {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.background', '#e7515a');
                $request->session()->flash('message.content',  Lang::get('alert.somthing_wrong'));
            }
        }
        return redirect()->route('users.index');
    }

    public function change_status_by_id(Request $request)
    {
        $check_exist = User::find($request->id);

        if (empty($check_exist)) {
            $response = array(
                'status' => 'failed',
                'message' => Lang::get('alert.somthing_wrong'),
                'background' => '#e7515a'
            );
        }
        $check_exist->status = $request->status;
        $check_exist->update_by = Auth::id();
        if ($check_exist->save()) {

            $response = array(
                'status' => 'success',
                'message' => Lang::get('alert.change_status'),
                'background' => '#8dbf42'
            );
        } else {
            $response = array(
                'status' => 'failed',
                'message' => Lang::get('alert.somthing_wrong'),
                'background' => '#e7515a'
            );
        }
        return response()->json($response);
    }
}
