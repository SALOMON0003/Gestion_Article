@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

@endsection

@section('content')
    <div class="container mt-4">
        <h2 class="text-center mb-4">Liste des articles</h2>

        

        @if(session('success'))
            <div class="alert alert-success" style="color: red; font-weight: bold;" >
                {{ session('success') }}
            </div>
        @endif


        @if(session('error'))
        <div style="color: red; font-weight: bold;">
            {{ session('error') }}
        </div>
        @endif


        <div class="text-right mb-3 d-flex justify-content-between">
            <!-- Bouton de retour à la page d'accueil avec une icône -->
            <a href="{{route('dashboard')}}" class="btn btn-primary">
                <i class="bi bi-arrow-left-circle me-2"></i>Retour à la page d'accueil
            </a>

            <!-- Afficher un bouton pour chaque catégorie -->
  


            
            <!-- Bouton d'ajout d'un article avec une icône -->
            <a href="{{route('articles.create')}}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Ajouter un article
            </a>
        </div>


        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nom de l'Article</th>
                    <th scope="col">La Quantité de Stock</th>
                    <th scope="col">Le Prix</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
        <!--</div>-->
            @foreach ($articles as $article)
                
                <tr>
                    <td>{{ $article->nom_article }}</td>
                    <td>{{ $article->quantite_stock }}</td>
                    <td>{{ $article->prix }}</td>
                    

                    <td>
                        <a href="{{ route('articles.edit',$article->id) }}" class="btn btn-warning btn-sm" style="color:white"><i class="fa-solid fa-pen-to-square"></i>Modifier</a>
                        <form action="{{ route('articles.destroy',$article->id) }}" method="POST" style="display:inline; margin-right: 3rem; margin-left: 3rem" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette article ?')"><i class="fa-solid fa-trash"></i>Supprimer</button>
                        </form>
                        <a href="{{ route('articles.show',$article->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i>Voir les détails</a>

                    </td>
                    
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>
     <!-- Affichage de la pagination -->
     {{ $articles->links() }}

@endsection
