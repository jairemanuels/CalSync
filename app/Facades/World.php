<?php

namespace App\Facades;

use ResourceBundle;
use Illuminate\Support\Facades\Cache;

class World
{
    public static function countries($locale = 'en'): array
    {
        return Cache::remember('world.countries', 3600000, function () use ($locale) {
            $countries = ResourceBundle::create($locale, 'ICUDATA-region')->get('Countries');

            $countryList = [];
            foreach ($countries as $key => $country) {
                if($key === 'ZZ' OR is_numeric($key)) {
                    continue;
                }

                $countryList[$key] = $country;
            }

            return $countryList;
        });
    }

    public static function languages($locale = 'en'): array
    {
        return Cache::remember('world.languages', 3600000, function () use ($locale) {
            $languages = ResourceBundle::create($locale, 'ICUDATA-lang')->get('Languages');

            $languageList = [];
            foreach ($languages as $key => $language) {
                if($key === 'root' OR is_numeric($key)) {
                    continue;
                }

                $languageList[$key] = $language;
            }

            return $languageList;
        });
    }

    public static function timezones(): array
    {
        return Cache::remember('world.timezones', 3600000, function () {
            return \DateTimeZone::listIdentifiers();
        });
    }

    public static function currencies($locale = 'en'): array
    {
        return [];
    }
}
