<?php

namespace App\Http\Controllers;

use App\Salesman;
use App\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class SalesmanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesmanAll = People::has('salesman')->get();
        return view('salesman.index',compact('salesmanAll'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date_register = date('Y-m-d H:i:s');
        return view('salesman.cadastrar',compact('date_register'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            DB::beginTransaction();
            $people = new People();
            $people->name = $request->name;
            $people->cpfcnpj = str_replace('-','',str_replace('.','', $request->cpfcnpj));
            $people->active = $request->active;
            $people->user_id = 1;
            if($people->save())
            {
                $salesman = new Salesman();
                $salesman->people_id = $people->id;
                $salesman->birth_register = $request->birth_register;
                if($salesman->save())
                {
                    DB::commit();
                    return redirect()->route('vendedor.visualizar');
                }

            }
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return back()->with($e->messge());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salesman  $salesman
     * @return \Illuminate\Http\Response
     */
    public function show(Salesman $salesman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salesman  $salesman
     * @return \Illuminate\Http\Response
     */
    public function edit(Salesman $salesman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salesman  $salesman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salesman $salesman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salesman  $salesman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salesman $salesman)
    {
        //
    }

    public function getJson(Request $request)
    {
        try
        {

            $salesman = DB::table('people')
            ->join('salesman','people.id','=','salesman.people_id')
            ->where('people.name','like','%'.$request->search.'%')
            ->select('people.id','people.name')->get();


            $salesman = json_decode(json_encode($salesman,true),true);


            //$salesman = DB::connection()->select('select people.id,people.name from people join salesman on (people.id = salesman.people_id) where people.name LIKE ? ', ["%{$request->search}%"]);
            //$salesman = DB::connection()->select('select people.id,people.name from people');
            //$salesman=[];
            //return $salesman;

            $callback = function($id, $name)
            {
                return array($id,$name); 
            };

            $arr = array_map($callback,array_column($salesman,'id'),array_column($salesman,'name'));

            return json_encode($arr);
        }
        catch(Exception $e)
        {
            
        }
    }
}
