<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\UserAccess;

/**
 * @PolicyName(viewAny="Просмотр всех меню", view="Просмотр меню", create="Создание меню", update="Редактирование меню", delete="Удаление меню", restore="Изменение количества заказа", forceDelete="Изменение статуса Проверено куратором"
 */
class MenunewPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Menu $menu): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Menu $menu): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Menu $menu): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Menu $menu): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Menu $menu): bool
    {
        return false;
    }
    
    public function testcheck(User $user, $menu_id): bool
    {
        $checks = UserAccess::all()->toArray();
//        dd($menu_id);
//        if ($menu_id == 10) {dd(count($checks[0]));}
//        dd($checks);
//        dd(count($checks[0]));
        if ($checks[0]['access_denied'] == $menu_id) {
            return false;
        } else {
            return true;
        }
        
    }
}
