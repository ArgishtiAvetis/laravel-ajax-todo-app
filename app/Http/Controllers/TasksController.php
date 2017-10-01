<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    public function index() {

    	$tasks = Task::all();

    	return view('welcome', compact('tasks'));
    }

    public function single($id) {

    	$task = Task::find($id);

    	return view('single', compact('task'));
    }

    public function add(Request $request) {
        $this->validate(request(), [
            'body' => 'required',
            'user_id' => 'required'
        ]);   	
    
     	$task = new Task();

     	$task->body = request('body'); 
     	$task->user_id = request('user_id');

     	$task->save();

        $newTask = Task::where('body', request('body'))->first();

     	return response()->json(["id" => $newTask->id, "body" => $newTask->body]);
    }

    public function delete($id) {

    	$task = Task::find($id);
    	$task->delete();  

        return response()->json(["status" => "success"]);
    }
}
