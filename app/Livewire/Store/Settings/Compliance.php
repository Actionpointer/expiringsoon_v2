<?php

namespace App\Livewire\Store\Settings;

use App\Models\Store;
use App\Models\CountryVerification;
use App\Models\Verification;
use Livewire\Component;
use Livewire\WithFileUploads;

class Compliance extends Component
{
    use WithFileUploads;

    public Store $store;
    public $countryVerification;
    public $verifications = [];
    public $categories = [];
    public $inputs = [];

    public function mount($store){
        $this->store = $store;
        $this->countryVerification = CountryVerification::where('country_id', $store->country_id)->first();
        $this->verifications = Verification::where('store_id', $store->id)->orderByDesc('created_at')->get();
        $this->categories = [
            [
                'key' => 'id',
                'label' => 'Government ID',
                'requirement' => $this->countryVerification->id_requirement ?? 'any',
                'documents' => $this->countryVerification->id_documents ?? [],
            ],
            [
                'key' => 'business',
                'label' => 'Business Documents',
                'requirement' => $this->countryVerification->business_requirement ?? 'any',
                'documents' => $this->countryVerification->business_documents ?? [],
            ],
            [
                'key' => 'address',
                'label' => 'Address Verification',
                'requirement' => $this->countryVerification->address_requirement ?? 'any',
                'documents' => $this->countryVerification->address_documents ?? [],
            ],
            [
                'key' => 'additional',
                'label' => 'Additional Requirements',
                'requirement' => $this->countryVerification->additional_requirement ?? 'any',
                'documents' => $this->countryVerification->additional_documents ?? [],
            ],
        ];
    }

    public function submitVerification($categoryKey, $docKey)
    {
        $docConfig = collect($this->categories)
            ->firstWhere('key', $categoryKey)['documents'] ?? [];
        $doc = collect($docConfig)->firstWhere('key', $docKey);
        if (!$doc) {
            session()->flash('error', 'Invalid document type.');
            return;
        }
        $rules = [];
        $messages = [];
        $inputPath = "inputs.$categoryKey.$docKey";
        if (!empty($doc['require_file'])) {
            $rules["$inputPath.file"] = 'required|file|max:10240';
            $messages["$inputPath.file.required"] = 'File is required.';
        }
        if (!empty($doc['require_document_number'])) {
            $rules["$inputPath.number"] = 'required|string|max:255';
        }
        if (!empty($doc['require_issue_date'])) {
            $rules["$inputPath.issue_date"] = 'required|date';
        }
        if (!empty($doc['require_expiry_date'])) {
            $rules["$inputPath.expiry_date"] = 'required|date|after_or_equal:' . ($this->inputs[$categoryKey][$docKey]['issue_date'] ?? 'today');
        }
        $validated = $this->validate($rules, $messages);
        $filePath = null;
        if (!empty($doc['require_file']) && isset($this->inputs[$categoryKey][$docKey]['file'])) {
            $filePath = $this->inputs[$categoryKey][$docKey]['file']->store('verifications', 'public');
        }
        Verification::create([
            'user_id' => auth()->id(),
            'store_id' => $this->store->id,
            'name' => $docKey,
            'document' => $filePath,
            'issue_date' => $this->inputs[$categoryKey][$docKey]['issue_date'] ?? null,
            'expiry_date' => $this->inputs[$categoryKey][$docKey]['expiry_date'] ?? null,
            'status' => 'pending',
            'comments' => null,
        ]);
        $this->verifications = Verification::where('store_id', $this->store->id)->orderByDesc('created_at')->get();
        // Reset only this document's form
        $this->inputs[$categoryKey][$docKey] = [];
        session()->flash('success', 'Document submitted successfully!');
    }

    public function render()
    {
        return view('livewire.store.settings.compliance')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
