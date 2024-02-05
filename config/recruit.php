<?php

return [
    /*
     * Currency Field Format Value
     */
    'currency_field' => 'PHP',
    /*
     *  Career Apply page for Captcha
     */
    'enable_captcha' => true,
    'captcha_provider' => [
        // Applicable value will be the provider name from the "Captcha Provider"
        'default' => 'Recruit_Captcha',
        'Google' => [
            'provider_name' => 'Google',
        ],
        'Cloudflare' => [
            'provider_name' => 'Cloudflare',
        ],
        'Recruit_Captcha' => [
            'provider_name' => 'Basic',
        ],
    ],

    'captcha_provider_name' => 'Cloudflare',
    /*
     * Job Opening Module Field setup and options
     */
    'job_opening' => [
        'required_skill_options' => [
            'management' => 'Management',
        ],
        'job_type_options' => [
            'Full Time' => 'Full Time',
            'Part Time' => 'Part Time',
            'Freelance' => 'Freelance',
            'Temporary' => 'Temporary',
            'Contract' => 'Contract',
            'Permanent' => 'Permanent',
            'Volunteer' => 'Volunteer',
        ],
        'work_experience' => [
            'refresher' => 'Refresher',
            '0_1year' => '0-1 year',
            '1_3years' => '1-3 years',
            '4_5years' => '4-5 years',
            '5+years' => '5+ years',
        ],
    ],
];
