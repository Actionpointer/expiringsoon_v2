@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end mb-3">
            <div class="col-sm">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Settings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Plans</li>
                    </ol>
                </nav>
                <h1 class="page-header-title">Plans Settings</h1>
            </div>
        </div>
        @include('backend.settings.partials.menu')
    </div>

    
    
</div>
@endsection
