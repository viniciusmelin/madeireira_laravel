<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Mockery\CountValidator\Exception;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try
        {
            if(empty($request))
            {
                return 'tttt';    
            }
            $address = new Address();
            $address->people_id = $request->people_id;
            $address->street = $request->street;
            $address->number = $request->number;
            $address->complement = $request->complement;
            $address->neighborhood = $request->neighborhood;
            $address->zip_code = $request->zip_code;
            $address->city = $request->city;
    
            if($address->save())
            {
                \Session::flash('flash_message',[
                    'msg'=>'Endereço criado com sucesso!',
                    'class'=>'alert-success'
                ]);
                return json_encode(['result'=>'ok','object'=>$address,'action'=>'store']);
            }
            else
            {
                \Session::flash('flash_message',[
                    'msg'=>'Não foi possível excluir salvar o endereço',
                    'class'=>'alert-danger'
                ]);
                return json_encode(['result'=>'error','object'=>$address]);
            }
        }
        catch(Exception $e)
        {
            return json_encode(['result'=>'error','msg'=>$e]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try
        {
            $address = Address::find($request->id);
            if(!empty($address))
            {
                $address->street = $request->street;
                $address->number = $request->number;
                $address->complement = $request->complement;
                $address->neighborhood = $request->neighborhood;
                $address->zip_code = $request->zip_code;
                $address->city = $request->city;
                $address->save();
                return json_encode(["result"=>"ok","action"=>"update","object"=>$address]);
            }
        }
        catch(Exception $e)
        {
            return json_encode(['result'=>'error','msg'=>$e]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try
        {
            $address = Address::where('id','=',$request->id)->first();
             if($address->delete())
             {
                 \Session::flash('flash_message',
                 [ 
                     'msg'=>'Endereço excluído com sucesso!',
                     'class'=>'alert-success'
                 ]);
                 return json_encode(['result'=>'ok','action'=>'delete']);
             }
             else
             {
                \Session::flash('flash_message',
                [ 
                    'msg'=>'Não foi possível excluir Endereço!',
                    'class'=>'alert-danger'
                ]);
                return json_encode(['result'=>'error']);
             }

        }
        catch(Exception $e)
        {
            return json_encode(['result'=>'error','msg'=>$e]);
        }

    }
}
