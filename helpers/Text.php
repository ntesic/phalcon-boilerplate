<?php
/**
 * Copyright (c) 2016.
 * @author Nikola Tesic (nikolatesic@gmail.com)
 */

/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12/27/2016
 * Time: 8:14 AM
 */

namespace ntesic\boilerplate\Helpers;


class Text extends \Phalcon\Text
{

    /**
     * @var array the rules for converting a word into its plural form.
     * The keys are the regular expressions and the values are the corresponding replacements.
     */
    public static $plurals = [
        '/([nrlm]ese|deer|fish|sheep|measles|ois|pox|media)$/i' => '\1',
        '/^(sea[- ]bass)$/i' => '\1',
        '/(m)ove$/i' => '\1oves',
        '/(f)oot$/i' => '\1eet',
        '/(h)uman$/i' => '\1umans',
        '/(s)tatus$/i' => '\1tatuses',
        '/(s)taff$/i' => '\1taff',
        '/(t)ooth$/i' => '\1eeth',
        '/(quiz)$/i' => '\1zes',
        '/^(ox)$/i' => '\1\2en',
        '/([m|l])ouse$/i' => '\1ice',
        '/(matr|vert|ind)(ix|ex)$/i' => '\1ices',
        '/(x|ch|ss|sh)$/i' => '\1es',
        '/([^aeiouy]|qu)y$/i' => '\1ies',
        '/(hive)$/i' => '\1s',
        '/(?:([^f])fe|([lr])f)$/i' => '\1\2ves',
        '/sis$/i' => 'ses',
        '/([ti])um$/i' => '\1a',
        '/(p)erson$/i' => '\1eople',
        '/(m)an$/i' => '\1en',
        '/(c)hild$/i' => '\1hildren',
        '/(buffal|tomat|potat|ech|her|vet)o$/i' => '\1oes',
        '/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|vir)us$/i' => '\1i',
        '/us$/i' => 'uses',
        '/(alias)$/i' => '\1es',
        '/(ax|cris|test)is$/i' => '\1es',
        '/s$/' => 's',
        '/^$/' => '',
        '/$/' => 's',
    ];
    /**
     * @var array the rules for converting a word into its singular form.
     * The keys are the regular expressions and the values are the corresponding replacements.
     */
    public static $singulars = [
        '/([nrlm]ese|deer|fish|sheep|measles|ois|pox|media|ss)$/i' => '\1',
        '/^(sea[- ]bass)$/i' => '\1',
        '/(s)tatuses$/i' => '\1tatus',
        '/(f)eet$/i' => '\1oot',
        '/(t)eeth$/i' => '\1ooth',
        '/^(.*)(menu)s$/i' => '\1\2',
        '/(quiz)zes$/i' => '\\1',
        '/(matr)ices$/i' => '\1ix',
        '/(vert|ind)ices$/i' => '\1ex',
        '/^(ox)en/i' => '\1',
        '/(alias)(es)*$/i' => '\1',
        '/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|viri?)i$/i' => '\1us',
        '/([ftw]ax)es/i' => '\1',
        '/(cris|ax|test)es$/i' => '\1is',
        '/(shoe|slave)s$/i' => '\1',
        '/(o)es$/i' => '\1',
        '/ouses$/' => 'ouse',
        '/([^a])uses$/' => '\1us',
        '/([m|l])ice$/i' => '\1ouse',
        '/(x|ch|ss|sh)es$/i' => '\1',
        '/(m)ovies$/i' => '\1\2ovie',
        '/(s)eries$/i' => '\1\2eries',
        '/([^aeiouy]|qu)ies$/i' => '\1y',
        '/([lr])ves$/i' => '\1f',
        '/(tive)s$/i' => '\1',
        '/(hive)s$/i' => '\1',
        '/(drive)s$/i' => '\1',
        '/([^fo])ves$/i' => '\1fe',
        '/(^analy)ses$/i' => '\1sis',
        '/(analy|diagno|^ba|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\1\2sis',
        '/([ti])a$/i' => '\1um',
        '/(p)eople$/i' => '\1\2erson',
        '/(m)en$/i' => '\1an',
        '/(c)hildren$/i' => '\1\2hild',
        '/(n)ews$/i' => '\1\2ews',
        '/(n)etherlands$/i' => '\1\2etherlands',
        '/eaus$/' => 'eau',
        '/^(.*us)$/' => '\\1',
        '/s$/i' => '',
    ];
    /**
     * @var array the special rules for converting a word between its plural form and singular form.
     * The keys are the special words in singular form, and the values are the corresponding plural form.
     */
    public static $specials = [
        'atlas' => 'atlases',
        'beef' => 'beefs',
        'brother' => 'brothers',
        'cafe' => 'cafes',
        'child' => 'children',
        'cookie' => 'cookies',
        'corpus' => 'corpuses',
        'cow' => 'cows',
        'curve' => 'curves',
        'foe' => 'foes',
        'ganglion' => 'ganglions',
        'genie' => 'genies',
        'genus' => 'genera',
        'graffito' => 'graffiti',
        'hoof' => 'hoofs',
        'loaf' => 'loaves',
        'man' => 'men',
        'money' => 'monies',
        'mongoose' => 'mongooses',
        'move' => 'moves',
        'mythos' => 'mythoi',
        'niche' => 'niches',
        'numen' => 'numina',
        'occiput' => 'occiputs',
        'octopus' => 'octopuses',
        'opus' => 'opuses',
        'ox' => 'oxen',
        'penis' => 'penises',
        'sex' => 'sexes',
        'soliloquy' => 'soliloquies',
        'testis' => 'testes',
        'trilby' => 'trilbys',
        'turf' => 'turfs',
        'wave' => 'waves',
        'Amoyese' => 'Amoyese',
        'bison' => 'bison',
        'Borghese' => 'Borghese',
        'bream' => 'bream',
        'breeches' => 'breeches',
        'britches' => 'britches',
        'buffalo' => 'buffalo',
        'cantus' => 'cantus',
        'carp' => 'carp',
        'chassis' => 'chassis',
        'clippers' => 'clippers',
        'cod' => 'cod',
        'coitus' => 'coitus',
        'Congoese' => 'Congoese',
        'contretemps' => 'contretemps',
        'corps' => 'corps',
        'debris' => 'debris',
        'diabetes' => 'diabetes',
        'djinn' => 'djinn',
        'eland' => 'eland',
        'elk' => 'elk',
        'equipment' => 'equipment',
        'Faroese' => 'Faroese',
        'flounder' => 'flounder',
        'Foochowese' => 'Foochowese',
        'gallows' => 'gallows',
        'Genevese' => 'Genevese',
        'Genoese' => 'Genoese',
        'Gilbertese' => 'Gilbertese',
        'graffiti' => 'graffiti',
        'headquarters' => 'headquarters',
        'herpes' => 'herpes',
        'hijinks' => 'hijinks',
        'Hottentotese' => 'Hottentotese',
        'information' => 'information',
        'innings' => 'innings',
        'jackanapes' => 'jackanapes',
        'Kiplingese' => 'Kiplingese',
        'Kongoese' => 'Kongoese',
        'Lucchese' => 'Lucchese',
        'mackerel' => 'mackerel',
        'Maltese' => 'Maltese',
        'mews' => 'mews',
        'moose' => 'moose',
        'mumps' => 'mumps',
        'Nankingese' => 'Nankingese',
        'news' => 'news',
        'nexus' => 'nexus',
        'Niasese' => 'Niasese',
        'Pekingese' => 'Pekingese',
        'Piedmontese' => 'Piedmontese',
        'pincers' => 'pincers',
        'Pistoiese' => 'Pistoiese',
        'pliers' => 'pliers',
        'Portuguese' => 'Portuguese',
        'proceedings' => 'proceedings',
        'rabies' => 'rabies',
        'rice' => 'rice',
        'rhinoceros' => 'rhinoceros',
        'salmon' => 'salmon',
        'Sarawakese' => 'Sarawakese',
        'scissors' => 'scissors',
        'series' => 'series',
        'Shavese' => 'Shavese',
        'shears' => 'shears',
        'siemens' => 'siemens',
        'species' => 'species',
        'swine' => 'swine',
        'testes' => 'testes',
        'trousers' => 'trousers',
        'trout' => 'trout',
        'tuna' => 'tuna',
        'Vermontese' => 'Vermontese',
        'Wenchowese' => 'Wenchowese',
        'whiting' => 'whiting',
        'wildebeest' => 'wildebeest',
        'Yengeese' => 'Yengeese',
    ];

    /**
     * Converts a CamelCase name into space-separated words.
     * For example, 'PostTag' will be converted to 'Post Tag'.
     * @param string $name the string to be converted
     * @param boolean $ucwords whether to capitalize the first letter in each word
     * @return string the resulting words
     */
    public static function camel2words($name, $ucwords = true)
    {
        $label = trim(strtolower(str_replace([
            '-',
            '_',
            '.',
        ], ' ', preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $name))));

        return $ucwords ? ucwords($label) : $label;
    }

    /**
     * Converts a word to its plural form.
     * Note that this is for English only!
     * For example, 'apple' will become 'apples', and 'child' will become 'children'.
     * @param string $word the word to be pluralized
     * @return string the pluralized word
     */
    public static function pluralize($word)
    {
        if (isset(static::$specials[$word])) {
            return static::$specials[$word];
        }
        foreach (static::$plurals as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                return preg_replace($rule, $replacement, $word);
            }
        }

        return $word;
    }

    /**
     * Returns the singular of the $word
     * @param string $word the english word to singularize
     * @return string Singular noun.
     */
    public static function singularize($word)
    {
        $result = array_search($word, static::$specials, true);
        if ($result !== false) {
            return $result;
        }
        foreach (static::$singulars as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                return preg_replace($rule, $replacement, $word);
            }
        }

        return $word;
    }

    public static function asSize($bytes, $precision = 2) {
        $base = log($bytes, 1024);
        $suffixes = array('', 'K', 'M', 'G', 'T');

        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }
}