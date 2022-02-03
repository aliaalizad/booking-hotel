<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Middleware\OTP;
use App\Models\Hotel;
use App\Models\Manager;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HotelModifyController extends Controller
{

    public function __construct()
    {
        $this->middleware(OTP::class)->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manager = Auth::guard('manager')->user();

        if ( Manager::find($manager->id) ) {
            $hotels = Manager::find($manager->id)->hotels;
        }
        return view('manager.hotels', ['hotels' => $hotels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manager = Auth::guard('manager')->user();

        if ( Manager::find($manager->id) ) {
            $members = Manager::find($manager->id)->members->where('hotel_id', null);
        }

        return view('manager.add-hotel', ['members' => $members]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate data
        if ($request->members == null) {
            return back()->withErrors(['members' => 'باید حداقل 1 کارمند را انتخاب کنید']);
        }

        Validator::make($request->all(), [
            'name' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'members' => ['required'],
            'members.*' => ['required', 'distinct', Rule::exists('members', 'id')->where('manager_id', Auth::guard('manager')->user()->id)->where('hotel_id', null)],
        ])->validated();

        // add hotel
        $hotel = Hotel::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'manager_id' => Auth::user()->id,
        ]);

        // update member
        foreach ( $request->members as $id ) {
            $member = Member::find($id) ;
            $member->hotel_id = $hotel->id;
            $member->save();
        }

        return redirect()->route('manager.dashboard');
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
        $manager = Auth::guard('manager')->user();
        $hotel = Hotel::findOrFail($id);
        $hotel_members = Member::where([['manager_id', $manager->id], ['hotel_id', $id]])->get();
        $available_members = Member::where([['manager_id', $manager->id], ['hotel_id', null]])->get();

        if ( $hotel->manager_id != $manager->id ) {
            abort(404);
        }

        return view('manager.hotel', ['hotel' => $hotel, 'hotel_members' => $hotel_members, 'available_members' => $available_members]);
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
        $manager = Auth::guard('manager')->user();

        // validate data
        if ($request->members == null) {
            return back()->withErrors(['members' => 'باید حداقل 1 کارمند را انتخاب کنید']);
        }

        Validator::make($request->all(), [
            'name' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'members' => ['required'],
            'members.*' => ['required', 'distinct', Rule::exists('members', 'id')->where('manager_id', $manager->id)->where(function ($query) use ($id, $manager) {
                return $query->where('hotel_id', $id)->orWhere('hotel_id', null);
            })]
        ])->validated();

        $hotel = Hotel::find($id);

        // update hotel
        $hotel->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
        ]);


        // remove old members form hotel
        foreach ( $hotel->members as $member ) {
            $member->hotel_id = null;
            $member->save();
        }

        // add new members form hotel
        foreach ( $request->members as $id ) {
            $member = Member::find($id) ;
            $member->hotel_id = $hotel->id;
            $member->save();
        }

        return redirect()->route('manager.hotels.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel = Hotel::find($id);

        foreach ( $hotel->members as $member ) {
            $member->hotel_id = null;
            $member->save();
        }

        $hotel->delete();
        
        return redirect()->route('manager.hotels.index');
        
    }
}
