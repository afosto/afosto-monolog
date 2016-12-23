<?php

namespace Afosto\Monolog;

use Monolog\Formatter\NormalizerFormatter;

class AfostoFormatter extends NormalizerFormatter {

    /**
     * {@inheritdoc}
     */
    public function format(array $record)
    {
        $record = parent::format($record);

        $context = [];

        foreach ($record['context'] as $key => $value) {
            $context[] = [
                'key' => $key,
                'value' => $value,
            ];
        }

        return [
            'level' => $record['level_name'],
            'message' => $record['message'],
            'channel' => $record['channel'],
            'context' => $context,
        ];
    }
}
