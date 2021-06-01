@extends('layouts.app')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Punchin/out History</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('punchins.create') }}"> Add PunchIn</a>
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
            <th>Employee</th>
            <th>PunchIn DateTime</th>
            <th>PunchOut DateTime</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($punchins as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->employe_id }}</td>
            <td>{{ $product->punchin_datetime }}</td>
            <td>{{ $product->punchout_datetime }}</td>
            <td>
                <form action="{{ route('punchins.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('punchins.show',$product->id) }}">Show</a>
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?');">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $punchins->links() !!}
        
@endsection