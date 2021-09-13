<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('access_token')->nullable();
            $table->string('mobile',10)->nullable();
            $table->string('image');
            $table->string('login_type');
            $table->enum('status',['active','inactive'])->default('active');
            $table->string('otp',6)->nullable();
            $table->integer('plan_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('country_code')->nullable();
            $table->string('latitude')->default(0.000000);
            $table->string('longitude')->default(0.000000);
            $table->string('fcm_token')->nullable();
            $table->integer('wallet')->nullable();
            $table->string('google_token')->nullable();
            $table->string('facebook_token')->nullable();
            $table->enum('os_type',['android','ios'])->default('android');
            $table->string('device_token')->nullable();
            $table->string('stripe_payment_account',100)->nullable();
            $table->string('isOnline',10)->nullable();
            $table->string('socketID')->nullable();
            $table->string('lastseen',100)->nullable();
            $table->string('voipToken')->nullable();
            $table->text('token')->nullable();
            $table->integer('age')->nullable();
            $table->string('address')->nullable();
            $table->enum('gender',['male','female','others'])->default('male');
            $table->string('max_distance')->default(20);
            $table->enum('interest',['male','female','others'])->default('female');
            $table->string('age_interest')->nullable();
            $table->enum('is_online',['online','offline'])->default('offline');
            $table->string('distance')->default(0);
            $table->longText('description')->nullable();
            $table->integer('msg_count')->default(0);
            $table->integer('notification_count')->default(0);
            $table->integer('badge_count')->default(0);
            $table->string('profile_view_count')->default(0);
            $table->date('plan_start_date')->nullable();
            $table->date('plan_end_date')->nullable();
            $table->date('plan_cancel_date')->nullable();
            $table->string('card_details_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->tinyInteger('payment_status')->default(0);
            $table->tinyInteger('suspension_status')->default(0);
            $table->tinyInteger('is_avatar')->comment('1 = (google,facebook), 0 = profile')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
