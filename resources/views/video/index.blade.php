@extends('app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Videos
                </div>

                <div class="card-body">
                    <ul>
                        @foreach ($videos as $video)
                            <li>{{ $video->name }}</li>
                        @endforeach
                    </ul>

                    {{ $videos->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
