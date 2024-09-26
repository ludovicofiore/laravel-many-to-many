@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1>Gestione tecnologie</h1>

        {{-- messaggio successo eliminazione --}}
        @if (session('deleted'))
            <div class="alert alert-success container my-5" role="alert">
                {{ session('deleted') }}
            </div>
        @endif

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

        <div class="row">
            <div class="col-5">

                <form class="d-flex justify-content-between" action="{{ route('admin.technologies.store') }}" method="POST">
                    @csrf
                    <input type="text" name="name" class="form-control" placeholder="nuova tecnologia">
                    <button type="submit" class="btn btn-success">Invia</button>
                </form>

                <table class="table">
                    <tbody>
                        @foreach ($technologies as $technology)
                            <tr>
                                <td>
                                    <form action="{{ route('admin.technologies.update', $technology) }}" method="POST"
                                        id="form-edit{{ $technology->id }}">
                                        @csrf
                                        @method('PUT')

                                        <input type="text" name="name" value="{{ $technology->name }}"
                                            class="border border-0">
                                    </form>


                                </td>
                                <td>
                                    <button type="submit" class="btn btn-warning"
                                        onclick="editTypeForm({{ $technology->id }})">Aggiorna</button>
                                </td>

                                <td>
                                    <form action="{{ route('admin.technologies.destroy', $technology) }}" method="post"
                                        onsubmit="return confirm('Sei sicuro di voler eliminare {{ $technology->name }}?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger mx-1" type="submit">Elimina</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <script>
        function editTypeForm(id) {
            const form = document.getElementById(`form-edit${id}`)
            form.submit();
        }
    </script>
@endsection
