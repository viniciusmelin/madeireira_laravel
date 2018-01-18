<?php
namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Order_item;
use App\Product;
use Illuminate\Support\Facades\DB;
use App\Salesman;
use App\People;

class OrderController extends Controller
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
        //$allOrders = Order::with('client.people','salesman.people','order_item','situation')->get();
        $allOrders = Order::all();
        //dd($allOrders);
        return view('order.index', compact('allOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.cadastrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();
            $order = Order::find($request->order_id);
            if (empty($order)) {
                $order = new Order();
                $order->client_id = $request->people_id;
                $order->salesman_id = $request->salesman_id;
                $order->situation_id = 2;
                $order->operation_id = 1;
                $order->amount = 0;

                if ($order->save()) {
                    $product = Product::find($request->item_id);
                    $order_item = new Order_item();
                    $order_item->order_id = $order->id;
                    $order_item->product_id = $product->id;
                    $order_item->amount = $request->quantidade;
                    $order_item->price = $product->price;
                    

                    if ($order_item->save()) {
                        $order->amount = ($product->price * $request->quantidade);
                        $order->save();
                        DB::commit();
                        return json_encode(['result' => 'ok', 'order_id' => $order->id, 'title' => 'Sucesso Operação', 'msg' => 'Produto Adicionado com sucesso!', 'class' => 'callout callout-success']);


                    } else {
                        return json_encode(['result' => 'error', 'order_id' => $order->id, 'title' => 'Erro Operação', 'msg' => 'Não foi possível salvar item neste pedido, favor tentar novamente!', 'class' => 'callout callout-danger']);
                    }

                } else {
                    return json_encode(['result' => 'error', 'order_id' => $order->id, 'Não foi possível salvar pedido, favor tentar novamente!', 'class' => 'callout callout-danger']);
                }

            }

            $product = Product::find($request->item_id);

            $order_item = Order_item::where([
                ['order_id', '=', $order->id],
                ['product_id', '=', $product->id]
            ])->first();

            if (empty($order_item)) {
                $order_item = new Order_item();
                $order_item->order_id = $order->id;
                $order_item->product_id = $product->id;
                $order_item->amount = $request->quantidade;
                $order_item->price = $product->price;
                $order->amount = ($product->price * $request->quantidade);

                if ($order_item->save()) {
                    $order->save();
                    DB::commit();
                    return json_encode(['result' => 'ok', 'title' => 'Sucesso Operação', 'msg' => 'Item adicionado ao pedido com sucesso!', 'order_id' => $order->id, 'class' => 'callout callout-success']);
                } else {
                    return json_encode(['result' => 'error', 'title' => 'Erro Operação', 'msg' => 'Não foi possível adicionar o item ao pedido,favor tentar novamente!', 'order_id' => $order->id, 'class' => 'callout callout-danger']);
                }

            } else {
                $order_item->amount = $request->quantidade;
                $order_item->price = $product->price;
                $order->amount = ($product->price * $request->quantidade);

                if ($order_item->save()) {
                    $order->save();
                    DB::commit();
                    return json_encode(['result' => 'ok', 'title' => 'Sucesso Operação', 'msg' => 'Item foi atualizado com sucesso!', 'order_id' => $order->id, 'class' => 'callout callout-success']);
                } else {
                    return json_encode(['result' => 'error', 'order_id' => $order->id, 'title' => 'Erro Operação', 'msg' => 'Não foi atualizar o item, favor tentar novamente!', 'class' => 'callout callout-danger']);
                }
            }

            return json_encode(['result' => 'error', 'order_id' => $order->id, 'title' => 'Erro Operação', 'msg' => 'Item não encontrado neste pedido.', 'class' => 'callout callout-danger']);
        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode(['result' => 'error', 'order_id' => $order->id, 'title' => 'Erro Operação', 'msg' => $e->getMessage(), 'class' => 'callout callout-danger']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $order = Order::find($id);
            $salesman = People::where('id','=',$order->salesman_id)->first();
            $client = People::where('id','=',$order->client_id)->first();
            $order_item = Order_item::with('product')->where('order_id','=',$order->id)->get();
            //return [$order_item];
            return view('order.editar',compact('salesman','client','order_item','order'));
        }
        catch(Exception $e)
        {
            return back()->with($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        try
        {

        }
        catch(Exception $e)
        {
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }

    public function removerItem(Request $request)
    {
        try
        {
            DB::beginTransaction();
            $order = Order::find($request->order_id);
            if(empty($order))
            {
                return json_encode(['result' => 'error','title' => 'Erro Operação', 'msg' => 'Nenhum pedido foi encontrado!', 'class' => 'callout callout-danger']);    
            }
            $product = Product::find($request->product_id);
            $order_item = Order_item::where([
                ['order_id','=',$order->id],
                ['product_id','=',$product->id]
                ])->first();

            //return $order_item;
            if(empty($order_item))
            {

                return json_encode(['result' => 'error','title' => 'Erro Operação', 'msg' => 'Este item não foi encontrado neste pedido!', 'class' => 'callout callout-danger']);    
            }
            $order->amount -= ($order_item->price * $order_item->amount);

            if($order_item->delete())
            {
                if($order->save())
                {
                    DB::commit();
                    return json_encode(['result' => 'ok', 'title' => 'Sucesso Operação', 'msg' => 'Item removido com sucesso!', 'order_id' => $order->id, 'class' => 'callout callout-success']);
                }
            }
            else
            {
                DB::rollBack();
                return json_encode(['result' => 'error','title' => 'Erro Operação', 'msg' => 'Não foi possível remover o item selecionado!', 'class' => 'callout callout-danger']);    
            }    

        }
        catch( \Exception $e)
        {
            DB::rollBack();
            return json_encode(['result' => 'error',  'title' => 'Erro Operação', 'msg' => $e->getMessage(), 'class' => 'callout callout-danger']);
        }
    }
}
