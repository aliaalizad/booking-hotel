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
        $contracts = $this->getContracts();
        return view('panels.' . $this->panel . '.contracts.all', compact('contracts'));
    }

   
    public function create()
    {
        return view('panels.' . $this->panel . '.contracts.add');
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

    public function edit(Contract $contract)
    {
        return view('panels.' . $this->panel . '.contracts.edit', compact('contract'));
    }

    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'name' => ['required'],
            'fee' => ['required'],
        ]);

        $contract->update([
            'name' => $request->name,
            'fee' => $request->fee,
        ]);

        return to_route($this->panel . '.contracts.index');
    }

    public function destroy($id)
    {
        //
    }
}
