@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h1>{{ $project->title }}
                    @if ($project->type)
                        <span class="badge bg-secondary">{{ $project->type->name }}</span>
                    @else
                        <span class="badge bg-secondary">Nessuna categoria</span>
                    @endif
                </h1>
                <p>/{{ $project->slug }}</p>
                <ul class="ps-0 d-flex gap-1">
                    @forelse($project->technologies as $technology)
                        <span class="badge rounded-pill text-bg-light">{{ $technology->name }}</span>
                    @empty
                        -
                    @endforelse
                </ul>
            </div>

            <div class="d-flex">
                <a class="btn btn-sm btn-secondary" href="{{ route('projects.edit', $project) }}">Modifica</a>
                @if ($project->trashed())
                    <form action="{{ route('projects.restore', $project) }}" method="POST">
                        @csrf
                        <input class="btn btn-sm btn-success" type="submit" value="Riprisitina">
                    </form>
                @endif
            </div>

        </div>
    </div>
    <div class="container">
        <p>
            {{ $project->description }}
        </p>
    </div>
    <div class="container">
        <h3>Articoli correlati</h3>
        @if ($project->type)
            <ul>
                @foreach ($project->type->projects as $related_project)
                    <li>
                        <a href="{{ route('projects.show', $related_project) }}">
                            {{ $related_project->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            nessun articolo correlato
        @endif
    </div>
@endsection
