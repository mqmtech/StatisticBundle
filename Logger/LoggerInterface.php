<?php

namespace MQM\StatisticBundle\Logger;

interface LoggerInterface
{
    public function logStatistic();

    public function getDefaultOptions(array $options);
}