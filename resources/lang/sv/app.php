<?php

/**
 * @see   If a translation is not in its own "page" category (i.e. "home")
 *        then it its probably used on multiple locations!
 */

return [

    # navbar titles
    'nav' => [
        'home'     => 'Hem',
        'schedule' => 'Schema',
        'prices'   => 'Priser',
        'join'     => 'Börja träna',
        'training' => 'Träning',
        'about'    => 'Om Fightzone',
        'contact'  => 'Kontakt',
        'lang'     => 'English',
    ],

    # activities (also used in navbar)
    'activity' => [
        'bjj' => 'Brasiliansk Jiu-jitsu',
        'boxing' => 'Boxning',
        'kickboxing' => 'Thai/Kickboxning',
        'wrestling' => 'Fristilsbrottning',
        'nogi' => 'Submission wrestling',
        'sac' => 'Styrka och kondition',
        'gym' => 'Gym',
        'kids_boxing' => 'Barnboxning',
        'kids_bjj' => 'Barn BJJ',
    ],

    # instructors
    'instructors' => 'Instruktörer',
    'instructor'  => 'Instruktör',
    'kid_instructor' => 'Barntränare',

    # bjj
    '1st'        => '1a',
    '2nd'        => '2a',
    '3rd'        => '3e',
    'black_belt' => '{0} svart bälte|[1,*] :degree graden svart bälte',

    # page: home
    'home' => [
        'more'     => 'Läs mer',
        'more_about_fightzone' => 'Läs mer om Fightzone',
        'register' => 'Bli medlem',
        'previous' => 'Förgående',
        'next'     => 'Nästa',
        'welcome'  => 'Välkommen till Fightzone',
        'welcome2' => 'i Malmö',
        'schedule' => [
            'title'        => 'Dagens schema',
            'link'         => 'Visa hela schemat',
            'no_training'  => 'Ingen träning idag.',
        ],
    ],

    # page: prices
    'prices' => [
        'title'  => 'Priser',
        'adults' => 'Vuxna',
        'youths' => 'Ungdomar',
        'year'   => 'år',
        'months' => '1 månad|:count månader',
        'bjj'    => 'BJJ och Combo',
    ],

    # page: schedule
    'schedule' => [
        'title' => 'Schema',
        'all_activities' => 'Visa alla aktiviteter',
        # ISO 8601
        'day' => [
            1 => 'Måndag',
            2 => 'Tisdag',
            3 => 'Onsdag',
            4 => 'Torsdag',
            5 => 'Fredag',
            6 => 'Lördag',
            7 => 'Söndag',
        ],
        'no_classes' => 'Inga tider just nu.',
    ],

    # page: kids-bjj
    'kids_bjj' => [
        'title' => 'Barn BJJ',
        'modal_schedule_show' => 'Visa schema',
        'modal_schedule_title' => 'Schema barn BJJ',
        'modal_schedule_close' => 'Stäng',
        'more' => 'Läs mer om BJJ',
    ],

    # page: youth-boxing
    'kids_boxing' => [
        'title' => 'Barnboxning',
        'more' => 'Läs mer om boxning',
    ],

    # page: about
    'about' => [
        'title' => 'Om Fightzone',
        'facility' => 'Lokalen',
    ],

    # page: contact
    'contact' => [
        'title' => 'Kontakt',
        'text' => 'Skicka e-mail till :email eller skriv till oss på :facebook',
    ],

    # page: join
    'join' => [
        'title' => 'Börja träna',
        'text'  => 'A year from now you will have wished you started today.',

        # header buttons (also used by discipline headers)
        'schedule' => 'Schema',
        'prices'   => 'Priser',
        'join'     => 'Börja träna',
    ],

    # random
    'close' => 'Stäng',
    'sponsors' => 'sponsorer',

];
