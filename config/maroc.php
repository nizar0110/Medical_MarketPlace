<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Configuration Maroc
    |--------------------------------------------------------------------------
    |
    | Paramètres spécifiques au contexte marocain
    |
    */

    'company' => [
        'name' => 'Medical Market SARL',
        'legal_form' => 'SARL',
        'rc' => '123456', // Registre de Commerce
        'ice' => '123456789', // Identifiant Commerce Entreprise
        'cnss' => '123456789', // Caisse Nationale de Sécurité Sociale
        'patente' => '123456789', // Numéro de patente
        'address' => [
            'street' => '123 Rue de la Santé',
            'district' => 'Quartier Maarif',
            'city' => 'Casablanca',
            'postal_code' => '20000',
            'country' => 'Maroc',
        ],
        'contact' => [
            'phone' => '+212 6 12 345 678',
            'fax' => '+212 5 22 34 56 78',
            'email' => 'contact@medicalmarket.ma',
            'website' => 'www.medicalmarket.ma',
        ],
    ],

    'fiscal' => [
        'tva_rate' => 20.0, // Taux de TVA marocain
        'currency' => 'MAD', // Dirham marocain
        'currency_symbol' => 'DH',
        'fiscal_year_start' => '01-01',
        'payment_terms' => [
            'default' => 30, // jours
            'options' => [0, 15, 30, 45, 60, 90],
        ],
        'tax_registration' => [
            'tva_number' => 'MA123456789', // Numéro de TVA marocain
            'tax_office' => 'Direction Régionale des Impôts de Casablanca',
        ],
    ],

    'business_hours' => [
        'monday' => ['08:00', '18:00'],
        'tuesday' => ['08:00', '18:00'],
        'wednesday' => ['08:00', '18:00'],
        'thursday' => ['08:00', '18:00'],
        'friday' => ['08:00', '18:00'],
        'saturday' => ['09:00', '16:00'],
        'sunday' => 'closed',
        'timezone' => 'Africa/Casablanca',
    ],

    'localization' => [
        'language' => 'fr', // Français (langue officielle)
        'date_format' => 'd/m/Y',
        'time_format' => 'H:i',
        'decimal_separator' => ',',
        'thousands_separator' => ' ',
        'decimal_places' => 2,
    ],

    'regions' => [
        'casablanca_settat' => [
            'name' => 'Casablanca-Settat',
            'cities' => ['Casablanca', 'Mohammedia', 'El Jadida', 'Settat'],
        ],
        'rabat_sale_kenitra' => [
            'name' => 'Rabat-Salé-Kénitra',
            'cities' => ['Rabat', 'Salé', 'Kénitra', 'Témara'],
        ],
        'marrakech_safi' => [
            'name' => 'Marrakech-Safi',
            'cities' => ['Marrakech', 'Safi', 'Essaouira', 'El Kelaa des Sraghna'],
        ],
        'fes_meknes' => [
            'name' => 'Fès-Meknès',
            'cities' => ['Fès', 'Meknès', 'Ifrane', 'Taza'],
        ],
        'tanger_tetouan_al_hoceima' => [
            'name' => 'Tanger-Tétouan-Al Hoceïma',
            'cities' => ['Tanger', 'Tétouan', 'Al Hoceïma', 'Larache'],
        ],
    ],

    'banking' => [
        'banks' => [
            'BMCE' => 'Banque Marocaine du Commerce Extérieur',
            'BMCI' => 'Banque Marocaine pour le Commerce et l\'Industrie',
            'SGMB' => 'Société Générale Marocaine de Banques',
            'CFG' => 'Crédit du Maroc',
            'Attijariwafa Bank' => 'Attijariwafa Bank',
        ],
        'iban_format' => 'MA',
        'swift_format' => 'BIC',
    ],
];
