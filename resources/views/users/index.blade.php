@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="row mx-0 ">
            <div class="col-12 d-flex  gap-2 flex-wrap">
            <a class="btn btn-success mb-2" href="{{ route('users.create') }}">Create New User</a>
            <a class="btn btn-warning mb-2" href="{{ route('users.export') }}">Export</a>
            <a class="btn btn-info mb-2" href="{{ route('users.pdf') }}">Pdf</a>

            </div>

        </div>
        
    </div>
</div>

@session('success')
    <div class="alert alert-success" role="alert"> 
        {{ $value }}
    </div>
@endsession

<table class="table table-bordered">
   <tr>
       <th>No</th>
       <th>Name</th>
       <th>Email</th>
       <th>Roles</th>
       <th width="280px">Action</th>
   </tr>
   @foreach ($data as $key => $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
               <label class="badge bg-success">{{ $v }}</label>
            @endforeach
          @endif
        </td>
        <td>
             <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}"> Show</a>
             <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"> Edit</a>
              <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                  @csrf
                  @method('DELETE')

                  <button type="submit" class="btn btn-danger btn-sm"> Delete</button>
              </form>
        </td>
    </tr>
 @endforeach
</table>

{!! $data->links('pagination::bootstrap-5') !!}


@endsection
