@extends('layout')

@section('content')

    <a href="{{ route('users.create')}}" type="button" class="btn btn-light">Add</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Create At</th>
            <th scope="col">Update At</th>
            <th scope="col">Actions</th>

        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('users.edit', ['id' => $user->id]) }}" type="button"
                       class="btn btn-light">Edit</a>

                    <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="post">
                        @method('delete')
                        @csrf
                        <input type="submit" class="btn btn-light" value="Delete"/>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No users</td>
            </tr>
        @endforelse

        </tbody>
    </table>
@endsection
