@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container">
        <h2>Admin Dashboard</h2>
        <form action="{{ route('admin.invite') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="email">Team Member Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
                @if ($errors->has('email'))
                    <small id="" class="form-text text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>
            <div class="form-group mb-3">
                <label for="role_id">Select Role:</label>
                <select name="role_id" id="role_id" class="form-control" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('role_id'))
                    <small id="" class="form-text text-danger">{{ $errors->first('role_id') }}</small>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Send Invitation</button>
        </form>

        <div class="">
            <h3 class="mt-4">Team Members </h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teamMembers as $member)
                        <tr>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <ul class="pagination pagination-sm m-0 float-right">
                    <div class="d-flex justify-content-center">
                        {{ $teamMembers->links() }}
                    </div>
                </ul>
            </div>
        </div>
    </div>
@endsection
