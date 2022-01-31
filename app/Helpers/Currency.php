<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Currency {

    public static function idr($number) {
      $formated_number = "Rp " . number_format($number,0,',','.');
      return $formated_number;
    }

}
