<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Category;
use App\Tag;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // request per richiedo le info dal delete per la conferma
    public function index(Request $request)
    {
        // prendo tutti i Prodotti dal db
        // $products = Product::All();
        $products = Product::paginate(6);

        // prendo tutte le info passate a index
        $request_info = $request->all();

        // se tra le info prese deleted è confermato mando la conferma per l'alert
        $deleted = isset($request_info['deleted']) ? $request_info['deleted'] : null;

        // li metto in $data
        $data = [
            'products' => $products,
            'deleted' => $deleted
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
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'categories' => $categories,
            'tags' => $tags     
        ];

        return view('admin.products.create', $data);
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

        // creo il nuovo slu partendo dal titolo chiamandomi la funzione sotto
        $new_product->slug = $this->getSlugFromTitle($new_product->title);

        $new_product->save();

        if(isset($form_data['tags'])) {
            $new_product->tags()->sync($form_data['tags']);
        }

        //dopo aver salvato il product mando l'admin alla show del nuovo post
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

        // prendo data e orario attuale con carbon
        $now = Carbon::now();

        // calcolo quanti giorni fa è stato creato il product utilizzando il metodo diffInDays della classe carbon
        $created_days_ago = $product->created_at->diffInDays($now);

        $data = [
            'product' => $product,
            'created_days_ago' => $created_days_ago
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
        $product = Product::findOrfail($id);
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'product' => $product,
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.products.edit', $data);
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
        // controllo che i dati passati siano validi con una funzione che mi scrivo sotto
        $request->validate($this->getValidationRules());

        // richiedo le nuove info per il nuovo post
        $form_data = $request->all();

        // metto in una variabile il product da aggiornare
        $product_to_update = Product::findOrFail($id);

        // se il nuovo titolo è diverso dal precedente mi ricavo il nuovo slug
        if($form_data['title'] !== $product_to_update->title) {
            $form_data['slug'] = $this->getSlugFromTitle($form_data['title']);
        // altrimenti dico a laravel che lo slug è lo stesso di prima
        } else {
            $form_data['slug'] = $product_to_update->slug;
        }

        // faccio l'update al product da aggiornare
        $product_to_update->update($form_data);

        if(isset($form_data['tags'])) {
            $product_to_update->tags()->sync($form_data['tags']);
        } else {
            $product_to_update->tags()->sync([]);
        }

        //dopo aver salvato le modifiche del product mando l'admin alla show del nuovo post
        return redirect()->route('admin.products.show', ['product' => $product_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_delete = Product::findOrFail($id);
        $post_to_delete->delete();

        return redirect()->route('admin.products.index', ['deleted'=>'yes']);
    }


    protected function getValidationRules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category' => 'nullable|exist:category,id'
        ];
    }

    protected function getSlugFromTitle($title) {

        // creo lo slug da salvare aggiungendo tra le parole del titolo "-"
        $slug_to_save = Str::slug($title, '-');

        // salvo lo slug da salvare in una variabile
        $slug_base = $slug_to_save;  
        
        // controllo che lo slug da salvare non esiste gia negli altri product
        $existing_slug_product = Product::where('slug', '=', $slug_to_save)->first();

        // creo un counter per
        $counter = 1;

        // finche esiste nel db uno slug uguale a quello da salvare
        while($existing_slug_product) {

            // aggiungo allo slug da salvare '-' alla fine e il numero del counter
            $slug_to_save = $slug_base . '-' . $counter;

            // controllo che lo slug da salvare non esiste gia negli altri product
            $existing_slug_product = Product::where('slug', '=', $slug_to_save)->first();

            // aumento di uno il counter
            $counter++;
        }

        // quando non ci sono più slug come il mio, me lo torno
        return $slug_to_save;
    }
}
