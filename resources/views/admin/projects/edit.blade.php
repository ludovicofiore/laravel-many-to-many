@extends('layouts.app')

@section('content')
    <div>

        {{-- stampa errori --}}
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.projects.update', $projects) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    value="{{ old('title', $projects->title) }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tipologia</label>
                <select name="type_id" class="form-select">
                    <option value="" selected>Seleziona una tipologia</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @if (old('type_id', $projects->type?->id) == $type->id) selected @endif>
                            {{ $type->name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <p>Tecnologie</p>
                <div class="btn-group" role="group">

                    @foreach ($technologies as $technology)
                        <input value="{{ $technology->id }}" name="technologies[]" type="checkbox" class="btn-check"
                            id="technology-{{ $technology->id }}" autocomplete="off"
                            @if (
                                ($errors->any() && in_array($technology->id, old('technologies', []))) ||
                                    (!$errors->any() && $projects->technology->contains($technology))) checked @endif>
                        <label class="btn btn-outline-primary"
                            for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                    @endforeach

                </div>
            </div>

            <div class="mb-3">
                <label for="cover_img" class="form-label">Immagine</label>
                <input type="file" class="form-control @error('cover_img') is-invalid @enderror" name="cover_img"
                    id="cover_img">
                @error('cover_img')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <div class="mb-3">
                <label for="publication_date" class="form-label">Data di pubblicazione</label>
                <input type="date" class="form-control @error('publication_date') is-invalid @enderror"
                    name="publication_date" id="publication_date"
                    value="{{ old('publication_date', $projects->publication_date) }}">
                @error('publication_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    style="height: 100px">{{ old('description', $projects->description) }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
