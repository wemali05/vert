@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD with Image</h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Name</th>
            <th>Date From</th>
            <th>Date To</th>
            <th>Total Budget</th>
            <th>Daily Budget</th>
        </tr>
        @foreach ($records as $key => $record)
        <tr>
            <td>{{ $key }}</td>
            <td><img src="{{ URL::asset('uploads/' . $record->image) }}" width="100px" class="d-block"></td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->date_from }}</td>
            <td>{{ $record->date_to }}</td>
            <td>{{ $record->total_budget }}</td>
            <td>{{ $record->daily_budget }}</td>
            <td>
                <a class="btn btn-sm btn-info" href="{{ route('campaigns.show',$record->id) }}">Show</a>
                <a class="btn btn-sm btn-primary" href="{{ route('campaigns.edit',$record->id) }}">Edit</a>
                <form action="{{ route('campaigns.destroy',$record->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $records->links() !!}
@endsection