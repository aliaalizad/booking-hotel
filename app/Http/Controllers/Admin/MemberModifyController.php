<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MemberModifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
        return view('admin.members', ['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managers = Manager::all();
        return view('admin.add-member', ['managers' => $managers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'personnel_code' => ['required','unique:members,personnel_code'],
            'password' => ['required'],
            'cpassword' => ['required', 'same:password'],
            'manager' => ['required', Rule::exists('managers', 'id')],
        ])->validated();

        Member::create([
            'name' => $request->name,
            'personnel_code' => $request->personnel_code,
            'manager_id' => $request->manager,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.members.index');
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
        $member = Member::findOrFail($id);

        return view('admin.member', ['member' => $member]);
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
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'personnel_code' => ['required'],
            'cpassword' => ['required_unless:password,null', 'same:password'],
            'status' => ['boolean'],
        ]);

        $validator->sometimes('personnel_code', 'unique:members,personnel_code', function() {
            $db_member = Member::find(request()->segment(3)) ;
            $request_member = Member::where('personnel_code', request()->personnel_code)->first();
            return ! ( $db_member == $request_member ); 
        })->validated();

        
        $is_blocked = $request->status == null ? 1 : 0;

        $member = Member::find($id);

        $member->update([
            'name' => $request->name,
            'personnel_code' => $request->personnel_code,
            'password' => Hash::make($request->password),
            'is_blocked' => $is_blocked,
        ]);

        return redirect()->route('admin.members.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);

        if ($member->hotel_id != null) {
            return back()->withErrors(['deleteError' => 'this member has been assigned to ' . $member->hotel->name . ' first remove from hotel']);
        }

        $member->delete();

        return redirect()->route('admin.members.index');
    }
}
