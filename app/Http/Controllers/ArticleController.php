<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function affichage() {
        return view('dashboard');
    }

    public function index()
{
    $articles = Article::paginate(10);
    

    return view('articles.index', compact('articles'));
}


    //public function show($id){
    //$article = Article::findOrFail($id);
    //return view('articles.show', compact('article'));
    //}
    public function show($id)
    {
        // Recherche de l'article par son ID
        $article = Article::find($id);

        if (!$article) {
            // Si l'article n'existe pas, redirige vers la liste des articles avec un message d'erreur
            return redirect()->route('articles.index')->with('error', 'Article non trouvé');
        }

        // Retourne la vue avec l'article trouvé
        return view('articles.show', compact('article'));
    }


    public function create()
{
    

    // Passer les catégories à la vue
    return view('articles.create');
}

    public function store(Request $request)
    {
        $request->validate([
            // Validation pour le champ 'nom_article' :
            // - Ce champ est requis et doit être une chaîne de caractères (required|string).
            // - Il doit être unique dans la colonne 'nom_article' de la table 'articles' (unique:articles,nom_article).
            // - La longueur maximale de ce champ est limitée à 255 caractères (max:255).
            'nom_article' => [
                'required',        // Ce champ est obligatoire.
                'string',          // Il doit être une chaîne de caractères.
                'unique:articles,nom_article', // Le nom de l'article doit être unique dans la table `articles`.
                'max:255',         // La longueur maximale est de 255 caractères.
                'regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9]+$/' // Autorise seulement des lettres ou un mélange de lettres et de chiffres. Les chiffres seuls sont refusés.
                //'regex:/^[a-zA-Z]+$/' // N'autorise que des lettres (a-z et A-Z), sans aucun chiffre ni caractères spéciaux.
            ],

            'quantite_stock' => "required|numeric|min:1",
            'prix' => "required|numeric|min:1",
            

        ]);
            
        Article::create($request->all());
        return redirect()->route('articles.index')->with('success','Article créé avec succés');
    }

    
    public function edit(Article $article)
    {
        return view('articles.edit',compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate(
            [
            'nom_article' => "required|string|max:255",
            'quantite_stock' => "required|min:1",
            'prix' => "required|min:1"
            ]
            );

            $article->update($request->all());
            return redirect()->route('articles.index')->with('success',"Felicitation ! , Article mis à jour avec succés");
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success',"Felicitation ! , Article supprimé avec succés");
    }

    

    




}
 

