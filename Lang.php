<?php
namespace libs\php\lang;

/**
 * Works width language data.
 * Helps to organize web-site multilanguage as simple as possible.
 * Class Lang
 * @package libs\php\lang
 * @author Balov Bohdan <balovbohdan@gmail.com>
 * @version 1.0.0
 *
 * @example
 */
class Lang {
    /**
     * Constructor.
     * @param array $params
     * @throws LangException
     */
    function __construct(array $params = array()) {
        $defParams = $this->getDefParams();
        $params = array_merge($defParams, $params);

        $this->lang = $params["lang"] ?: $defParams["lang"];
        $this->root = $params["root"] ?: $defParams["root"];
        $this->data = self::loadLangData($this->root, $this->lang);
    }
    
    /**
     * Bulgarian.
     */
    const BG = "bg";

    /**
     * Czech.
     */
    const CZ = "cz";

    /**
     * Kazakh.
     */
    const KZ = "kz";

    /**
     * Lithuanian.
     */
    const LT = "lt";

    /**
     * Latvian.
     */
    const LV = "lv";

    /**
     * Polish.
     */
    const PL = "pl";

    /**
     * Russian.
     */
    const RU = "ru";

    /**
     * Slovakian.
     */
    const SK = "sk";

    /**
     * Ukrainian.
     */
    const UA = "ua";

    /**
     * English.
     */
    const UK = "uk";

    /**
     * Uzbekistanian.
     */
    const UZ = "uz";

    /**
     * Language code.
     * @var string
     */
    private $lang = "";

    /**
     * Path to the root folder of language files.
     * @var string
     */
    private $root = "";

    /**
     * Language data.
     * @var array
     */
    private $data = array();

    /**
     * Loads language data from file.
     * If language file with given language code does not exist tries
     * to load language data from "UK" language file.
     * @param string $root Path to the root folder of language files.
     * @param string $lang Language code. See constants.
     * @return array Language data.
     * @throws LangException
     */
    private static function loadLangData($root, $lang) {
        if (!$root) throw new LangException("Got incorrect path to the root folder of language files.");
        if (!$lang) throw new LangException("Got incorrect code of language.");
        $path = $root . $lang . ".json";
        if (!file_exists($path)) return self::loadLangData($root, self::UK);
        return json_decode(file_get_contents($path), true) ?: array();
    }

    /**
     * Returns default parameters of instance.
     * @return array
     */
    function getDefParams() {
        // TODO: Here you can define some external sources of language code.
        // For instance you can use $_GET, $_POST, $_SESSION, $_COOKIE sources.
        // So you can write:
        //
        // return array(
        //     "lang" => $_SESSION["langCode"] ?: self::UK,
        //     [...rest_of_default_parameters...]
        // );
        
        return array(
            "lang" => self::UK,
            "root" => DIRECTORY_SEPARATOR . "teach" . DIRECTORY_SEPARATOR . "lang" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR
        );
    }

    /**
     * Returns language data element.
     * @param string $key Key to aim language data element.
     * @return string Language data element.
     * @throws LangException
     */
    function get($key) {
        if (!$key) throw new LangException("Got incorrect key to find language data element.");
        return $this->data[$key];
    }
}
?>
