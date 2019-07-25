<?php
namespace App;
use App\ApproverUser;

trait Helpers
{
		public static function can($approval_master)
		{
			
			$user = auth()->user();

			if($user->id)
			{
				$can = ApproverUser::where('approval_master_id',$approval_master->id)
									->where('user_id',$user->id)->first();
				if($can)
				{
					return true;
				}
			}
			
			return false;
		}
}

?>