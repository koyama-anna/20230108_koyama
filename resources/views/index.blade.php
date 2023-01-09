<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="resources/css/reset.css">
    
    <style>
        .all{
            background-color:#2d197c;
            height:100vh;
            width:100vw;
            position:relative;
        }

        .card{
            background-color:white;
            border-radius:10px;
            width:50vw;
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
            padding:30px;
        }

        .title{
            font-weight:bold;
            font-size:24px;
            margin-bottom:15px;
        }

        .todo_form{
            margin-bottom:30px;
            display:flex;
            justify-content:space-between;
        }

        .todo_create{
            width:80%;
            border:1px solid #ccc;
            border-radius:5px;
            font-size:14px;
        }

        .create_btn{
            border:2px solid #dc70fa;
            border-radius:5px;
            font-size:12px;
            font-weight:bold;
            color:#dc70fa;
            background-color:white;
            padding:8px 16px;
        }

        .create_btn:hover{
            border:2px solid #dc70fa;
            border-radius:5px;
            font-size:12px;
            font-weight:bold;
            color:white;
            background-color:#dc70fa;
            padding:8px 16px;
        }

        .error{
            color:red;
            font-weight:bold;
            font-size:18px;
        }

        table{
            text-align:center;
            width:100%;
            border-collapse:collapse;
            line-height:4;
        }

        th{
            font-weight:bold;
            padding-bottom:15px;
        }

        tr{
            display:table-row;
        }

        .todo_update{
            width:90%;
            padding:5px;
            border:1px solid #ccc;
            border-radius:5px;
            font-size:14px;
        }

        .input_update{
            border:2px solid #fa9770;
            border-radius:5px;
            font-size:12px;
            font-weight:bold;
            color:#fa9770;
            background-color:white;
            padding:8px 16px;
        }

        .input_update:hover{
            border:2px solid #fa9770;
            border-radius:5px;
            font-size:12px;
            font-weight:bold;
            color:white;
            background-color:#fa9770;
            padding:8px 16px;
        }

        .input_remove{
            border:2px solid #71fadc;
            border-radius:5px;
            font-size:12px;
            font-weight:bold;
            color:#71fadc;
            background-color:white;
            padding:8px 16px;
        }

        .input_remove:hover{
            border:2px solid #71fadc;
            border-radius:5px;
            font-size:12px;
            font-weight:bold;
            color:white;
            background-color:#71fadc;
            padding:8px 16px;
        }


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
                            <input type="text" class="todo_update" name="content" value="{{$todo->content}}" name="content">
                        </td>
                        <td>
                        <input type="hidden" name="id" value="{{$todo->id}}">
                            <button type="submit" class="input_update">更新</button>
                        </td>
                        </form>
                        <td>
                            <form action="/remove" method="post" class="todo_remove">
                                @csrf
                                <input type="hidden" name="id" value="{{$todo->id}}">
                                <input type="hidden" name="content" value="{{$todo->content}}" name="content">
                                <button type="submit" class="input_remove">削除</button>
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