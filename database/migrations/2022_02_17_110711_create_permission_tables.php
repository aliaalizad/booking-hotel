<?php

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Permission::class);
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreignIdFor(Role::class);
            $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps();
        });

        Schema::create('permissionables', function (Blueprint $table) {
            $table->id();
            $table->string('permissionable_type');
            $table->unsignedBigInteger('permissionable_id');
            $table->foreignIdFor(Permission::class);
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->timestamps();
        });

        Schema::create('roleables', function (Blueprint $table) {
            $table->id();
            $table->string('roleable_type');
            $table->unsignedBigInteger('roleable_id');
            $table->foreignIdFor(Role::class);
            $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissionables');
        Schema::dropIfExists('roleables');
    }
};
