<?php

namespace App\Http\Controllers\Admin;

use App\Models\Verification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplianceController extends Controller
{

    public function index(Request $request){
        $query = Verification::query()
            ->with(['profile', 'approver', 'rejection', 'location'])
            ->latest();

        // Status filter
        if ($request->has('status')) {
            $status = $request->get('status');
            $query->where('status', $status);
        }

        // Verification type filter
        if ($request->has('type')) {
            $type = $request->get('type');
            $query->where('type', $type);
        }

        // Date range filter
        if ($request->has('start_date')) {
            $query->whereDate('created_at', '>=', $request->get('start_date'));
        }
        if ($request->has('end_date')) {
            $query->whereDate('created_at', '<=', $request->get('end_date'));
        }

        // Search filter
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->whereHas('profile', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            });
        }

        // Get paginated results
        $verifications = $query->paginate(10)->withQueryString();

        // Get counts for different statuses
        $counts = [
            'total' => Verification::count(),
            'pending' => Verification::where('status', 'pending')->count(),
            'approved' => Verification::where('status', 'approved')->count(),
            'rejected' => Verification::where('status', 'rejected')->count(),
        ];

        // Verification types for filter dropdown
        $verificationTypes = [
            'id' => 'ID Verification',
            'address' => 'Proof of Address',
            'company_cert' => 'Company Certificate',
            'memart' => 'Memorandum & Articles',
        ];

        // Statuses for filter dropdown
        $verificationStatuses = [
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
        ];

        // Get active filters for the view
        $activeFilters = $this->getActiveFilters($request);

        return view('compliance.kyc.all', compact(
            'documents', 
            'counts', 
            'activeFilters',
            'documentTypes',
            'documentStatuses'
        ));
    }

    public function update(Request $request){
        $request->validate([
            'document_ids' => 'required|array',
            'document_ids.*' => 'exists:documents,id',
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'required_if:status,rejected|nullable|string',
        ]);

        $verifications = Verification::whereIn('id', $request->document_ids)->get();

        foreach ($verifications as $verification) {
            if ($request->status === 'approved') {
                $verification->update([
                    'status' => 'approved',
                    'approved_at' => now(),
                    'approved_by' => auth()->id(),
                ]);
            } else if ($request->status === 'rejected') {
                $verification->update(['status' => 'rejected']);
                
                // Create rejection record
                $verification->rejection()->create([
                    'reason' => $request->notes,
                    'rejected_by' => auth()->id(),
                ]);
            }
        }

        return response()->json([
            'message' => 'Status updated successfully',
            'count' => count($request->document_ids)
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function show(Verification $verification){
        $verification->load(['profile', 'approver', 'rejection', 'location']);
        
        return view('compliance.kyc.view-documents', compact('verification'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function getActiveFilters(Request $request): array
    {
        $filters = [];

        if ($request->has('status')) {
            $filters['status'] = [
                'label' => ucfirst($request->status),
                'value' => $request->status,
            ];
        }

        if ($request->has('type')) {
            $filters['type'] = [
                'label' => ucfirst(str_replace('_', ' ', $request->type)),
                'value' => $request->type,
            ];
        }

        if ($request->has('start_date')) {
            $filters['start_date'] = [
                'label' => 'From ' . $request->start_date,
                'value' => $request->start_date,
            ];
        }

        if ($request->has('end_date')) {
            $filters['end_date'] = [
                'label' => 'To ' . $request->end_date,
                'value' => $request->end_date,
            ];
        }

        return $filters;
    }
}
