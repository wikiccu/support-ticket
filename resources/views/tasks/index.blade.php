@extends('layouts.app')

@section('title', 'کلیه وظایف')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
	        		<i class="fa fa-ticket"> وظایف </i>
	        	</div>

	        	<div class="panel-body">
	        		@if ($tasks->isEmpty())
						<p>در حال حاظر وظیفه ای وجود ندارد</p>
	        		@else
		        		<table class="table">
		        			<thead>
		        				<tr>
		        					<th>عنوان </th>
		        					<th>وضعیت</th>
		        					<th>آخرین تغییرات</th>
		        					<th style="text-align:center" colspan="2">امکانات</th>
		        				</tr>
		        			</thead>
		        			<tbody>
		        			@foreach ($tasks as $task)
								<tr>
		        					{{-- <td>
		        					@foreach ($categories as $category)
		        						@if ($category->id === $task->category_id)
											{{ $category->name }}
		        						@endif
		        					@endforeach
		        					</td> --}}
		        					<td>
		        						<a href="{{ url('admin/tasks/'. $task->id) }}">
		        							#{{ $task->task_id }} - {{ $task->title }}
		        						</a>
		        					</td>
		        					<td>
		        					@if ($task->status === 'Open')
		        						<span class="label label-success">{{ $task->status }}</span>
		        					@else
		        						<span class="label label-danger">{{ $task->status }}</span>
		        					@endif
		        					</td>
		        					<td>{{ $task->updated_at }}</td>
		        					<td>
		        						<a href="{{ url('admin/tasks/' . $task->id) }}" class="btn btn-primary">کامنت</a>
		        					</td>
		        					<td>
		        						<form action="{{ url('admin/close_task/' . $task->id) }}" method="POST">
		        							{!! csrf_field() !!}
		        							<button type="submit" class="btn btn-danger">بستن</button>
		        						</form>
		        					</td>
		        				</tr>
		        			@endforeach
		        			</tbody>
		        		</table>

		        		{{ $tasks->render() }}
		        	@endif
	        	</div>
	        </div>
	    </div>
	</div>
@endsection