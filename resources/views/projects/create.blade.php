@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1>Nuovo Progetto</h1>
    </div>
    <div class="container">
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}" id="title" aria-describedby="titleHelp">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="mb-3">
                    <label for="website_link" class="form-label">Link sito</label>
                    <input type="text" name="website_link"
                        class="form-control @error('website_link') is-invalid @enderror" value="{{ old('website_link') }}"
                        id="website_link" aria-describedby="titleHelp">
                    @error('website_link')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="type-id" class="form-label">Tipo</label>
                    <select class="form-select @error('type_id') is-invalid @enderror" id="type-id" name="type_id"
                        aria-label="Default select example">
                        <option value="" selected>Seleziona categoria</option>
                        @foreach ($types as $type)
                            <option @selected(old('type_id') == $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('type_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="technologies" class="form-label">Tecnologia</label>
                    <div class="d-flex flex-wrap gap-3 @error('technologies') is-invalid @enderror">
                        @foreach ($technologies as $key => $technology)
                            <div class="form-check">
                                <input name='technologies[]' @checked(in_array($technology->id, old('technologies', []))) class="form-check-input"
                                    type="checkbox" value="{{ $technology->id }}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $technology->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('technologies')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Crea</button>
        </form>
    </div>
@endsection
