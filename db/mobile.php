<?php

defined('MOODLE_INTERNAL') || die();

$addons = [
    'block_analyticswidget' => [
        'handlers' => [
            'analyticswidget' => [
                'displaydata' => [
                    'icon' => $CFG->wwwroot . '/blocks/analyticswidget/pix/icon.png',
                    'class' => '',
                    'type' => 'template',
                ],

                'delegate' => 'CoreBlockDelegate',
                'method' => 'mobile_view',
            ],
        ],
        'lang' => [ // Language strings that are used in all the handlers.
            ['pluginname', 'block_analyticswidget'],
            ['site_level', 'block_analyticswidget'],
            ['teacher_level', 'block_analyticswidget'],
            ['my_level', 'block_analyticswidget'],
            ['as_student', 'block_analyticswidget'],
            ['my_no_course', 'block_analyticswidget'],
            
            
        ],
    ],
];