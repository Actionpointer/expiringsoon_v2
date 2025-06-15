@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    @include('backend.settings.countries.partials.navigation')

    <div class="row mb-4">
        <div class="col-sm-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend input-group-text">
                    <i class="bi-search"></i>
                </div>
                <input id="search" type="text" class="form-control" placeholder="Search subscription plans...">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row justify-content-sm-end">
                <div class="col-sm-auto">
                    <select class="form-select form-select-sm" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-12 col-md">
                    <h5 class="card-header-title">Subscription Plans</h5>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubscriptionPlanModal">
                        <i class="bi-plus me-1"></i> Add Plan
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>Plan Name</th>
                        <th>Description</th>
                        <th>Commission</th>
                        <th>Products</th>
                        <th>Newsletter Credits</th>
                        <th>Storage</th>
                        <th>Staff</th>
                        <th>Withdrawal</th>
                        <th>Price ({{ $country->currency_symbol }})</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscription_plan as $plan)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="d-block h5 text-inherit mb-0">{{ $plan->name }}</span>
                                @if($plan->is_default)
                                <span class="badge bg-soft-info ms-2">Default</span>
                                @endif
                            </div>
                        </td>
                        <td>{{ Str::limit($plan->description, 50) }}</td>
                        <td>{{ $plan->commission }}%</td>
                        <td>{{ $plan->products }}</td>
                        <td>{{ $plan->newsletter_credits }}</td>
                        <td>{{ $plan->storage_mb }} MB</td>
                        <td>{{ $plan->staff }}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <span>{{ ucfirst(str_replace('_', ' ', $plan->withdrawal_interval)) }}</span>
                                <small>{{ $plan->withdrawal_count }}/month</small>
                                <small>{{ $country->currency_symbol }}{{ $plan->minimum_withdrawal }} - {{ $country->currency_symbol }}{{ $plan->maximum_withdrawal }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span>{{ $country->currency_symbol }}{{ $plan->monthly_price }}/month</span>
                                <small>{{ $country->currency_symbol }}{{ $plan->annual_price }}/year</small>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                @if($plan->is_active)
                                <span class="badge bg-success mb-1">Active</span>
                                @else
                                <span class="badge bg-danger mb-1">Inactive</span>
                                @endif
                                
                                @if($plan->is_public)
                                <span class="badge bg-info">Public</span>
                                @else
                                <span class="badge bg-secondary">Private</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button"
                                    class="btn btn-white btn-sm edit-plan-btn"
                                    data-plan="{{$plan}}">
                                    <i class="bi-pencil-square"></i>
                                </button>
                                <button type="button"
                                    class="btn btn-white btn-sm delete-plan-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deletePlanModal"
                                    data-type="subscription"
                                    data-id="{{ $plan->id }}"
                                    data-name="{{ $plan->name }}">
                                    <i class="bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    <!-- Sample Rows for Preview -->
                    
                </tbody>
            </table>
        </div>
    </div>


</div>
@include('backend.settings.countries.partials.modals')
@endsection

@push('scripts')
<script>
    $('.edit-plan-btn').on('click',function(){
        const plan = JSON.parse($(this).attr('data-plan'))
        $('#edit_id').val(plan.id);
        $('#edit_name').val(plan.name);
        $('#edit_description').val(plan.description);
        $('#edit_commission').val(plan.commission);
        $('#edit_products').val(plan.products);
        $('#edit_staff').val(plan.staff);
        $('#edit_storage_mb').val(plan.storage_mb);
        $('#edit_newsletter_credits').val(plan.newsletter_credits);
        $('#edit_price_monthly').val(plan.monthly_price);
        $('#edit_price_yearly').val(plan.annual_price);
        $('#edit_withdrawal_interval').val(plan.withdrawal_interval);
        $('#edit_withdrawal_count').val(plan.withdrawal_count);
        $('#edit_min_withdrawal').val(plan.minimum_withdrawal);
        $('#edit_max_withdrawal').val(plan.maximum_withdrawal);
        $('#edit_is_public').prop('checked',plan.is_public);
        $('#edit_is_default').prop('checked',plan.is_default);
        $('#edit_is_active').prop('checked',plan.is_active);
        $('#editSubscriptionPlanModal').modal('show')
    })
    document.addEventListener('DOMContentLoaded', function() {
        // Handle edit plan buttons
        document.querySelectorAll('.edit-plan-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const planId = this.getAttribute('data-id');
                editSubscriptionPlan(planId);
            });
        });
        
        // Handle delete plan buttons
        document.querySelectorAll('.delete-plan-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const planType = this.getAttribute('data-type');
                const planId = this.getAttribute('data-id');
                const planName = this.getAttribute('data-name');
                deletePlan(planType, planId, planName);
            });
        });
        
        // Handle the delete plan confirmation
        document.querySelector('#deletePlanModal .btn-danger').addEventListener('click', function() {
            const planType = $('#deletePlanType').value;
            const planId = $('#deletePlanId').value;
            
            // In a real app, you'd make an AJAX request to delete the plan
            console.log(`Deleting ${planType} plan with ID: ${planId}`);
            
            // Close the modal
            $('#deletePlanModal').modal('hide');
            
            // Optionally show a success message or reload the page
            // location.reload();
        });
    });
    
    // Other functions defined in modals.blade.php should be available here
   
</script>
@endpush