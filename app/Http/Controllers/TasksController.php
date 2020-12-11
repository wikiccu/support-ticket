<?php

namespace App\Http\Controllers;

use App\User;
use App\Task;
use App\Http\Requests;
// use App\Mailers\AppMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    /**
     * Display all tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$tasks = Task::paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Display all tickets by a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function userTasks()
    {
        $tasks = Task::where('user_id', Auth::user()->id)->paginate(10);

        return view('tasks.user_tasks', compact('tasks'));
    }

    /**
     * Show the form for opening a new ticket.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($ticket_id)
    {
        $ticket_id=$ticket_id;
        return view('tasks.create',compact('ticket_id'));
    }

    /**
     * Store a newly created ticket in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//, AppMailer $mailer
    {
        $this->validate($request, [
            'title'     => 'required',
            'priority'  => 'required',
            'message'   => 'required'
        ]);

        $task = new Task([
            'title'     => $request->input('title'),
            'user_id'   => Auth::user()->id,
            'ticket_id' => $request->input('ticket_id'),
            'priority'  => $request->input('priority'),
            'message'   => $request->input('message'),
            'status'    => "Open",
            'file_path' => $request->input('attach')
        ]);

        $task->save();

        // $mailer->sendTicketInformation(Auth::user(), $ticket);

        return redirect()->back()->with("status", "A ticket with ID: #$task->ticket_id has been opened.");
    }

    /**
     * Display a specified ticket.
     *
     * @param  int  $ticket_id
     * @return \Illuminate\Http\Response
     */
    public function show($task_id)
    {
        $task = Task::where('id', $task_id)->firstOrFail();

        $comments = $task->comments;


        return view('tasks.show', compact('task', 'comments'));
    }

    /**
     * Close the specified task.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function close($task_id)//, AppMailer $mailer
    {
        $task = Task::where('id', $task_id)->firstOrFail();

        $task->status = 'Closed';

        $task->save();

        $taskOwner = $task->user;

        // $mailer->sendtaskStatusNotification($taskOwner, $task);

        return redirect()->back()->with("status", "The ticket has been closed.");
    }
}
