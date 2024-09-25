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

        <form action="{{ route('admin.projects.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    value="{{ old('title') }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tipologia</label>
                <select name="type_id" class="form-select">
                    <option value="" selected>Seleziona una tipologia</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @if (old('type_id') == $type->id) selected @endif>
                            {{ $type->name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label for="cover_img" class="form-label">Url immagine</label>
                <input type="text" class="form-control @error('cover_img') is-invalid @enderror" name="cover_img"
                    id="cover_img" value="{{ old('cover_img') }}">
                @error('cover_img')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <div class="mb-3">
                <label for="publication_date" class="form-label">Data di uscita</label>
                <input type="date" class="form-control @error('publication_date') is-invalid @enderror"
                    name="publication_date" id="publication_date" value="{{ old('publication_date') }}">
                @error('publication_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    style="height: 100px">{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
