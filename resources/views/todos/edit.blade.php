@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Modification du Todo <span class="badge badge-dark">n°{{ $todo->id }}</span></h4>
    </div>
    <div class="card-body">

        <form action="{{ route('todos.update', $todo->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Titre</label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp"
                    value="{{ old('name', $todo->name) }}" />
                <small id="nameHelp" class="form-text text-muted">Entrez le titre de votre todo.</small>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" class="form-control" id="description" aria-describedby="nameHelp"
                    value="{{ old('description', $todo->description) }}" />
            </div>
            <div class="form-group form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="done" id="done"
                        {{ $todo->done ? 'checked': ''}} value=1>
                    Done ?
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection