<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        //全件取得
        $tasks = Task::all();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(TaskRequest $request)
    {
        //インスタンスの作成
        $memo = new Task();

        $memo->title = $request->title;
        $memo->body = $request->body;

        $memo->save();

        //登録したらindexに戻る
        return redirect(route('tasks.index'));
    }

    public function show($id)
    {
        $task = Task::find($id);
        return view('tasks.show', ['task' => $task]);
    }

    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(TaskRequest $request, $id)
    {
        //更新対象データの取得
        $task = Task::find($id);

        $task->title = $request->title;
        $task->body = $request->body;

        $task->save();

        //更新したらindexに戻る
        return redirect(route('tasks.index'));
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        //削除したらindexに戻る
        return redirect(route('tasks.index'));
    }
}

//localhost/tasks  タスク一覧、新規タスク登録
//localhost/tasks{1}  タスク詳細
//localhost/tasks{1}/edit  タスク編集
