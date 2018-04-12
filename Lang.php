<?php
namespace libs\balov\php\lang;

/**
 * Language data of the platform.
 * Class Lang
 * @package libs\balov\php\lang
 */
class Lang {
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
     * Code of labguage.
     * @var string
     */
    private $lang = "";

    /**
     * Path to the root of language files.
     * @var string
     */
    private $root = "";

    /**
     * Language data.
     * @var array
     */
    private $data = array();

    /**
     * Lang constructor.
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
     * Loads language data from file.
     * @param string $root Path to the root of language files.
     * @param string $lang Code of language.
     * @return array
     * @throws LangException
     */
    private static function loadLangData($root, $lang) {
        if (!$root) throw new LangException("Got incorrect root of lang files.");
        if (!$lang) throw new LangException("Got incorrect code of language.");

        $path = $root . $lang . ".json";

        if (!file_exists($path)) return self::loadLangData($root, self::UK);

        return json_decode(file_get_contents($path), true) ?: array();
    }

    /**
     * Returns path to the root of language files for admin side of the platform.
     * @return string
     */
    static function getTechRoot() {
        return $_SERVER["DOCUMENT_ROOT"] .  DIRECTORY_SEPARATOR . "teach" . DIRECTORY_SEPARATOR . "lang" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR;
    }

    /**
     * Returns path to the root of language files for student side of the platform.
     * @return string
     */
    static function getStudRoot() {
        return $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "lang" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR;
    }

    /**
     * Returns default parameters of instance.
     * @return array
     */
    function getDefParams() {
        $defParams = array(
            "lang" => $_SESSION["settings"]["lang"],
            "root" => DIRECTORY_SEPARATOR . "teach" . DIRECTORY_SEPARATOR . "lang" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR
        );

        $defParams["lang"] = $defParams["lang"] ?: self::UK;

        return $defParams;
    }

    /**
     * Returns language data using key.
     * @param string $key Key to aim language data.
     * @return string Language data.
     * @throws LangException
     */
    function get($key) {
        if (!$key) throw new LangException("Got incorrect key to find language data.");

        return $this->data[$key];
    }
}
?>
