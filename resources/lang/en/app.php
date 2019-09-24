<?php

/**
 * @see   If a translation is not in its own "page" category (i.e. "home")
 *        then it its probably used on multiple locations!
 */

return [

    # navbar titles
    'nav' => [
        'home'     => 'Home',
        'schedule' => 'Schedule',
        'prices'   => 'Prices',
        'join'     => 'Join',
        'training' => 'Training',
        'about'    => 'About',
        'contact'  => 'Contact',
        'lang'     => 'Svenska',
    ],

    # activities (also used in navbar)
    'activity' => [
        'bjj' => 'Brazilian Jiu-jitsu',
        'boxing' => 'Boxing',
        'kickboxing' => 'Thai/Kickboxing',
        'wrestling' => 'Freestyle wrestling',
        'nogi' => 'Submission wrestling',
        'sac' => 'Strength and conditioning',
        'gym' => 'Gym',
        'kids_boxing' => 'Kids boxing',
        'kids_bjj' => 'Kids BJJ',
    ],

    # instructors
    'instructors' => 'Instructors',
    'instructor'  => 'Instructor',
    'kid_instructor' => 'Kids instructor',

    # bjj
    '1st'        => '1st',
    '2nd'        => '2nd',
    '3rd'        => '3rd',
    'black_belt' => '{0} black belt|[1,*] :degree degree black belt',

    # page: home
    'home' => [
        'more'     => 'Learn more',
        'more_about_fightzone' => 'Learn more about Fightzone',
        'register' => 'Sign up',
        'previous' => 'Previous',
        'next'     => 'Next',
        'welcome'  => 'Welcome to Fightzone',
        'welcome2' => 'in Malm&ouml;',
        'schedule' => [
            'title'        => 'Todays schedule',
            'link'         => 'View the entire schedule',
            'no_training'  => 'No training today.',
        ],
    ],

    # page: prices
    'prices' => [
        'title'  => 'Prices',
        'adults' => 'Adults',
        'youths' => 'Youths',
        'year'   => 'year',
        'months' => '1 month|:count months',
        'bjj'    => 'BJJ and Combo',
    ],

    # page: schedule
    'schedule' => [
        'title' => 'Schedule',
        'all_activities' => 'Show all activites',
        # ISO 8601
        'day' => [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday',
        ],
        'no_classes' => 'No scheduled classes right now.',
    ],

    # page: kids-bjj
    'kids_bjj' => [
        'title' => 'Kids BJJ',
        'modal_schedule_show' => 'Show schedule',
        'modal_schedule_title' => 'Kids schedule',
        'more' => 'More about BJJ',
    ],

    # page: kids-boxing
    'kids_boxing' => [
        'title' => 'Kids boxing',
        'more' => 'More about boxing',
    ],

    # page: about
    'about' => [
        'title' => 'About Fightzone',
        'facility' => 'Facility',
    ],

    # page: contact
    'contact' => [
        'title' => 'Contact',
        'text' => 'E-mail us at :email or send a message on :facebook',
    ],

    # page: join
    'join' => [
        'title' => 'Join us',
        'text'  => 'A year from now you will have wished you started today.',

        # header buttons (also used by discipline headers)
        'schedule' => 'Schedule',
        'prices'   => 'Prices',
        'join'     => 'Join',
    ],

    # random
    'close' => 'Close',
    'sponsors' => 'sponsors',

];
