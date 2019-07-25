<?php

namespace App\SapModel;

use Illuminate\Database\Eloquent\Model;

class SapNumber extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
	protected $fillable = ['*'];

	public static function getNewAssetNumberWithCIP($budget_no)
    {
        $detail = Approval_detail::where('cip_no', 'like', $budget_no.'-%')
                    ->orderBy('cip_no', 'asc')
                    ->first();

        if ($detail) {
            return $detail->asset_no;
        }
        else {
            return '';
        }
    }

    public static function getNewAssetNumber($asset_code)
    {
        $i = 0;

        $asset_no_prefix = $asset_code.'JE';

        // get current number from sap numbers
        if ( !is_null($last = self::where('number_type', $asset_code)->take(1)->first()) ) {

            $i = $last->number_current;
        }

        $i++;
        $i = str_pad($i, 3, 0, STR_PAD_LEFT);

        // double cek apakah equipment no ini sudah dipakai
        while (($i <= 999) && ( self::where('number_booked', $asset_no_prefix.$i)->first() )) {
        	$i++;
	        $i = str_pad($i, 3, 0, STR_PAD_LEFT);
        }

        return $asset_no_prefix.$i;
    }

    public static function postBookAssetNumber($asset_code)
    {
        $sap_number = new self;

        $sap_number->number_type = substr($asset_code, 0, 2);
        $sap_number->number_booked = $asset_code;
        $sap_number->number_current = intval(substr($asset_code, -3));
        $sap_number->save();

        return $sap_number;
    }

    public static function postCurrentAssetNumber($asset_code)
    {
        $result = self::where('number_type', substr($asset_code, 0, 2))
                                ->update(['number_current' => intval(substr($asset_code, -3))]);

        return $result;
    }
}
