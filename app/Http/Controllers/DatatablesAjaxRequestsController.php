<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use Yajra\Datatables\Datatables;

class DatatablesAjaxRequestsController extends Controller
{

    public function index(Request $request)
    {
        if ( ! $request->ajax() ) {
            return to_route('home');
        }

        return $this->sendDataToDatatables();

    }
    
    public function sendDataToDatatables()
    {
        $data = $this->getDataFromDatabase();
        return Datatables::of($data)->make();
    }

    public function getDataFromDatabase()
    {
        return Contract::select(['name','fee']);
    }
}
