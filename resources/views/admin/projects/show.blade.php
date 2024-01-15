@extends('layouts.app')
@section('content')
    <section>
        <div class="container">
            <div class="container">
                <h1>{{ $project->name }}</h1>
                @if ($project->type)
                    <p><strong>{{ isset($project->type) ? $project->type->name : '-' }}</strong></p>
                @endif
                <ul class="d-flex gap-2 ps-0">
                    @foreach ($project->technologies as $technology)
                        <li class="badge rounded-pill text-bg-primary">{{ $technology->name }}</li>
                    @endforeach ()
                </ul>
                <p>{{ $project->description }}</p>
                <p>{{ $project->start_date }}</p>
                <p>{{ $project->end_date }}</p>
                <p>{{ $project->status }}</p>
            </div>
            <div class="container mb-3">
                <div class="row">
                    <div class="col-auto">
                        <a class="btn btn-sm btn-warning" href="{{ route('admin.projects.edit', $project) }}">Modifica</a>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger btn-sm" type="submit" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            {!! $project->content !!}
        </div>
    </section>
@endsection
