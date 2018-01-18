<?php

namespace App\Http\Controllers;

use App\People;
use App\Salesman;
use App\Client;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $people = new People();
        // $people->name = 'Vinicius';
        // $people->cpfcnpj = 49894;
        // $people->active = TRUE;
        // $people->user_id = 1;
        // $people->save();

        // $salesman = new Salesman();
        // $salesman->people_id = 11;
        // $salesman->date_register = date("Y-m-d H:i:s");
        // $salesman->save();

        // $client = new Client();
        // $client->people_id = 11;
        // $client->birth_date =date("Y-m-d H:i:s");
        // $client->birth_register =date("Y-m-d H:i:s");
        // $client->limitmin = 0;
        // $client->limitmax = 0;
        // $client->save();
        
         $client = People::find(11)->client;



        return dd($client);
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
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $people)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $people)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, People $people)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $people)
    {
        //
    }
}
