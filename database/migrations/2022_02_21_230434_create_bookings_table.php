<?php

use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignIdFor(Room::class);
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->string('room_number');
            $table->date('checkin');
            $table->date('checkout');
            $table->string('voucher')->nullable()->unique();
            $table->integer('amount');  
            $table->enum('status', ['unpaid', 'paid', 'pending', 'confirmed', 'rejected']);
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
        Schema::dropIfExists('bookings');
    }
};
