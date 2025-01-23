@extends('layouts.app')

@section('title', 'My URLs')

@section('content')
    <div class="container">
        <h2>My Shortened URLs</h2>

        <div class="mb-4">
            <a href="{{ route('member.urls.create') }}" class="btn btn-primary">Shorten URL</a>
        </div>

        @if ($urls->isEmpty())
            <div class="alert alert-warning">
                No URLs found. Start by shortening a URL!
            </div>
        @else
            <!-- URLs Table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Short URL</th>
                        <th>Long URL</th>
                        <th>Hits</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($urls as $url)
                        <tr>
                            <td>
                                <a href="{{ url($url->short_url) }}" target="_blank">{{ url($url->short_url) }}</a>
                            </td>
                            <td>{{ $url->long_url }}</td>
                            <td>{{ $url->hits }}</td>
                            <td>
                                <button class="btn btn-secondary btn-sm copy-btn"
                                    onclick="copyToClipboard('{{ url($url->short_url) }}')">Copy</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $urls->links() }}
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Short URL copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        }
    </script>
@endsection
