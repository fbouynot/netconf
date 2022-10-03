@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Polflex creation form') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('configPolflex') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="subnet_lan" class="col-md-4 col-form-label text-md-end">{{ __('LAN subnet') }}</label>

                            <div class="col-md-6">
                                <input id="subnet_lan" type="text" class="form-control @error('subnet_lan') is-invalid @enderror" name="subnet_lan" value="{{ old('subnet_lan') }}" required autocomplete="subnet_lan">

                                @error('subnet_lan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="subnet_telemetry" class="col-md-4 col-form-label text-md-end">{{ __('Telemetry subnet') }}</label>

                            <div class="col-md-6">
                                <input id="subnet_telemetry" type="text" class="form-control @error('subnet_telemetry') is-invalid @enderror" name="subnet_telemetry" value="{{ old('subnet_telemetry') }}" required autocomplete="subnet_telemetry">

                                @error('subnet_telemetry')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="admin_password" class="col-md-4 col-form-label text-md-end">{{ __('Firewall admin password') }}</label>

                            <div class="col-md-6">
                                <input id="admin_password" type="password" class="form-control @error('admin_password') is-invalid @enderror" name="admin_password" value="{{ old('admin_password') }}" required autocomplete="admin_password">

                                @error('admin_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="psk" class="col-md-4 col-form-label text-md-end">{{ __('Tunnel PSK') }}</label>

                            <div class="col-md-6">
                                <input id="psk" type="password" class="form-control @error('psk') is-invalid @enderror" name="psk" value="{{ old('psk') }}" required autocomplete="psk">

                                @error('psk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pfx_file" class="col-md-4 col-form-label text-md-end">{{ __('Certificate PFX PKCS12') }}</label>

                            <div class="col-md-6">
                                <input id="pfx_file" type="file" class="form-control @error('pfx_file') is-invalid @enderror" name="pfx_file" value="{{ old('pfx_file') }}" required autocomplete="pfx_file">

                                @error('pfx_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pfx_password" class="col-md-4 col-form-label text-md-end">{{ __('Certificate password') }}</label>

                            <div class="col-md-6">
                                <input id="admin_password" type="password" class="form-control @error('pfx_password') is-invalid @enderror" name="pfx_password" value="{{ old('pfx_password') }}" required autocomplete="pfx_password">

                                @error('pfx_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Génerer') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
