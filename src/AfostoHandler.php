<?php

namespace Afosto\Monolog;

use Afosto\ApiClient\App;
use Monolog\Handler\AbstractProcessingHandler;

class AfostoHandler extends AbstractProcessingHandler {

    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     *
     * @return void
     */
    protected function write(array $record) {
        App::getInstance()->getClient()->request('POST', 'errors', [
            'json' => $record['formatted'],
        ]);
    }
}
