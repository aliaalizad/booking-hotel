<?php

use App\Models\State;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(State::class);
            $table->float('longitude', 8, 4)->nullable();
            $table->float('latitude', 8, 4)->nullable();
        });

        foreach(config('predefined.cities') as $city) {
            DB::insert("insert into cities (id, name, state_id, longitude, latitude) values (?, ?, ?, ?, ?)", $city);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
