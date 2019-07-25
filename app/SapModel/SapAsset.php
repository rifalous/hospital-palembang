<?php

namespace App\SapModel;

use Illuminate\Database\Eloquent\Model;

class SapAsset extends Model
{
    protected $fillable = [
        'asset_type',
        'asset_code',
        'asset_name'
       
    ];

    public static function getAutoAssetCode($asset_code, $asset_kind='O', $budget_no='') {

        if ($asset_kind == 'O') {
            // One Time
            // $result = Approval_detail::getNewAssetNumber($asset_code);
            $result = SapNumber::getNewAssetNumber($asset_code);
        }
        elseif ($asset_kind == 'C') {
            // CIP
            $result = SapNumber::getNewAssetNumberWithCIP($budget_no);
        }
        return $result;
    }
}
