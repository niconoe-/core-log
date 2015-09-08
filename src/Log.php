<?php

/**
 * Aareon Log : extends the Zend Log instance to add another priority specific for Synchronization process
 *
 * @method void synchro()
 *
 * Extends
 * @method void emerg(string $message, mixed $extras = null)
 * @method void alert(string $message, mixed $extras = null)
 * @method void crit(string $message, mixed $extras = null)
 * @method void err(string $message, mixed $extras = null)
 * @method void warn(string $message, mixed $extras = null)
 * @method void notice(string $message, mixed $extras = null)
 * @method void info(string $message, mixed $extras = null)
 * @method void debug(string $message, mixed $extras = null)
 *
 * @author Laurent Boulay <laurent.boulay@aareon.fr>
 * @author Nicolas Giraud <nicolas.giraud@aareon.fr> (for PHPDOCs)
 * @author Aareon France
 *
 */
namespace Core\Log;

use Zend\Config\Config;
use Zend\Log\Exception\ExceptionInterface;
use Zend\Log\Exception\InvalidArgumentException;
use Zend\Log\Logger;

class Log extends Logger
{
    const SYNCHRO = 8;  // Synchro: Synchro messages

    public function log($message, $priority, $extras = null, $displayScreen = false)
    {
        if ($displayScreen) {
            echo $message.PHP_EOL;
        }
        parent::log($message, $priority, $extras);
    }

    /**
     * Copy from Zend\Log\Logger else it can't be extended
     * Factory to construct the logger and one or more writers
     * based on the configuration array
     *
     * @param  array|Config Array or instance of Zend\Config\Config
     * @return Logger
     * @throws ExceptionInterface
     */
    static public function factory($config = array())
    {
        if ($config instanceof Config) {
            $config = $config->toArray();
        }

        $log = new self();
        if (empty($config)) {
            return $log;
        }

        if (!is_array($config)) {
            $config = [$config];
        }
        foreach ($config as $writer) {
            $log->addWriter($writer);
        }

        return $log;
    }
}