@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Polflex creation form') }}</div>
                    @include('fortigateRule', array(
                                                'srcintf' => 'internal',
                                                'dstintf' => 'wan1',
                                                'srcaddr' => 'all',
                                                'dstaddr' => 'all',
                                                'action' => 'accept',
                                                'services' => '"HTTP" "HTTPS"',
                                                'nat' => 'enable'
                                                ))
            </div>
        </div>
    </div>
</div>
@endsection
