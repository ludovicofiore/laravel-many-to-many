@extends('layouts.app')

@section('content')
    <div>

        <h2>{{ $projects->title }}</h2>

        <div>
            <h4>Tipologia</h4>
            @if ($projects->type?->name === null)
                <p class="text-danger">Tipologia non disponibile</p>
            @else
                <p>{{ $projects->type->name }}</p>
            @endif
        </div>

        <div>
            @if ($projects->cover_img === null)
                <p class="text-danger">Immagine non disponibile</p>
            @else
                <img src="{{ $projects->cover_img }}" alt="{{ $projects->title }}">
            @endif
        </div>

        <div>
            <h4>Descrizione</h4>
            <p>
                {{ $projects->description }}
            </p>

            <h4>Data di pubblicazione</h4>
            <p>
                {{ $projects->publication_date }}
            </p>



            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Torna indietro</a>
        </div>
    @endsection
