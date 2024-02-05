<?php

namespace App\Policies;

use App\Models\candidatePortalInvitation;
use App\Models\User;

class candidatePortalInvitationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('{{ viewAnyPermission }}');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, candidatePortalInvitation $candidateportalinvitation): bool
    {
        return $user->checkPermissionTo('{{ viewPermission }}');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('{{ createPermission }}');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, candidatePortalInvitation $candidateportalinvitation): bool
    {
        return $user->checkPermissionTo('{{ updatePermission }}');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, candidatePortalInvitation $candidateportalinvitation): bool
    {
        return $user->checkPermissionTo('{{ deletePermission }}');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, candidatePortalInvitation $candidateportalinvitation): bool
    {
        return $user->checkPermissionTo('{{ restorePermission }}');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, candidatePortalInvitation $candidateportalinvitation): bool
    {
        return $user->checkPermissionTo('{{ forceDeletePermission }}');
    }
}
