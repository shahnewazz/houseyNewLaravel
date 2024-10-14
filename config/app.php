<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | the application so that it's available within Artisan commands.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),


    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is utilized by Laravel's encryption services and should be set
    | to a random, 32 character string to ensure that all encrypted values
    | are secure. You should do this prior to deploying the application.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

    'languages' => [
        "ab" => "Abkhazian",
        "aa" => "Afar",
        "af" => "Afrikaans",
        "ak" => "Akan",
        "sq" => "Albanian",
        "am" => "Amharic",
        "ar" => "Arabic",
        "an" => "Aragonese",
        "hy" => "Armenian",
        "as" => "Assamese",
        "av" => "Avaric",
        "ae" => "Avestan",
        "ay" => "Aymara",
        "az" => "Azerbaijani",
        "bm" => "Bambara",
        "ba" => "Bashkir",
        "eu" => "Basque",
        "be" => "Belarusian",
        "bn" => "Bengali",
        "bh" => "Bihari",
        "bi" => "Bislama",
        "bs" => "Bosnian",
        "br" => "Breton",
        "bg" => "Bulgarian",
        "my" => "Burmese",
        "ca" => "Catalan",
        "ch" => "Chamorro",
        "ce" => "Chechen",
        "ny" => "Chichewa, Chewa, Nyanja",
        "zh" => "Chinese",
        "zh-Hans" => "Chinese (Simplified)",
        "zh-Hant" => "Chinese (Traditional)",
        "cv" => "Chuvash",
        "kw" => "Cornish",
        "co" => "Corsican",
        "cr" => "Cree",
        "hr" => "Croatian",
        "cs" => "Czech",
        "da" => "Danish",
        "dv" => "Divehi, Dhivehi, Maldivian",
        "nl" => "Dutch",
        "dz" => "Dzongkha",
        "en" => "English",
        "eo" => "Esperanto",
        "et" => "Estonian",
        "ee" => "Ewe",
        "fo" => "Faroese",
        "fj" => "Fijian",
        "fi" => "Finnish",
        "fr" => "French",
        "ff" => "Fula, Fulah, Pulaar, Pular",
        "gl" => "Galician",
        "gd" => "Gaelic (Scottish)",
        "gv" => "Gaelic (Manx)",
        "ka" => "Georgian",
        "de" => "German",
        "el" => "Greek",
        "kl" => "Greenlandic",
        "gn" => "Guarani",
        "gu" => "Gujarati",
        "ht" => "Haitian Creole",
        "ha" => "Hausa",
        "he" => "Hebrew",
        "hz" => "Herero",
        "hi" => "Hindi",
        "ho" => "Hiri Motu",
        "hu" => "Hungarian",
        "is" => "Icelandic",
        "io" => "Ido",
        "ig" => "Igbo",
        "id" => "Indonesian",
        "ia" => "Interlingua",
        "ie" => "Interlingue",
        "iu" => "Inuktitut",
        "ik" => "Inupiak",
        "ga" => "Irish",
        "it" => "Italian",
        "ja" => "Japanese",
        "jv" => "Javanese",
        "kn" => "Kannada",
        "kr" => "Kanuri",
        "ks" => "Kashmiri",
        "kk" => "Kazakh",
        "km" => "Khmer",
        "ki" => "Kikuyu",
        "rw" => "Kinyarwanda (Rwanda)",
        "rn" => "Kirundi",
        "ky" => "Kyrgyz",
        "kv" => "Komi",
        "kg" => "Kongo",
        "ko" => "Korean",
        "ku" => "Kurdish",
        "kj" => "Kwanyama",
        "lo" => "Lao",
        "la" => "Latin",
        "lv" => "Latvian (Lettish)",
        "li" => "Limburgish (Limburger)",
        "ln" => "Lingala",
        "lt" => "Lithuanian",
        "lu" => "Luga-Katanga",
        "lg" => "Luganda, Ganda",
        "lb" => "Luxembourgish",
        "mk" => "Macedonian",
        "mg" => "Malagasy",
        "ms" => "Malay",
        "ml" => "Malayalam",
        "mt" => "Maltese",
        "mi" => "Maori",
        "mr" => "Marathi",
        "mh" => "Marshallese",
        "mo" => "Moldavian",
        "mn" => "Mongolian",
        "na" => "Nauru",
        "nv" => "Navajo",
        "ng" => "Ndonga",
        "nd" => "Northern Ndebele",
        "ne" => "Nepali",
        "no" => "Norwegian",
        "nb" => "Norwegian bokmål",
        "nn" => "Norwegian nynorsk",
        "ii" => "Nuosu",
        "oc" => "Occitan",
        "oj" => "Ojibwe",
        "cu" => "Old Church Slavonic, Old Bulgarian",
        "or" => "Oriya",
        "om" => "Oromo (Afaan Oromo)",
        "os" => "Ossetian",
        "pi" => "Pāli",
        "ps" => "Pashto, Pushto",
        "fa" => "Persian (Farsi)",
        "pl" => "Polish",
        "pt" => "Portuguese",
        "pa" => "Punjabi (Eastern)",
        "qu" => "Quechua",
        "rm" => "Romansh",
        "ro" => "Romanian",
        "ru" => "Russian",
        "se" => "Sami",
        "sm" => "Samoan",
        "sg" => "Sango",
        "sa" => "Sanskrit",
        "sr" => "Serbian",
        "sh" => "Serbo-Croatian",
        "st" => "Sesotho",
        "tn" => "Setswana",
        "sn" => "Shona",
        "sd" => "Sindhi",
        "si" => "Sinhalese",
        "ss" => "Siswati",
        "sk" => "Slovak",
        "sl" => "Slovenian",
        "so" => "Somali",
        "nr" => "Southern Ndebele",
        "es" => "Spanish",
        "su" => "Sundanese",
        "sw" => "Swahili (Kiswahili)",
        "sv" => "Swedish",
        "tl" => "Tagalog",
        "ty" => "Tahitian",
        "tg" => "Tajik",
        "ta" => "Tamil",
        "tt" => "Tatar",
        "te" => "Telugu",
        "th" => "Thai",
        "bo" => "Tibetan",
        "ti" => "Tigrinya",
        "to" => "Tonga",
        "ts" => "Tsonga",
        "tr" => "Turkish",
        "tk" => "Turkmen",
        "tw" => "Twi",
        "ug" => "Uyghur",
        "uk" => "Ukrainian",
        "ur" => "Urdu",
        "uz" => "Uzbek",
        "ve" => "Venda",
        "vi" => "Vietnamese",
        "vo" => "Volapük",
        "wa" => "Wallon",
        "cy" => "Welsh",
        "wo" => "Wolof",
        "fy" => "Western Frisian",
        "xh" => "Xhosa",
        "yi" => "Yiddish",
        "yo" => "Yoruba",
        "za" => "Zhuang, Chuang",
        "zu" => "Zulu"
    ],  
    'date_formats' => [
        'Y-m-d' => 'YYYY-MM-DD (' . Carbon::now()->format('Y-m-d') . ')',
        'd/m/Y' => 'DD/MM/YYYY (' . Carbon::now()->format('d/m/Y') . ')',
        'm-d-Y' => 'MM-DD-YYYY (' . Carbon::now()->format('m-d-Y') . ')',
        'M d, Y' => 'Month Day, Year (' . Carbon::now()->format('M d, Y') . ')',
        'D, M d Y' => 'Day, Month Day Year (' . Carbon::now()->format('D, M d Y') . ')',
        'F j, Y' => 'Full Month Name, Day, Year (' . Carbon::now()->format('F j, Y') . ')',
        'Y/m/d' => 'YYYY/MM/DD (' . Carbon::now()->format('Y/m/d') . ')',
        'd M, Y' => 'Day Month, Year (' . Carbon::now()->format('d M, Y') . ')',
        'l, F j, Y' => 'Weekday, Full Month Day, Year (' . Carbon::now()->format('l, F j, Y') . ')',
        'jS F Y' => 'Day Ordinal Full Month Year (' . Carbon::now()->format('jS F Y') . ')',
        'd.m.Y' => 'DD.MM.YYYY (' . Carbon::now()->format('d.m.Y') . ')',
        'Ymd' => 'YYYYMMDD (' . Carbon::now()->format('Ymd') . ')',
    ]
];
