<?php

namespace block_analyticswidget\output;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/lib/blocklib.php');

use block_deft\task;
use block_deft\comment;
use stdClass;

/**
 * Mobile output class for Deft response block
 *
 * @package     block_deft
 * @copyright   2022 Daniel Thies <dethies@gmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mobile {
    /**
     *
     * @return array       HTML, javascript and otherdata
     * @throws \required_capability_exception
     * @throws \coding_exception
     * @throws \require_login_exception
     * @throws \moodle_exception
     */
    //{"appcustomurlscheme":"moodlemobile","appid":"com.moodle.moodlemobile","appisdesktop":"0","appismobile":"1","appiswide":"0","applang":"en-us","appplatform":"browser","appversioncode":"42000","appversionname":"4.2.0","blockid":"20","contextlevel":"user","instanceid":"2","userid":"2"}
    public static function mobile_view($args) {
        global $CFG, $DB, $PAGE;
        if(!get_config('block_analyticswidget', 'mobile_view') ) {
            return [];
        }
        if ($args['contextlevel'] == 'course') {
            $course = get_course($args['instanceid']);
            require_login($course);
        }

        $instance = block_instance_by_id($args['blockid']);
        $widget = new  \block_analyticswidget\widget(0, $mobile=true);
        $renderer = $PAGE->get_renderer('block_analyticswidget');
        $data = (object) $widget->export_for_template($renderer);
        $data->contextlevel = $args['contextlevel'];
        $data->instanceid = $args['instanceid'];
        $html = $renderer->render_from_template('block_analyticswidget/mobile_widget', $data);
        return [
            'templates' => [
                [
                    'id' => 'main',
                    'html' => '<div>'.$html.'</div>',
                ],
            ],
            'javascript' => '',
            'otherdata' => [
                'contextid' => $data->contextid,
                'token' => $data->token,
                'uniqid' => $data->uniqid,
            ] ,
        ];
    }

   
}