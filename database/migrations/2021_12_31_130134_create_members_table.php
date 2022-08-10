<?php

use App\Models\Hotel;
use App\Models\Manager;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username', 10)->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->boolean('is_blocked')->default(0);
            $table->foreignIdFor(Hotel::class);
            $table->foreignIdFor(Manager::class);
            $table->foreign('manager_id')->references('id')->on('managers');
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
        Schema::dropIfExists('members');
    }
}
