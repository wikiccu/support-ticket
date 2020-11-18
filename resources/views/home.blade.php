@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">داشبورد</div>

                <div class="panel-body">
                    <p>شما وارد شدید</p>

                    @if (Auth::user()->is_admin)
                        <p>
                            تمام   <a href="{{ url('admin/tickets') }}">تیکت ها</a> یا  <a href="{{ url('new_ticket') }}">وظیفه جدید</a> ایجاد کنید
                        </p>
                    @else
                        <p>
                            تمام  <a href="{{ url('my_tickets') }}">تیکت های</a> خودتان را ببینید یا <a href="{{ url('new_ticket') }}">تیکت جدید ایجاد کنید</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
