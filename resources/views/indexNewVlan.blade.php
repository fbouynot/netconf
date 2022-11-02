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
                            <label for="vlan_name" class="col-md-4 col-form-label text-md-end">{{ __('Vlan Name') }}</label>

                            <div class="col-md-6">
                                <input id="vlan_name" type="text" class="form-control @error('vlan_name') is-invalid @enderror" name="vlan_name" value="{{ old('vlan_name') }}" required autocomplete="vlan_name" autofocus>

                                @error('vlan_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="vlan_id" class="col-md-4 col-form-label text-md-end">{{ __('Vlan ID') }}</label>

                            <div class="col-md-6">
                                <input id="vlan_id" type="text" class="form-control @error('vlan_id') is-invalid @enderror" name="vlan_id" value="{{ old('vlan_id') }}" required autocomplete="vlan_id">

                                @error('vlan_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="subnet" class="col-md-4 col-form-label text-md-end">{{ __('Subnet') }}</label>

                            <div class="col-md-6">
                                <input id="subnet" type="text" class="form-control @error('subnet') is-invalid @enderror" name="subnet" value="{{ old('subnet') }}" required autocomplete="subnet">

                                @error('subnet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="ticket_number" class="col-md-4 col-form-label text-md-end">{{ __('Ticket number') }}</label>

                            <div class="col-md-6">
                                <input id="ticket_number" type="text" class="form-control @error('ticket_number') is-invalid @enderror" name="ticket_number" value="{{ old('ticket_number') }}" required autocomplete="ticket_number">

                                @error('ticket_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description">

                                @error('description')
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
                            <label for="environment" class="col-md-4 col-form-label text-md-end">{{ __('Environment') }}</label>

                            <div class="col-md-6">
                                <input list="environment" id="environment" class="form-control @error('environment') is-invalid @enderror" name="environment" value="{{ old('environment') }}" required autocomplete="environment">
                                <datalist id="environment">
                                    <option value="PRD">
                                    <option value="PRE">
                                    <option value="TTI">
                                    <option value="INP">
                                    <option value="ING">
                                    <option value="QVT">
                                    <option value="QPM">
                                    <option value="DEV">
                                </datalist>
                                @error('environment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tier" class="col-md-4 col-form-label text-md-end">{{ __('Tier') }}</label>

                            <div class="col-md-6">
                                <input list="tier" id="tier" class="form-control @error('tier') is-invalid @enderror" name="tier" value="{{ old('tier') }}" required autocomplete="tier">
                                <datalist id="tier">
                                    <option value="T0">
                                    <option value="T1">
                                    <option value="T1N">
                                    <option value="T1S">
                                    <option value="T1VSS">
                                </datalist>

                                @error('tier')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Generate') }}
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
