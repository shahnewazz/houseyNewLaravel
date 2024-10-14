<?php

namespace Modules\Core\Enums;

enum SiteSettingEnum
{
    // general settings
    const SITE_EMAIL = 'site_email';
    const SITE_PHONE = 'site_phone';
    const SITE_ADDRESS = 'site_address';
    const SITE_LATITUDE = 'site_latitude';
    const SITE_LONGITUDE = 'site_longitude';
    const SITE_TIMEZONE = 'site_timezone';
    const SITE_DATE_FORMAT = 'site_date_format';


    // business settings
    const DEFAULT_CURRENCY = 'default_currency';
    const DEFAULT_CURRENCY_SYMBOL = 'default_currency_symbol';
    const DEFAULT_CURRENCY_POSITION = 'default_currency_position';
    const DIGIT_AFTER_DECIMAL = 'digit_after_decimal';
    const PAGINATION_LIMIT = 'pagination_limit';


    // site interface
    const SITE_LOGO = 'site_logo';
    const SITE_LOGO_WIDTH = 'site_logo_width';
    const SITE_LOGO_SECONDARY = 'site_logo_secondary';
    const SITE_FAVICON = 'site_favicon';
    const SITE_TITLE = 'site_title';
    const SITE_TAGLINE = 'site_tagline';
    const SITE_DESCRIPTION = 'site_description';
    const SITE_COPYRIGHT = 'site_copyright';

    // site colors
    const SITE_PRIMARY_COLOR = 'site_primary_color';
    const SITE_SECONDARY_COLOR = 'site_secondary_color';
    const SITE_BODY_COLOR = 'site_body_color';
    const SITE_HEADING_COLOR = 'site_heading_color';

    // site preloader
    const SITE_PRELOADER = 'site_preloader';
    const SITE_PRELOADER_OVERLAY = 'site_preloader_overlay';

    const SITE_INTERFACE_MEDIA_DIR = 'interface';
}
