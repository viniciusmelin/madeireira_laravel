<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;
use App\Http\Requests\EmailRequest;


class EmailController extends Controller
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
            return $request->erros()->all();
            $email = new Email();
            $email->people_id = $request->people_id;
            $email->email = $request->email;
            $email->main = $request->main;

            if($email->save())
            {
                \Session::flash('flash_message',[
                    'msg'=>'Email criado com sucesso!',
                    'class'=>'alert-success'
                ]);
                return json_encode(['result'=>'ok','object'=>$email,'action'=>'store']);
            }
           
        }
        catch(\Exception $e)
        {
            return json_encode(['result'=>'error','msg'=>$e]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try
        {
            $email = Email::find($request->id);
            if(empty($email))
            {
                return json_encode(['result'=>'error','msg'=>'Não foi encontrado nenhum registro!']);
            }
            $email->main = $request->main;
            $email->email = $request->email;

            if($email->save())
            {
                \Session::flash('flash_message',
                [ 
                    'msg'=>'Email atualizado com sucesso!',
                    'class'=>'alert-success'
                ]);
                return json_encode(['result'=>'ok','action'=>'update','object'=>$email]);
            }
            else
            {
                \Session::flash('flash_message',
                [ 
                    'msg'=>'Não foi possível atualizar Email!',
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
     * @param  \App\email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try
        {
            $email = Email::find($request->id);
            //return $email;
            if(empty($email))
            {
                return json_encode(['result'=>'error','msg'=>'Não foi encontrado nenhum registro!']);
            }
            if($email->delete())
            {
                \Session::flash('flash_message',
                [ 
                    'msg'=>'Email excluído com sucesso!',
                    'class'=>'alert-success'
                ]);
                return json_encode(['result'=>'ok','action'=>'delete']);
            }
            else
            {
                \Session::flash('flash_message',
                [ 
                    'msg'=>'Não foi possível excluir Email!',
                    'class'=>'alert-danger'
                ]);
                return json_encode(['result'=>'error','msg'=>'Não foi possível excluir Email!']);
            }
        }
        catch(\Exception $e)
        {
            return json_encode(['result'=>'error','msg'=>$e]);
        }

    }
}
