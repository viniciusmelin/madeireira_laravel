<?php

namespace App\Http\Controllers;

use App\Account_recive;
use App\App\Account_type;
use Illuminate\Http\Request;

class AccountReciveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receber = Account_recive::all();

        return view('acreceive.index',compact('receber'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date_register = date('Y-m-d H:i:s');
        $type_payment = \App\Account_type::all();
        return view('acreceive.cadastrar',compact('date_register','type_payment'));
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
     * @param  \App\account_recive  $account_recive
     * @return \Illuminate\Http\Response
     */
    public function show(account_recive $account_recive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\account_recive  $account_recive
     * @return \Illuminate\Http\Response
     */
    public function edit(account_recive $account_recive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\account_recive  $account_recive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, account_recive $account_recive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\account_recive  $account_recive
     * @return \Illuminate\Http\Response
     */
    public function destroy(account_recive $account_recive)
    {
        //
    }
}
