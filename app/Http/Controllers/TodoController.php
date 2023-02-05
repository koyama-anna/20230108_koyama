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
            'todos' => array(),
            'input' => ''
        ];
        return view('search', $param);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        if (empty($request->content) == false) {
            $todos = Todo::where('content', 'LIKE BINARY', "%{$request->content}%")
                ->where('tag_id', $request->tag_id)->get();
        } else {
            $todos = Todo::where('tag_id', $request->tag_id)->get();
        };
        $param = [
            'user' => $user,
            'todos' => $todos,
            'input' => $request->input
        ];
        return view('search', $param);
    }
}
