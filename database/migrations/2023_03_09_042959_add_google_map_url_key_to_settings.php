<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Setting::create([
            'key'   => 'location_embedded_code',
            'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5289.052266745587!2d72.87566563910816!3d21.23848312240396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f48b6c140a3%3A0x6aae5a9a1643f6f!2sInfyOm%20Technologies!5e0!3m2!1sen!2sin!4v1678190425396!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Setting::where('key', 'location_embedded_code')->delete();
    }
};
