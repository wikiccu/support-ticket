@extends('layouts.app')
@section('title', $task->title)
@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
	        		#{{ $task->task_id }} - {{ $task->title }}
	        	</div>
	        	<div class="panel-body">
	        		@include('includes.flash')
	        		<div class="ticket-info">
	        			<p>{{ $task->message }}</p>
		        			{{-- <p>دسته بندی: {{ $category->name }}</p> --}}
		        		<p>
	        			@if ($task->status === 'Open')
    						وضعیت: <span class="label label-success">{{ $task->status }}</span>
    					@else
    						وضعیت: <span class="label label-danger">{{ $task->status }}</span>
    					@endif
		        		</p>
		        		<p>ایجاد شده در : {{ $task->created_at->diffForHumans() }}</p>
	        		</div>
	        			<hr>
	        		<div class="comments">
	        			@foreach ($comments as $comment)
	        				<div class="panel panel-@if($task->user->id === $comment->user_id){{"default"}}@else{{"success"}}@endif">
	        					<div class="panel panel-heading">
	        						{{ $comment->user->name }}
	        						<span class="pull-right">{{ $comment->created_at->format('Y-m-d') }}</span>
	        					</div>

	        					<div class="panel panel-body">
	        						{{ $comment->comment }}		
	        					</div>
	        				</div>
	        			@endforeach
	        		</div>
	        		<div class="comment-form">
		        		<form action="{{ url('comment') }}" method="POST" class="form">
		        			{!! csrf_field() !!}

		        			<input type="hidden" name="task_id" value="{{ $task->id }}">

		        			<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <textarea rows="10" id="comment" class="form-control" name="comment"></textarea>

                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
	                        </div>
	                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">ارسال</button>
	                        </div>
		        		</form>
	        	</div>
	        </div>
	    </div>
	</div>
@endsection