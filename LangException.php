<?php
namespace libs\php\lang;
use Throwable;

/**
 * Exception class for language classes.
 * @package libs\balov\lang
 */
class LangException extends \Exception {
    /**
     * LangException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    function __construct($message = "", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
?>
