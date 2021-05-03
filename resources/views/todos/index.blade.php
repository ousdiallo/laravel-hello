@extends('layouts.app')

@section('content')

<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-xs">
            <a name="" id="" class="btn btn-primary m-2" href="{{ route('todos.create') }}" role="button">Ajouter un todo</a>
        </div>
        <div class="col-xs">
            @if (Route::currentRouteName() === 'todos.index')
            <a name="" id="" class="btn btn-warning m-2" href="{{ route('todos.undone') }}" role="button">Voir les todos ouverts</a>
        </div>
        <div class="col-xs">
            <a name="" id="" class="btn btn-success m-2" href="{{ route('todos.done') }}" role="button">Voir les todos terminés</a>
            @elseif (Route::currentRouteName() === 'todos.done')
            <a name="" id="" class="btn btn-dark m-2" href="{{ route('todos.index') }}" role="button">Voir tous les todos</a>
        </div>
        <div class="col-xs">
            <a name="" id="" class="btn btn-warning m-2" href="{{ route('todos.undone') }}" role="button">Voir les todos ouverts</a>
            @elseif (Route::currentRouteName() === 'todos.undone')
            <a name="" id="" class="btn btn-dark m-2" href="{{ route('todos.index') }}" role="button">Voir tous les todos</a>
        </div>
        <div class="col-xs">
            <a name="" id="" class="btn btn-success m-2" href="{{ route('todos.done') }}" role="button">Voir les todos terminés</a>
            @endif
        </div>
    </div>
</div>

@foreach ($datas as $data)
<div class="alert alert-primary">
    <strong>{{ $data->name }} @if($data->done)<span class="badge badge-success">done</span>@endif</strong>
</div>
@endforeach

{{ $datas->links() }}
@endsection