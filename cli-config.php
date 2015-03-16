<?php
use Doctrine\DBAL\Tools\Console\ConsoleRunner;

require_once 'app/config.php';

return ConsoleRunner::createHelperSet($entityManager);
