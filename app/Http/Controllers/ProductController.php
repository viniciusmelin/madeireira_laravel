<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
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
        $product = Product::all();
        return view('product.index',compact('product'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.cadastrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try
        {
            $product = new Product($request->all());
            
            if($product->save())
            {
                \Session::flash('flash_message',[
                    'msg'=>'Produto criado com sucesso!',
                    'class'=>'alert-success'
                ]);
                
                return redirect()->route('produto.inicial');
            }
            else
            {

                \Session::flash('flash_message',[
                    'msg'=>'Não foi possível criar Produto!',
                    'class'=>'alert-danger'
                ]);
            }

        }
        catch(\Exception $e)
        {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $product = Product::find($id);
       return view('product.editar', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try
        {
            $product = Product::find($request->id);
            if(empty($product))
            {
                return redirect()->back()->with(['message'=>"Produto não foi encontrado na base da dados!",'title'=>'Erro ao realizar operação!']);
            }
            $product->description = $request->description;
            $product->active = $request->active;
            $product->width = $request->width;
            $product->height = $request->height;
            $product->deep = $request->deep;
            $product->amount_min = $request->amount_min;
            $product->cubing = $request->cubing;
            $product->amount = $request->amount;
            $product->price = $request->price;
            $product->price_sale = $request->price_sale;
    
            if($product->save())
            {
                return redirect()->route('produto.inicial');
            }
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['message'=>$e->getMessage(),'title'=>'Erro ao realizar operação!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function getJsonProduct(Request $request)
    {
        try
        {

            $product = DB::table('product')
            ->where('product.description','like','%'.$request->search.'%')
            ->select('product.id','product.description','product.price')->get();


            $product = json_decode(json_encode($product,true),true);


            $callback = function($id, $name,$price)
            {
                return array($id,$name,$price); 
            };

            $arr = array_map($callback,array_column($product,'id'),array_column($product,'description'),array_column($product,'price'));

            return json_encode($arr);
        }
        catch(Exception $e)
        {

        }
    }
}
