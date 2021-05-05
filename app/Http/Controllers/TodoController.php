<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Todo::paginate(8);
        return view('todos.index', compact('datas'));
    }

    /**
     * Display a list of undone todos
     * 
     */
    public function undone()
    {
        $datas = Todo::where('done', 0)->paginate(8);
        return view('todos.index', compact('datas'));
    }

    /**
     * Display a list of done todos
     * 
     */
     public function done()
    {
        $datas = Todo::where('done', 1)->paginate(8);
        return view('todos.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->save();

        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        if(!isset($request->done)){
            $request['done'] = 0;
        }
        $todo->update($request->all());
        return redirect()->route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return back();
    }

    /** 
     * Make a todo done
     * @param Todo $todo
     * @return void
    */
    public function makedone(Todo $todo)
    {
        $todo->done = 1;
        $todo->update();
        return back();
    }

    /** 
     * Make a todo done
     * @param Todo $todo
     * @return void
    */
    public function makeundone(Todo $todo)
    {
        $todo->done = 0;
        $todo->update();
        return back();
    }
}