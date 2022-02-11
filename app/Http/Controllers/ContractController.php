<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceControllerHelpers;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    use ResourceControllerHelpers;

    public function index()
    {
        $contracts = $this->getAllContracts();
        return view($this->panel . '.contracts', compact('contracts'));
    }

   
    public function create()
    {
        return view($this->panel . '.add-contract');
    }

    
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'fee' => ['required'],
        ]);

        Contract::create([
            'name' => $request->name,
            'fee' => $request->fee,
        ]);

        return to_route($this->panel . '.contracts.index');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
