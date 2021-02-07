<?php

    function getCurrentLocale()
    {
        $request = request();
        $lang = $request->route('lang');
        $local = collect(['ru', 'ua']);

        $filterLangs = $local->filter(function ($value) use($lang) {

            return $value == $lang;
        });

        $filterLang = '';

        foreach ($filterLangs as $item)
        {
            $filterLang = $item;
        }

        if($filterLang == $lang) {
            $result = $lang;
        } else {
            $result = 'ua';
        }

        return $result;
    }
