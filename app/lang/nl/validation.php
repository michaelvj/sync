<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    "accepted"       => "<b>:attribute</b> moet geaccepteerd zijn.",
    "active_url"     => "<b>:attribute</b> is geen geldige URL.",
    "after"          => "<b>:attribute</b> moet een datum na <b>:date</b> zijn.",
    "alpha"          => "<b>:attribute</b> mag alleen letters bevatten.",
    "alpha_dash"     => "<b>:attribute</b> mag alleen letters, nummers, onderstreep(_) en strepen(-) bevatten.",
    "alpha_num"      => "<b>:attribute</b> mag alleen letters en nummers bevatten.",
    "array"          => "<b>:attribute</b> moet geselecteerde elementen bevatten.",
    "before"         => "<b>:attribute</b> moet een datum voor <b>:date</b> zijn.",
    "between"        => array(
        "numeric" => "<b>:attribute</b> moet tussen :min en :max zijn.",
        "file"    => "<b>:attribute</b> moet tussen :min en :max kilobytes zijn.",
        "string"  => "<b>:attribute</b> moet tussen :min en :max karakters zijn.",
        "array"   => "<b>:attribute</b> moet tussen :min en :max items bevatten."
    ),
    "confirmed"      => "<b>:attribute</b> bevestiging komt niet overeen.",
    "count"          => "<b>:attribute</b> moet precies :count geselecteerde elementen bevatten.",
    "countbetween"   => "<b>:attribute</b> moet tussen :min en :max geselecteerde elementen bevatten.",
    "countmax"       => "<b>:attribute</b> moet minder dan :max geselecteerde elementen bevatten.",
    "countmin"       => "<b>:attribute</b> moet minimaal :min geselecteerde elementen bevatten.",
    "date_format"    => "<b>:attribute</b> moet een geldig datum formaat bevatten.",
    "different"      => "<b>:attribute</b> en <b>:other</b> moeten verschillend zijn.",
    "email"          => "<b>:attribute</b> is geen geldig e-mailadres.",
    "exists"         => "<b>:attribute</b> bestaat niet.",
    "image"          => "<b>:attribute</b> moet een afbeelding zijn.",
    "in"             => "<b>:attribute</b> is ongeldig.",
    "integer"        => "<b>:attribute</b> moet een getal zijn.",
    "ip"             => "<b>:attribute</b> moet een geldig IP-adres zijn.",
    "match"          => "Het formaat van <b>:attribute</b> is ongeldig.",
    "max"            => array(
        "numeric" => "<b>:attribute</b> moet minder dan :max zijn.",
        "file"    => "<b>:attribute</b> moet minder dan :max kilobytes zijn.",
        "string"  => "<b>:attribute</b> moet minder dan :max karakters zijn.",
        "array"   => "<b>:attribute</b> mag maximaal :max items bevatten."
    ),
    "mimes"          => "<b>:attribute</b> moet een bestand zijn van het bestandstype :values.",
    "min"            => array(
        "numeric" => "<b>:attribute</b> moet minimaal :min zijn.",
        "file"    => "<b>:attribute</b> moet minimaal :min kilobytes zijn.",
        "string"  => "<b>:attribute</b> moet minimaal :min karakters zijn.",
        "array"   => "<b>:attribute</b> moet minimaal :min items bevatten."
    ),
    "not_in"         => "Het formaat van <b>:attribute</b> is ongeldig.",
    "numeric"        => "<b>:attribute</b> moet een nummer zijn.",
    "required"       => "<b>:attribute</b> is verplicht.",
    "required_with"  => "<b>:attribute</b> is verplicht i.c.m. :values",
    "required_with_all" => "<b>:attribute</b> is verplicht i.c.m. :values",
    "required_without"     => "<b>:attribute</b> is verplicht als :values niet ingevuld is.",
    "required_without_all" => "<b>:attribute</b> is verplicht als :values niet ingevuld zijn.",
    "same"           => "<b>:attribute</b> en <b>:other</b> moeten overeenkomen.",
    "size"           => array(
        "numeric" => "<b>:attribute</b> moet :size zijn.",
        "file"    => "<b>:attribute</b> moet :size kilobyte zijn.",
        "string"  => "<b>:attribute</b> moet :size characters zijn.",
        "array"   => "<b>:attribute</b> moet :size items bevatten."
    ),
    "unique"         => "<b>:attribute</b> is al in gebruik.",
    "url"            => "<b>:attribute</b> is geen geldige URL.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => array(
        'attribute-name' => array(
            'rule-name' => 'custom-message',
        ),
    ),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => array(
        'featured_image' => 'Afbeelding',
        'shows_at' => 'zichtbaar vanaf',
        'expires_at' => 'geldig tot',
        'begins_at' => 'begint op',
        'ends_at' => 'eindigt op'
    ),

);