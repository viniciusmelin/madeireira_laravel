<?php

namespace App\Http\Controllers;

use App\Client;
use App\People;
use App\Address;
Use App\Phone_type;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Yajra\Datatables\DataTables;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    
        return view('client.index');
    }

    /*
    * @return \Illuminate\Http\JsonResponse
    */
    public function getJson()
    {

        return Datatables::of(People::has('client')->get())->addColumn('action',function($client)
        {
            $url = \route('cliente.visualizar',$client->id);
            return '<a href="'.$url.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>';
        })->editColumn('active',function($client){
            return $client->active==1 ? 'Ativo':'Inativo';
        })->setRowId('id')->make(true);
    }

    public function getPesqClient(Request $request)
    {
        try
        {
            
            $client = DB::table('people')
            ->join('client','people.id','=','client.people_id')
            ->where('people.name','like','%'.$request->search.'%')
            ->select('people.id','people.name','people.cpfcnpj')->get();
    
            $client = json_decode(json_encode($client,true),true);
    
            $callback = function($id,$name,$cpf)
            {
                return array($id,$name,$cpf);
            };
            $arr = array_map($callback,array_column($client,'id'),array_column($client,'name'),array_column($client,'cpfcnpj'));

            return json_encode($arr);
        }
        catch(Exception $e)
        {

        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date_register = date('Y-m-d H:i:s');
        return view('client.cadastrar',compact('date_register'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
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
                $client = new Client();
                $client->people_id = $people->id;
                $client->birth_register =  $request->birth_register;
                $client->birth_date =  date('Y-m-d',strtotime($request->birth_date));
                $client->limitmin =  $request->limitmin;
                $client->limitmax =  $request->limitmax;
                if($client->save())
                {
                    $address = new Address();
                    $address->people_id = $people->id;
                    $address->street = $request->street;
                    $address->number = $request->number;
                    $address->complement = $request->complement;
                    $address->neighborhood = $request->neighborhood;
                    $address->zip_code = str_replace('-','',$request->zip_code);
                    $address->city = $request->city;
    
                    if($address->save())
                    {
                        DB::commit();
                        return redirect()->route('cliente.inicial');
                    }
                }
                
            }
        }
        catch(Exception $e)
        {
            
            DB:rollBack();
            return back()->with($e->message());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::with('people','address','email','phone','phone.phone_type')->where('people_id','=',$id)->first();
        $phone_type = Phone_type::all();
        //dd($client);
        return view('client.visualizar',compact('client','phone_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(client $client)
    {
        //
    }
}
