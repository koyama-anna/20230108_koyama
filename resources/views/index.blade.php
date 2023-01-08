<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

    </style>
</head>
<body>
    <div class="all">
        <div class="card">
            <p class="title">Todo List</p>
            <div class="todo">
                <form action="/create" method="post" class="todo_form">
                @csrf
                    <input type="text" class="todo_create" name="content">
                    <input type="submit" class="create_btn" value="追加">
                    @error('content')
                    <p>{{$message}}</p>
                    @enderror
                </form>
                <table>
                    <tr>
                        <th>作成日</th>
                        <th>タスク名</th>
                        <th>更新</th>
                        <th>削除</th>
                    </tr>
                    @foreach($todos as $todo)
                    <tr>
                        <td>{{$todo->created_at}}</td>
                        <form action="/update" method="post" class="todo_update">
                            @csrf
                        
                        <td>
                            <input type="text" class="todo_update" value="{{$todo->content}}" name="content">
                        </td>
                        <td>
                            <button class="input_update">更新</button>
                        </td>
                        </form>
                        <td>
                            <form action="/remove" method="post" class="todo_remove">
                                @csrf
                                <button class="input_remove">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</body>
</html>