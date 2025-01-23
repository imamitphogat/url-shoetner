@extends('layouts.app')

@section('title', 'URL Stats')

@section('content')
    <div class="container">
        <h2>Statistics for Short URL: {{ url('/' . $url->short_url) }}</h2>
        <table class="table table-bordered">
            <tr>
                <th>Short URL</th>
                <td><a href="{{ url('/' . $url->short_url) }}" target="_blank">{{ url('/' . $url->short_url) }}</a></td>
            </tr>
            <tr>
                <th>Long URL</th>
                <td>{{ $url->long_url }}</td>
            </tr>
            <tr>
                <th>Total Clicks</th>
                <td>{{ $url->hits }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $url->created_at }}</td>
            </tr>
            <tr>
                <th>Last Updated</th>
                <td>{{ $url->updated_at }}</td>
            </tr>
        </table>
        <a href="{{ route('urls.index') }}" class="btn btn-secondary">Back to My URLs</a>
    </div>
@endsection
