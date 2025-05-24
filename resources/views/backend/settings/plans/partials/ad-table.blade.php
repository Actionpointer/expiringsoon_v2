<div class="table-responsive">
    <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
        <thead class="thead-light">
            <tr>
                <th>Format Name</th>
                <th>Type</th>
                <th>Dimensions</th>
                <th>Description</th>
                <th>Instructions</th>
                <th>Pricing</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adPlans as $plan)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <span class="d-block h5 text-inherit mb-0">{{ $plan->name }}</span>
                    </div>
                </td>
                <td>{{ $plan->type }}</td>
                <td>
                    @if($plan->width && $plan->height)
                        {{ $plan->width }}x{{ $plan->height }}
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $plan->description }}</td>
                <td>{{ $plan->instruction }}</td>
                <td>
                    <div class="d-flex flex-column">
                        @foreach($plan->prices as $price)
                        <span class="badge bg-soft-primary mb-1">
                            {{ $price->currency->symbol }}{{ $price->amount }} / {{ $price->duration }}
                        </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <button type="button" 
                                class="btn btn-white btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editAdPlanModal"
                                onclick="editAdPlan({{ $plan->id }})">
                            <i class="bi-pencil-square"></i>
                        </button>
                        <button type="button" 
                                class="btn btn-white btn-sm"
                                data-bs-toggle="modal" 
                                data-bs-target="#deletePlanModal"
                                onclick="deletePlan('ad', {{ $plan->id }}, '{{ $plan->name }}')">
                            <i class="bi-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div> 