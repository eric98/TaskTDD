<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;

class UserTasksController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
//        $tasks = Task::all();
        $tasks = Task::where('user_id',$user->id)->get();
//        dd($tasks);
        return view('user_tasks', ['tasks'=>$tasks,'user'=>$user]);
    }
}
