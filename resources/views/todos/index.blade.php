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
            <p class="my-0">
                <strong><span class="badge badge-dark">n°{{ $data->id }}</span></strong>
                <small>
                    Créée {{ $data->created_at->from() }} par

                    {{ Auth::user()->id == $data->user->id ? 'moi' : $data->user->name }}

                    @if ($data->todoAffectedTo && $data->todoAffectedTo->id == Auth::user()->id)
                    affectée à moi
                    @elseif ($data->todoAffectedTo)
                    {{ $data->todoAffectedTo ? ', affectée à ' . $data->todoAffectedTo->name : ''}}
                    @endif
                    {{--    --}}
                    @if ($data->todoAffectedTo && $data->todoAffectedBy && $data->todoAffectedBy->id ==
                    Auth::user()->id)
                    par moi-même :D
                    @elseif ($data->todoAffectedTo && $data->todoAffectedBy && $data->todoAffectedBy->id !=
                    Auth::user()->id)
                    par {{ $data->todoAffectedBy->name }}
                    @endif
                </small>

                @if($data->done)
                <small>
                    <p>
                        Terminée
                        {{ $data->updated_at->from() }} - En durant
                        {{ $data->updated_at->diffForHumans($data->created_at, 1) }}
                    </p>
                </small>
                @endif
            </p>
            <details>
                <summary>
                    <strong>{{ $data->name }} @if($data->done)<span
                            class="badge badge-success">done</span>@endif</strong>
                </summary>
                <p>{{ $data->description }}</p>
            </details>
        </div>
        <div class="col-sm form-inline justify-content-end my-1">
            {{-- Button Affecter à... --}}
            <div class="dropdown open">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Affecter à
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($users as $user)
                    <a href="/todos/{{ $data->id }}/affectedTo/{{ $user->id }}"
                        class="dropdown-item">{{ $user->name }}</a>
                    @endforeach
                </div>
            </div>
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
            @can('edit', $data)
            <a name="" id="" class="btn btn-info mx-1" href="{{ route('todos.edit', $data->id) }}"
                role="button">Editer</a>
            @elsecannot('edit', $data)
            <a name="" id="" class="btn btn-info mx-1 disabled" href="{{ route('todos.edit', $data->id) }}"
                role="button">Editer</a>
            @endcan
            {{-- Button Effacer --}}
            @can('delete', $data)
            <form action="{{ route('todos.destroy', $data->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mx-1">Effacer</button>
            </form>
            @elsecannot('delete', $data)
            <form action="{{ route('todos.destroy', $data->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mx-1 disabled">Effacer</button>
            </form>
            @endcan
        </div>
    </div>
</div>
@endforeach

{{ $datas->links() }}
@endsection