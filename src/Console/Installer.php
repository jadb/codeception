<?php
namespace Cake\Codeception\Console;

use Composer\Script\Event;

class Installer
{
    public static function postInstall(Event $event)
    {
        $binDir = dirname(dirname(dirname(dirname(__DIR__)))) . DIRECTORY_SEPARATOR . 'bin';
        $binFile = $binDir . DIRECTORY_SEPARATOR . 'codecept';
        $contents = file_get_contents($binFile);
        $from = 'new Codeception\\Command\\';
        $to = 'new Cake\\Codeception\\Command\\';

        $needles = [
            'Build',
            'Bootstrap',
        ];

        foreach ($needles as $needle) {
            $contents = str_replace(
                $from . $needle,
                $to . $needle,
                $contents
            );
        }

        file_put_contents($binFile, $contents);
    }
}