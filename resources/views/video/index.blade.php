@extends('app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Videos
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Channel</th>
                                <th scope="col">Views in first hour</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $video)
                                <tr>
                                    <td>{{ $video->name }}</td>
                                    <td>{{ $video->channel_name }}</td>
                                    <td>{{ $video->views_first_hour }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $videos->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
