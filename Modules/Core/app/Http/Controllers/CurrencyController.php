<?php

namespace Modules\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{

    public function index()
    {
        return view('core::pages.currency.index');
    }


    public function store(Request $request)
    {
        
    }

    public function edit($id)
    {
        return view('core::pages.currency.edit');
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
