<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Models\Manager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ManagerModifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = Manager::all();
        return view('admin.managers', ['managers' => $managers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contracts = Contract::all();

        return view('admin.add-manager', ['contracts' => $contracts]);
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
            'username' => ['required','unique:managers,username'],
            'phone' => ['required','unique:managers,phone'],
            'email' => ['required','unique:managers,email'],
            'province' => ['required'],
            'password' => ['required'],-
            'cpassword' => ['required', 'same:password'],
            'contract' => ['required', Rule::exists('contracts', 'id')],
            ])->validated();

        Manager::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'email' => $request->email,
            'province' => $request->province,
            'contract_id' => $request->contract,
        ]);

        return redirect()->route('admin.managers.index');

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
        $manager = Manager::findOrFail($id);
        $contracts = Contract::all();

        return view('admin.manager', ['manager' => $manager, 'contracts' => $contracts]);
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
            'username' => ['required'],
            'cpassword' => ['required_unless:password,null', 'same:password'],
            'status' => ['boolean'],
        ]);

        $validator->sometimes('username', 'unique:managers,username', function() {
            $db_member = Manager::find(request()->segment(3)) ;
            $request_member = Manager::where('username', request()->username)->first();
            return ! ( $db_member == $request_member ); 
        })->validated();

        
        $is_blocked = $request->status == null ? 1 : 0;

        $member = Manager::find($id);

        $member->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'is_blocked' => $is_blocked,
        ]);

        return redirect()->route('admin.managers.index');
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
