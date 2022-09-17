<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    public function index()
    {
        // prendo tutti i Prodotti dal db
        $products = Product::All();

        // $request_info = $request->all();

        // li metto in $data
        $data = [
            'products' => $products,
        ];

        // gli passo i $data e gli indico dove mostrarli
        return view('admin.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // controllo che i dati passati siano validi con una funzione che mi scrivo sotto
        $request->validate($this->getValidationRules());

        // richiedo le nuove info per il nuovo post
        $form_data = $request->all();

        //attraverso il fill aggiungo al db il nuovo product
        $new_product = new Product();

        $new_product->fill($form_data);

        $new_product->save();

        //scrivo che l'admin dopo aver salvato il post venga rimandato alla show del nuovo post
        return redirect()->route('admin.products.show', ['product' => $new_product->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // prendo il post specifico dall'id
        $product = Product::findOrFail($id);

        $data = [
            'product' => $product
        ];

        return view('admin.products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    protected function getValidationRules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:60000'
        ];
    }
}
