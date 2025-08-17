<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Code to be executed after the plugin's database scheme has been installed is defined here.
 *
 * @package     block_analyticswidget
 * @category    upgrade
 * @copyright   2022 Chandra K <developerck@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_analyticswidget;

defined('MOODLE_INTERNAL') || die();

/**
 * Main cache class
 *
 */
class cache{

    public static function set_cache( $cachekey, $data){
        $cc_cache = \cache::make('block_analyticswidget', 'awstat');
        $val = new \stdClass();
        $val->t = time();
        $val->d =  $data;
        $cc_cache->set($cachekey, serialize($val));
        return true;
    }

    public static function get_cache($cachekey){
        $cc_cache = \cache::make('block_analyticswidget', 'awstat');
        $val = $cc_cache->get($cachekey);
        $cache_valid = false;
        if(!empty($val)){
            $val = unserialize($val);
            if( (time() - $val->t ) < 36000){
                return $val->d;
            }
        }
        return false;
    }
}
