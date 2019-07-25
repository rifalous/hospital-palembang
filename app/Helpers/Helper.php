<?php

namespace App\Helpers;
use App\Role;
use App\Permission;

class Helper
{
    public static function bytesToHuman($bytes)
    {
        $units = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

	public static function createSlug($title, $type, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = Helper::getRelatedSlugs($slug, $type, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected static function getRelatedSlugs($slug, $type, $id = 0)
    {
        if ($type == 'role') {
            return Role::select('name')->where('name', 'like', $slug.'%')
                ->where('id', '<>', $id)
                ->get();
        }

        if ($type == 'permission') {
            return Permission::select('name')->where('name', 'like', $slug.'%')
                ->where('id', '<>', $id)
                ->get();
        }      
    
    }

    public static function countLevel($level)
    {
        $units = ['Bronze', 'Silver', 'Gold', 'Platinum', 'Diamond', 'Ruby'];

        for ($i = 0; $level > 1000000; $i++) {
            $level /= 1000000;
        }

        $result['level'] = round($level);
        $result['point'] = $units[$i];

        return collect($result);
        
    }

}