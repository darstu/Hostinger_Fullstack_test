<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_name');
            $table->string('gift_item');
            $table->string('gift_item_count');
            $table->enum('status', ['preparing', 'ready', 'dispatched']);
            $table->date('dispatch_date');
            $table->date('delivery_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_campaigns');
    }
}
