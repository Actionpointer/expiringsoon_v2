<?php

namespace App\Livewire\Store\Settings;

use App\Models\Store;
use Livewire\Component;
use App\Models\User;
use App\Models\StoreUser;
use App\Notifications\StoreNotifications\NewStaffNotification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Permission;

class TeamMembers extends Component
{
    public Store $store;
    public $members = [];
    public $invitees = [];
    public $inviteEmail = '';
    public $inviteRole = '';
    public $invitePermissions = [];
    public $inviteMessage = '';
    public $roles;
    public $allPermissions;
    public $selectedRolePermissions;
    public $viewProfileUser = null;
    public $permissionsByCategory;
    public $memberRoleNames = [];
    public $modal_error = null;

    public function mount($store){
        $this->store = $store;
        $this->roles = collect(Role::where('type', 'store')->get());
        $this->allPermissions = collect(Permission::all());
        $this->permissionsByCategory = $this->allPermissions->groupBy('category');
        $this->selectedRolePermissions = collect();
        $this->loadMembers();
    }

    public function loadMembers()
    {
        $this->members = StoreUser::with('user')
            ->where('store_id', $this->store->id)
            ->where('status', 'active')
            ->get();
        $this->invitees = StoreUser::with('user')
            ->where('store_id', $this->store->id)
            ->where('status', 'pending')
            ->get();
        $this->memberRoleNames = [];
        foreach ($this->members as $member) {
            $roleId = $member->role_id ?? null;
            $this->memberRoleNames[$member->user_id] = $this->getRoleName($roleId);
        }
        foreach ($this->invitees as $invitee) {
            $roleId = $invitee->role_id ?? null;
            $this->memberRoleNames[$invitee->user_id] = $this->getRoleName($roleId);
        }
    }

    public function inviteTeamMember()
    {
        $this->validate([
            'inviteEmail' => 'required|email',
            'inviteRole' => 'required',
            'invitePermissions' => 'array',
        ]);
        $user = User::where('email', $this->inviteEmail)->first();
        $newlyCreated = false;
        $password = null;
        if (!$user) {
            $password = Str::random(10);
            $user = User::create([
                'email' => $this->inviteEmail,
                'firstname' => 'Staff',
                'surname' => $this->store->name,
                'password' => Hash::make($password),
                'country_id' => $this->store->country_id
            ]);
            $newlyCreated = true;
        }

        // Check if already invited
        $existing = StoreUser::where('store_id', $this->store->id)
            ->where('user_id', $user->id)
            ->first();
        if ($existing) {
            if ($existing->status === 'pending') {
                $this->modal_error = 'This user has already been invited.';
                return; 
            }
            if ($existing->status === 'active') {
                $this->modal_error = 'This user is already a team member.';
                return;
            }
        }

        StoreUser::create([
            'store_id' => $this->store->id,
            'user_id' => $user->id,
            'role_id' => $this->inviteRole,
            'permissions' => $this->invitePermissions,
            'status' => 'pending',
        ]);

        // Send notification
        $user->notify(new NewStaffNotification($this->store,$password,$newlyCreated));

        $this->loadMembers();
        $this->inviteEmail = '';
        $this->inviteRole = '';
        $this->invitePermissions = [];
        $this->inviteMessage = '';
        session()->flash('success', 'Invitation sent successfully!');
        $this->dispatch('closeModal', ['modalId' => 'inviteTeamMemberModal']); 
    }

    public function selectedInviteRole($value)
    {
        $role = $this->roles->first(function($role) use ($value) {
            return $role->id == $value;
        });
        if ($role) {
            $this->invitePermissions = is_array($role->permissions) ? array_map('strval', $role->permissions) : [];
            $this->selectedRolePermissions = is_array($role->permissions) ? $role->permissions : [];
        } else {
            $this->invitePermissions = [];
            $this->selectedRolePermissions = [];
        }
        //dd($this->members);
    }

    public function getRoleName($roleId)
    {
        $role = $this->roles->first(function($role) use ($roleId) {
            return $role->id == $roleId;
        });
        return $role ? $role->name : 'N/A';
    }

    public function showProfile($userId)
    {
        $member = $this->members->where('user_id', $userId)->first();
        $invitee = $this->invitees->where('user_id', $userId)->first();
        $this->viewProfileUser = $member ?? $invitee;
        $this->dispatch('showProfileModal');
    }

    public function render()
    {
        return view('livewire.store.settings.team-members')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
