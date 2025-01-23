@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
    <div class="container">
        <h2>Super Admin Dashboard</h2>
        <form action="{{ route('superadmin.invite') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="email">Customer Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
                @if ($errors->has('email'))
                    <small id="" class="form-text text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>
            <div class="form-group mb-3">
                <label for="master_id">Provide Master Username:</label>
                <input type="master_id" name="master_id" id="master_id" class="form-control" required>
                @if ($errors->has('master_id'))
                    <small id="" class="form-text text-danger">{{ $errors->first('master_id') }}</small>
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

        <h3 class="mt-4">Invited Customers</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Expires At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invitations as $invite)
                    <tr>
                        <td>{{ $invite->email }}</td>
                        <td>{{ $invite->signed_up }} </td>
                        <td>
                            @if ($invite->role_id == 2)
                                Admin
                            @elseif ($invite->role_id == 1)
                                Super Admin
                            @else
                                Member
                            @endif
                        </td>
                        <td>{{ $invite->expires_at }}</td>
                        <td>
                            @if ($invite->signed_up == 'TimeOut or Expired' || $invite->signed_up == 'pending')
                                <a href="{{ route('superadmin.invite.delete', $invite->id) }}"
                                    class="btn btn-danger mx-2">Delete Invitation</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        <ul class="pagination pagination-sm m-0 float-right">
            <div class="d-flex justify-content-center">
                {{ $invitations->links() }}
            </div>
        </ul>
    </div>
@endsection
