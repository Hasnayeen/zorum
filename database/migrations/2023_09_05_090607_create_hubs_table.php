<?php

use App\Enums\HubStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hubs', function (Blueprint $table) {
            $table->ulid('id')->primary()->index();
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->string('status')->default(config('zorum.requires_approval') ? HubStatus::Pending : HubStatus::Active);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hubs');
    }
};
