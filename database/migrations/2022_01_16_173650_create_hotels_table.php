<?php

use App\Models\City;
use App\Models\Manager;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('phone');
            $table->string('address');
            $table->foreignIdFor(Manager::class);
            $table->foreign('manager_id')->references('id')->on('managers');
            $table->foreignIdFor(City::class);
            $table->boolean('is_bookable')->default(0);
            $table->integer('min_bookable')->default(1);
            $table->integer('max_bookable')->default(14); // 2 weeks
            $table->integer('bookable_until')->default(90); // 3 months
            $table->json('rules')->nullable();
            $table->json('notification_mobiles')->nullable();
            $table->json('coordinates')->nullable();
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
        Schema::dropIfExists('hotels');
    }
}
