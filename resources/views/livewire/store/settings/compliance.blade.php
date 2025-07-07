<div class="container">
    <!-- Header Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>Verification Requirements</h2>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.settings', $store) }}" class="text-inherit">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Verification</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <button type="submit" form="kycForm" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Settings Sidebar -->
        <div class="col-lg-3 col-md-4 mb-6 mb-md-0">
            @include('livewire.store.settings.sidebar',['store'=> $store])
        </div>

        <!-- Settings Content -->
        <div class="col-lg-9 col-md-8">
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @foreach($categories as $cat)
                <div class="card border-0 shadow-sm mb-6">
                    <div class="card-header bg-white py-4 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $cat['label'] }}</h4>
                        <span class="badge bg-info">{{ $cat['requirement'] === 'all' ? 'All Required' : 'Any One Required' }}</span>
                    </div>
                    <div class="card-body">
                        @if(count($cat['documents']))
                            <div class="row">
                                @foreach($cat['documents'] as $doc)
                                    <div class="col-md-6 mb-4">
                                        <div class="border rounded p-3 h-100">
                                            <h6 class="fw-bold mb-3">{{ ucwords(str_replace('_', ' ', $doc['key'])) }}</h6>
                                            <form wire:submit.prevent="submitVerification('{{ $cat['key'] }}', '{{ $doc['key'] }}')" enctype="multipart/form-data">
                                                @if(!empty($doc['require_file']))
                                                    <div class="mb-3">
                                                        <label class="form-label">Upload File</label>
                                                        <input type="file" class="form-control" wire:model="inputs.{{ $cat['key'] }}.{{ $doc['key'] }}.file">
                                                        @error('inputs.' . $cat['key'] . '.' . $doc['key'] . '.file') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                @endif
                                                @if(!empty($doc['require_document_number']))
                                                    <div class="mb-3">
                                                        <label class="form-label">Document Number</label>
                                                        <input type="text" class="form-control" wire:model.defer="inputs.{{ $cat['key'] }}.{{ $doc['key'] }}.number">
                                                        @error('inputs.' . $cat['key'] . '.' . $doc['key'] . '.number') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                @endif
                                                @if(!empty($doc['require_issue_date']))
                                                    <div class="mb-3">
                                                        <label class="form-label">Issue Date</label>
                                                        <input type="date" class="form-control" wire:model.defer="inputs.{{ $cat['key'] }}.{{ $doc['key'] }}.issue_date">
                                                        @error('inputs.' . $cat['key'] . '.' . $doc['key'] . '.issue_date') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                @endif
                                                @if(!empty($doc['require_expiry_date']))
                                                    <div class="mb-3">
                                                        <label class="form-label">Expiry Date</label>
                                                        <input type="date" class="form-control" wire:model.defer="inputs.{{ $cat['key'] }}.{{ $doc['key'] }}.expiry_date">
                                                        @error('inputs.' . $cat['key'] . '.' . $doc['key'] . '.expiry_date') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                @endif
                                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-muted">No requirements for this category.</div>
                        @endif
                    </div>
                </div>
            @endforeach

            <!-- Verification History -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Verification History</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Document</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($verifications as $verification)
                                    <tr>
                                        <td>{{ $verification->created_at->format('M d, Y') }}</td>
                                        <td>{{ ucwords(str_replace('_', ' ', $verification->name)) }}</td>
                                        <td>
                                            @if($verification->document)
                                                <a href="{{ Storage::disk('public')->url($verification->document) }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td><span class="badge bg-{{ $verification->status === 'verified' ? 'success' : ($verification->status === 'rejected' ? 'danger' : 'warning') }}">{{ ucfirst($verification->status) }}</span></td>
                                        <td>{{ $verification->comments }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No verification history found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>