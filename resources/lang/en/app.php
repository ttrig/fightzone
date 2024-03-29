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
        'history'  => 'Our history',
        'facility' => 'The facility',
        'partners' => 'Partners and Friends',
        'contact'  => 'Contact',
        'lang'     => 'Svenska',
    ],

    # activities (also used in navbar)
    'activity' => [
        'bjj' => 'Brazilian Jiu-jitsu',
        'boxing' => 'Boxing',
        'kickboxing' => 'Thai/Kickboxing',
        'nogi' => 'Submission wrestling',
        'sac' => 'Strength and conditioning',
        'gym' => 'Gym',
        'youth_boxing' => 'Youth boxing',
        'youth_kickboxing' => 'Youth kickboxing',
        'kids_bjj' => 'Kids BJJ',
        'youth_bjj' => 'Youth BJJ',
        'armwrestling' => 'Armwrestling',
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
        'payment_button' => 'Pay here',
    ],

    # page: payment
    'payment' => [
        'index' => [
            'title' => 'Pay',
            'no_articles' => 'There are no items available right now.',
            'name' => 'Name',
            'price' => 'Price',
            'from_price' => 'Part payment/month',
        ],
        'checkout' => [
            'title' => 'Checkout',
            'your_order' => 'Your order',
            'name' => 'Name',
            'price' => 'Price',
            'description' => 'Description',
            'back' => 'Back',
            'not_loaded' => 'Checkout could not be loaded, try again later.',
        ],
        'success' => [
            'text' => 'Thank you for purchase and welcome to Fightzone Malmö',
        ],
        'failed' => [
            'text' => 'Something went wrong, try again.',
        ],
        'cancelled' => [
            'text' => 'Payment was cancelled.',
        ],
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

    # page: youth-bjj
    'youth_bjj' => [
        'title' => 'Youth BJJ',
        'modal_schedule_show' => 'Show schedule',
        'modal_schedule_title' => 'Youth schedule',
        'more' => 'More about BJJ',
    ],

    # page: kids-bjj
    'kids_bjj' => [
        'title' => 'Kids BJJ',
        'modal_schedule_show' => 'Show schedule',
        'modal_schedule_title' => 'Kids schedule',
        'more' => 'More about BJJ',
    ],

    # page: youth-boxing
    'youth_boxing' => [
        'title' => 'Youth boxing',
        'more' => 'More about boxing',
    ],

    # page: youth-kickboxing
    'youth_kickboxing' => [
        'title' => 'Youth kickboxing',
        'more' => 'More about kickboxing',
    ],

    # page: history
    'history' => [
        'title' => 'Our history',
    ],

    # page: facility
    'facility' => [
        'title' => 'The facility',
    ],

    # page: partners
    'partners' => [
        'partners' => 'Partners',
        'friends' => 'Friends',
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
    'back' => 'Back',
    'close' => 'Close',
    'sponsors' => 'sponsors',

];
