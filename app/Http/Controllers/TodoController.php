<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\Tag;
use App\Models\User;

class TodoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $todos = Todo::all();
        $param = ['todos' => $todos, 'user' => $user];
        return view('index', $param);
    }

    public function create(TodoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::create($form);
        return redirect('/');
    }

    public function update(TodoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::where('id', $request->id)->update($form);
        return redirect('/');
    }

    public function remove(TodoRequest $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/');
    }

    public function find()
    {
        $user = Auth::user();
        $param = [
            'user' => $user,
            'input' => ''
        ];
        return view('search', $param);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $todo = Todo::where('content', 'LIKE BINARY', "%{$request->input}%")->get();
        $param = [
            'user' => $user,
            'todo' => $todo,
            'input' => $request->input
        ];
        return view('search', $param);
    }
}
