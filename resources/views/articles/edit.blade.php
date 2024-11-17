@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Modifier le article</h2>



    <ul>
        @foreach ($errors->all() as $error)
            <li class="alert alert-danger"> {{ $error }}</li>
        @endforeach
    </ul>


    <form action="{{ route('articles.update',$article->id) }}" method="POST" class="bg-light p-4 rounded shadow-sm">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="nom_article">Nom de l'Article</label>
            <input type="text" name="nom_article" value="{{ $article->nom_article}}" required class="form-control" />
        </div>
        
        <div class="form-group mb-3">
            <label for="quantite_stock">La Quantité en Stock</label>
            <input type="text" name="quantite_stock" value="{{ $article->quantite_stock}}" required class="form-control" />
        </div>
        <div class="form-group mb-3">
            <label for="prix">Le Prix de l'Article</label>
            <input type="number" name="prix" value="{{ $article->prix}}" required class="form-control" />
        </div>


        

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </form>
</div>
@endsection
