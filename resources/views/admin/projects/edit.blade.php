@extends('layouts.app')
@section('content')
    <section>
        <div class="container">
            <form action="{{ route('admin.projects.update', $project) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" required name="name" id="name" placeholder="Project Name"
                        value="{{ old('name', $project->name) }}">
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" required name="start_date" id="start_date"
                        value="{{ old('start_date', $project->start_date) }}">
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" name="end_date" id="end_date"
                        value="{{ old('end_date', $project->end_date) }}">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    {{-- @dump($project->status) --}}
                    <select class="form-select" name="status" id="status">
                        <option value="">Seleziona uno stato</option>
                        <option value="pending" {{ old('status', $project->status) == 'pending' ? 'selected' : '' }}>Pending
                        </option>
                        <option value="ongoing" {{ old('status', $project->status) == 'ongoing' ? 'selected' : '' }}>Ongoing
                        </option>
                        <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>
                            Completed</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type_id" class="form-label">Types</label>
                    <select class="form-select" name="type_id" id="type_id">
                        <option value="">Select a Type</option>
                        @foreach ($types as $type)
                            <option @selected(old('type_id', optional($project->type)->id) == $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <p>Select Technologies</p>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($technologies as $technology)
                            <div class="form-check">
                                <input name="technologies[]" class="form-check-input" type="checkbox"
                                    value="{{ $technology->id }}" id="thecnology-{{ $technology->id }}"
                                    @checked(in_array($technology->id, old('technologies', $project->technologies->pluck('id')->all())))>
                                <label class="form-check-label" for="thecnology-{{ $technology->id }}">
                                    {{ $technology->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Project Description">{{ old('description', $project->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Edit">
                </div>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>
@endsection
