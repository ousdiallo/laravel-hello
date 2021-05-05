@extends('layouts.app')

@section('content')

<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-xs">
            <a name="" id="" class="btn btn-primary m-2" href="{{ route('todos.create') }}" role="button">Ajouter un
                todo</a>
        </div>
        <div class="col-xs">
            @if (Route::currentRouteName() === 'todos.index')
            <a name="" id="" class="btn btn-warning m-2" href="{{ route('todos.undone') }}" role="button">Voir les todos
                ouverts</a>
        </div>
        <div class="col-xs">
            <a name="" id="" class="btn btn-success m-2" href="{{ route('todos.done') }}" role="button">Voir les todos
                terminés</a>
            @elseif (Route::currentRouteName() === 'todos.done')
            <a name="" id="" class="btn btn-dark m-2" href="{{ route('todos.index') }}" role="button">Voir tous les
                todos</a>
        </div>
        <div class="col-xs">
            <a name="" id="" class="btn btn-warning m-2" href="{{ route('todos.undone') }}" role="button">Voir les todos
                ouverts</a>
            @elseif (Route::currentRouteName() === 'todos.undone')
            <a name="" id="" class="btn btn-dark m-2" href="{{ route('todos.index') }}" role="button">Voir tous les
                todos</a>
        </div>
        <div class="col-xs">
            <a name="" id="" class="btn btn-success m-2" href="{{ route('todos.done') }}" role="button">Voir les todos
                terminés</a>
            @endif
        </div>
    </div>
</div>

@foreach ($datas as $data)
<div class="alert alert-{{ $data->done ? 'primary' : 'warning' }}">
    <div class="row">
        <div class="col-sm">
            <strong>{{ $data->name }} @if($data->done)<span class="badge badge-success">done</span>@endif</strong>
        </div>
        <div class="col-sm form-inline justify-content-end my-1">
            {{----------Button done / undone----------}}
            @if ($data->done == 0)
            <form action="{{ route('todos.makedone', $data->id) }}" method="post">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success mx-1" style="min-width: 90px">Done</button>
            </form>
            @else
            <form action="{{ route('todos.makeundone', $data->id) }}" method="post">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-warning mx-1" style="min-width: 90px">Undone</button>
            </form>
            @endif
            {{----------Button Edit----------}}
            <a name="" id="" class="btn btn-info mx-1" href="{{ route('todos.edit', $data->id) }}"
                role="button">Editer</a>
            {{-- Button Effacer --}}
            <form action="{{ route('todos.destroy', $data->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mx-1">Effacer</button>
            </form>
        </div>
    </div>
</div>
@endforeach

{{ $datas->links() }}
@endsection