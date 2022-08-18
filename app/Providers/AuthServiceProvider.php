<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Member;
use App\Models\Permission;
use App\Models\Room;
use App\Models\Unbookable;
use App\Policies\HotelPolicy;
use App\Policies\RoomPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any auth`entication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach (Permission::all() as $permission) {
            Gate::define($permission->name, function($user, $guard) use ($permission) {
                $permission = Permission::whereName($permission->name)->whereGuard($guard)->first();
                return $user->hasPermission($permission);
            });
        }


        Gate::define('member-update', function($user, Member $member) {
            if (guard('admin')) {
                return true;
            }

            if (guard('manager')) {
                return $member->manager_id == $user->id;
            }

        });

        Gate::define('hotel-update', function($user, Hotel $hotel) {
            if (guard('admin')) {
                return true;
            }

            if (guard('manager')) {
                return $hotel->manager_id == $user->id;
            }

            if (guard('member')) {
                return $user->hotel_id == $hotel->id;
            }
        }); 

        Gate::define('room-viewAny', function($user, Hotel $hotel) {
            if (guard('admin')) {
                return true;
            }

            if (guard('manager')) {
                return $hotel->manager_id == $user->id;
            }

            if (guard('member')) {
                return $hotel->id == $user->hotel_id;
            }
        });

        Gate::define('room-update', function($user, Hotel $hotel,  Room $room) {

            if ($room->hotel_id != $hotel->id) {
                abort(404);
            }

            if (guard('admin')) {
                return true;
            }

            if (guard('manager')) {
                return $room->hotel->manager_id == $user->id;
            }

            if (guard('member')) {
                return $room->hotel_id == $user->hotel_id;
            }
        });

        Gate::define('booking-viewAny', function($user, Hotel $hotel) {
            if (guard('admin')) {
                return true;
            }

            if (guard('manager')) {
                return $hotel->manager_id == $user->id;
            }

            if (guard('member')) {
                return $hotel->id == $user->hotel_id;
            }
        });

        Gate::define('booking-view', function($user, Hotel $hotel, Booking $booking) {

            if ($booking->room->hotel_id != $hotel->id) {
                return abort(404);
            }

            if (guard('admin')) {
                return true;
            }

            if (guard('manager')) {
                return $booking->room->hotel->manager_id == $user->id;
            }

            if (guard('member')) {
                return $booking->room->hotel->id == $user->hotel_id;
            }

            if (guard('web')) {
                return $booking->user_id == $user->id;
            }

        });

        Gate::define('unbookable-viewAny', function($user, Hotel $hotel) {

            if (guard('admin')) {
                return true;
            }

            if (guard('manager')) {
                return $hotel->manager_id == $user->id;
            }

            if (guard('member')) {
                return $hotel->id == $user->hotel_id;
            }

        });

        Gate::define('unbookable-delete', function($user, Hotel $hotel, Unbookable $unbookable) {

            if ($unbookable->room->hotel_id != $hotel->id) {
                return abort(404);
            }

            if (guard('admin')) {
                return true;
            }

            if (guard('manager')) {
                return $unbookable->room->hotel->manager_id == $user->id;
            }

            if (guard('member')) {
                return $unbookable->room->hotel_id == $user->hotel_id;
            }

        });

    }
}
