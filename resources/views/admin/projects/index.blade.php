@extends('layouts.app')

@section('content')
    <h3>Elenco progetti</h3>

    @if (session('deleted'))
        <div class="alert alert-success container my-5" role="alert">
            {{ session('deleted') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Titolo</th>
                <th scope="col">Tipologia</th>
                <th scope="col">Technologie</th>
                <th scope="col">Data di pubblicazione</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th>{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td><span class="badge text-bg-success">{{ $project->type?->name }}</span></td>
                    <td>
                        @forelse ($project->technology as $technology)
                            <span class="badge text-bg-info">{{ $technology->name }}</span>
                        @empty
                            <span>-</span>
                        @endforelse

                    </td>
                    <td>{{ $project->publication_date->format('d/m/Y') }}</td>
                    <td>
                        <div class="d-flex">

                            <a class="btn btn-primary mx-1"
                                href="{{ route('admin.projects.show', $project->id) }}">Mostra</a>
                            <a class="btn btn-warning mx-1"
                                href="{{ route('admin.projects.edit', $project->id) }}">Modifica</a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="post"
                                onsubmit="return confirm('Sei sicuro di voler eliminare {{ $project->title }}?')">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger mx-1" type="submit">Elimina</button>
                            </form>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $projects->links() }}
@endsection
