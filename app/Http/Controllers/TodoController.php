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
        $todos = Todo::where('user_id', Auth::user()->id)->get();
        $param = ['todos' => $todos, 'user' => $user];
        return view('index', $param);
    }

    public function create(TodoRequest $request)
    {
        $user = Auth::user()->id;
        $form = $request->all();
        unset($form['_token']);
        $param = ['user_id' => $user];
        $param_merge = array_merge($form, $param);
        Todo::create($param_merge);
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
        if (empty($request->content) == false && empty($request->tag_id) == false) {
            $todos = Todo::where('content', 'LIKE BINARY', "%{$request->content}%")
                ->where('tag_id', $request->tag_id)->get();
        } elseif (empty($request->content) == true && empty($request->tag_id) == false) {
            $todos = Todo::where('tag_id', $request->tag_id)->get();
        } elseif (empty($request->content) == false && empty($request->tag_id) == true) {
            $todos = Todo::where('content', 'LIKE BINARY', "%{$request->content}%")->get();
        } else {
            $todos = array();
        };
        //dd($todos);
        $param = [
            'user' => $user,
            'todos' => $todos,
            'input' => $request->input
        ];
        //dd($param);
        return view('search', $param);
    }
}
