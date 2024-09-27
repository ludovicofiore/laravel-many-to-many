@extends('layouts.app')

@section('content')
    <div>

        <h2>{{ $projects->title }}</h2>

        <div>
            <h4>Tipologia</h4>
            @if ($projects->type?->name === null)
                <p class="text-danger">Tipologia non disponibile</p>
            @else
                <p class="badge text-bg-success">{{ $projects->type->name }}</p>
            @endif
        </div>

        <div>
            <h4>Tecnologie</h4>
            <ul>
                @forelse ($projects->technology as $technology)
                    <li><span class="badge text-bg-info">{{ $technology->name }}</span></li>
                @empty
                    <span class="text-danger">Non sono presenti tecnologie</span>
                @endforelse

            </ul>
        </div>

        {{-- <div>
            <h4>Immagine</h4>
            @if ($projects->cover_img === null)
                <p class="text-danger">Immagine non disponibile</p>
            @else
                <img src="{{ $projects->cover_img }}" alt="{{ $projects->title }}">
            @endif
        </div> --}}

        <div>
            <h4>Immagine</h4>
            <img src="{{ asset('storage/' . $projects->cover_img) }}" alt="{{ $projects->original_img_name }}"
                onerror="this.src='/img/no-image.jpg'">
        </div>

        <div>
            <h4>Descrizione</h4>
            <p>
                {{ $projects->description }}
            </p>

            <h4>Data di pubblicazione</h4>
            <p>
                {{ $projects->publication_date->format('d/m/Y') }}
            </p>



            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Torna indietro</a>
        </div>
    @endsection
