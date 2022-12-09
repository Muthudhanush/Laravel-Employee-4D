@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="col-md-6">
   
</div>
                <div class="card-header">{{ __('Dashboard') }}
                    <div class="row">
                    <div class="col-lg-6">
                        
                    <a href="{{url('/AddEmployee')}}" class="btn btn-primary"> Add Employee </a>
                    </div>

                    <div class="col-lg-6">
                    <a href="{{url('/file-export')}}" class="btn btn-secondary">Export</a>
                    </div>

                    <div id="timer">Hello</div>
                    <a href="" id="start" class="btn btn-secondary">Export</a>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

                   
                    </div>
                </div>
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-hover">
    <thead>
        <th>Emp Id</th>
        <th>Emp Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Department</th>
        <th>Actions</th>
    </thead>
    <tbody>
        @if ($Employees->count() == 0)
        <tr>
            <td colspan="5">No Employees to display.</td>
        </tr>
        @endif

        @foreach ($Employees as $Employee)
        <tr>
            <td>{{ $Employee->emp_id }}</td>
            <td>{{ $Employee->emp_name }}</td>
            <td>{{ $Employee->email }}</td>
            @if($Employee->role == 1)
            <td>Agent</td>
            @else
            <td>Supervisor</td>
            @endif

            @if($Employee->department == 1)
            <td>Hr</td>
            @elseif($Employee->department == 2)
            <td>Software</td>
            @else
            <td>Information Technology</td>
            @endif
            <td>
                <a class="btn btn-sm btn-primary" href="{{ url('/editEmployee/'.$Employee->id) }}">Edit</a>
                <form action="{{url('/deleteEmployee/'.$Employee->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>

                </form>
                
                    <a href="{{url('/sendEmail/'.$Employee->id)}}" class="btn btn-dark">Send Email</a>
                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function incTimer() {
        var currentMinutes = Math.floor(totalSecs / 60);
        var currentSeconds = totalSecs % 60;
        if(currentSeconds <= 9) currentSeconds = "0" + currentSeconds;
        if(currentMinutes <= 9) currentMinutes = "0" + currentMinutes;
        totalSecs++;
        $("#timer").text(currentMinutes + ":" + currentSeconds);
        setTimeout('incTimer()', 1000);
    }

    totalSecs = 0;

    $(document).ready(function() {
        $("#start").click(function() {
            incTimer();
        });
    });
</script>
@stop
