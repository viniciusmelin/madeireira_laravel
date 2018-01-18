<?php

namespace App\Http\Controllers;

use App\Phone;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PhoneController extends Controller
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
            $phone = new Phone();
            $phone->people_id = $request->people_id;
            $phone->number = $request->number;
            $phone->phone_type_id = $request->phone_type_id;
            $phone->main = $request->main;
            if($phone->save())
            {
                \Session::flash('flash_message',[
                    'msg'=>'Telefone criado com sucesso!',
                    'class'=>'alert-success'
                ]);
                $result = Phone::with('phone_type')->where('id','=',$phone->id)->first();
                return json_encode(['object'=>$result,'result'=>'ok','action'=>'store']);
            }
            else
            {
                \Session::flash('flash_message',[
                    'msg'=>'Não foi possível salvar o Telefone!',
                    'class'=>'alert-danger'
                ]);

                return json_encode(['result'=>'error','action'=>'store','msg'=>'Não foi possível salvar o Telefone!']);
            }
        }
        catch(\Exception $e)
        {
            return json_encode(['result'=>'error','msg'=>$e]);
        }   
    }


    public function getPhoneJson()
    {
        return Datatables::of(Phone::with('phone_type')->all())->make(true);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function show(Phone $phone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function edit(Phone $phone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phone $phone)
    {
        try
        {
            $phoneupdate = Phone::with('phone_type')->where('id','=',$request->id)->first();
            if(empty($phoneupdate))
            {
                return json_encode(['result'=>'error','msg'=>'Não foi encontrado nenhum registro!']);
            }
            $phoneupdate->number = $request->number;
            $phoneupdate->main = $request->main;
            $phoneupdate->phone_type_id = $request->phone_type_id;
            if($phoneupdate->save())
            {
                \Session::flash('flash_message',
                [ 
                    'msg'=>'Telefone atualizado com sucesso!',
                    'class'=>'alert-success'
                ]);
                return json_encode(['object'=>$phoneupdate,"result"=>"ok","action"=>"update"]);
            }
            else
            {
                \Session::flash('flash_message',
                [ 
                    'msg'=>'Não foi possível atualizar Telefone!',
                    'class'=>'alert-danger'
                ]);
                return json_encode(['result'=>'error','action'=>'update']);
            }
        }
        catch(\Exception $e)
        {
            return json_encode(['result'=>'error','msg'=>$e]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try
        {
            $phone = Phone::find($request->id);
            // dd($phone);
             if($phone->delete())
             {
                 \Session::flash('flash_message',
                 [ 
                     'msg'=>'Telefone excluído com sucesso!',
                     'class'=>'alert-success'
                 ]);
                 return json_encode(['result'=>'ok']);
             }
             else
             {
                \Session::flash('flash_message',
                [ 
                    'msg'=>'Não foi possível excluir Telefone!',
                    'class'=>'alert-danger'
                ]);
                return json_encode(['result'=>'error','msg'=>'Não foi possível excluir Telefone!']);
             }

        }
        catch(\Exception $e)
        {
            return json_encode(['result'=>'error','msg'=>$e]);
        }     
    }
}
