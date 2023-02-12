<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    
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

        .card_header{
            display: flex;
            justify-content: space-between;
        }

        .header_login{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .login_detail{
            font-size: 16px;
            margin-right: 1rem;
            padding: 10px
        }

        .btn_logout{
            border: 2px solid red;
            font-size: 12px;
            color: red;
            background-color: white;
            font-weight:bold;
            padding: 8px 16px;
            border-radius: 5px; 
        }

        .btn_logout:hover{
            border:2px solid red;
            border-radius:5px;
            font-size:12px;
            font-weight:bold;
            color:white;
            background-color:red;
            padding:8px 16px;
        }

        .title{
            font-weight:bold;
            font-size:24px;
            margin-bottom: 15px;
        }

        .btn_search{
            display: inline-block;
            border:2px solid #cdf119;
            border-radius:5px;
            font-size:12px;
            font-weight:bold;
            color:#cdf119;
            background-color:white;
            padding:8px 16px;
            margin-bottom: 10px;
            text-decoration: none;
        }

        .btn_search:hover{
            border:2px solid #cdf119;
            border-radius:5px;
            font-size:12px;
            font-weight:bold;
            color:white;
            background-color:#cdf119;
            padding:8px 16px;
        }

        .todo_form{
            margin-bottom:30px;
            display:flex;
            justify-content:space-between;
        }

        .todo_create{
            width:75%;
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

        .select-tag{
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
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

        .error{
            font-size:16px;
            font-weight:bold;
            color:red;
        }


    </style>
</head>
<body>
    <div class="all">
        <div class="card">
            <div class="card_header">
            <p class="title">Todo List</p>
            <div class="header_login">
                @if(Auth::check())
                <p class="login_detail">「{{$user->name}}」でログイン中</p>
                <form action="/logout" method="post">
                @csrf
                <input type="submit" value="ログアウト" class="btn_logout">
                @else
                <p class="loginn_error">ログインして下さい。(<a href="/login">ログイン</a>｜<a href="/register">登録</a>)</p>
                @endif
                
            </form>
            </div>
            </div>
            <a href="/find" class="btn_search">タスク検索</a>
            <div class="todo">
                <form action="/create" method="post" class="todo_form">
                @csrf
                    <input type="text" class="todo_create" name="content">
                    
                    <select name="tag_id" class="select-tag">
                        <option value="1">家事</option>
                        <option value="2">勉強</option>
                        <option value="3">運動</option>
                        <option value="4">食事</option>
                        <option value="5">移動</option>
                    </select>
                    
                    <input type="submit" class="create_btn" value="追加">
                    
                </form>
                @error('content')
                    <p class="error">{{$message}}</p>
                    @enderror
                <table>
                    
                    <tr>
                        <th>作成日</th>
                        <th>タスク名</th>
                        <th>タグ</th>
                        <th>更新</th>
                        <th>削除</th>
                    </tr>
                    @foreach($todos as $todo)
                    <tr>
                        <td>{{$todo->created_at}}</td>
                        <form action="/update" method="post" class="todo_update">
                            @csrf
                        
                        <td>
                            <input type="text" class="todo_update" name="content" value="{{$todo->content}}" >
                        </td>
                        <td>
                            <select name="tag_id" class="select-tag" value="{{$todo->tag_id}}">
                                <option value="1" @if($todo->tag_id==1) selected @endif>家事</option>
                                <option value="2" @if($todo->tag_id==2) selected @endif>勉強</option>
                                <option value="3" @if($todo->tag_id==3) selected @endif>運動</option>
                                <option value="4" @if($todo->tag_id==4) selected @endif>食事</option>
                                <option value="5" @if($todo->tag_id==5) selected @endif>移動</option>
                            </select>
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
                                <input type="hidden" name="content" value="{{$todo->content}}" >
                                <input type="hidden" name="tag_id" value="{{$todo->tag_id}}" >
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