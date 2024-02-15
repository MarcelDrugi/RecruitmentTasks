<?php

declare(strict_types=1);

namespace RecruitmentTasks\app;

class Lottery extends \PDO
{
    /**
     * @var string
     */
    private const STRUCTURE_QUERY_FILE = '/db/struktura.sql';

    /**
     * @var string
     */
    private const DATA_QUERY_FILE = '/db/dane.sql';

    /**
     * @var string
     */
    public const CREATE_STRUCTURE_OPERATION = 'create_structure';

    /**
     * @var string
     */
    public const INSERT_DATA_OPERATION = 'insert_data';

    public function __construct(
        string      $databaseName,
        string|null $username = null,
        string|null $password = null,
    ) {
        $database = 'mysql:host=localhost;dbname=' . $databaseName;
        parent::__construct($database, $username, $password);
    }

    /**
     * @param string $operation
     * @return bool
     */
    public function prepareDatabase(string $operation): bool
    {
        switch ($operation) {
            case self::CREATE_STRUCTURE_OPERATION:
                $path = $this->getPath(self::STRUCTURE_QUERY_FILE);
                break;
            case self::INSERT_DATA_OPERATION:
                $path = $this->getPath(self::DATA_QUERY_FILE);
                break;
            default:
                echo 'Unknown operation';
                return false;
        }
        $query = file_get_contents($path);
        if ($query) {
            try {
                $this->query($query);
            } catch (\PDOException $exception) {
                echo $exception->getMessage() . "\n";

                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $path
     * @return string
     */
    private function getPath(string $path): string
    {
        return dirname(__DIR__) . $path;
    }

    /**
     * @return void
     */
    public function displayWinningTickets(): void
    {
        $winningTicketsQuery =  <<<EOT
            SELECT t.id 
            FROM tickets t 
            INNER JOIN draws d ON d.won_number = t.number AND t.draw_id = d.id
            INNER JOIN lotteries l ON l.id = d.lottery_id
            WHERE l.name = "GG World X";
        EOT;

        $ticketsResource = $this->query($winningTicketsQuery);
        echo "winning ticket numbers: ";
        while($row = $ticketsResource->fetch()) {
            if (isset($row['id'])) {
                echo $row['id'] . '  ';
            }
        }
        echo "\n";
    }

    /**
     * @return void
     */
    public function displaySummary(): void
    {
        $summaryQuery =  <<<EOT
            SELECT l.name as 'nazwa_loterii', COUNT(t.id) * l.ticket_price as 'przychod', (COUNT(t.id) - COUNT(CASE WHEN t.bought_date > d.draw_date THEN 1 ELSE null END)) * l.ticket_price  as 'zysk' 
            FROM tickets t 
            INNER JOIN draws d ON t.draw_id = d.id 
            INNER JOIN lotteries l ON l.id = d.lottery_id 
            WHERE t.bought_date BETWEEN "2021-07-01" AND "2021-07-31" 
            GROUP BY l.ticket_price, l.name;
        EOT;

        echo "BALANCE FOR JULY\n";
        $summaryResource = $this->query($summaryQuery);
        while($row = $summaryResource->fetch()) {
            if (isset($row['nazwa_loterii'])) {
                echo 'nazwa_loterii: ' . $row['nazwa_loterii'] . ', ';
            }
            if (isset($row['przychod'])) {
                echo 'przychod: ' . $row['przychod'] . ', ';
            }
            if (isset($row['zysk'])) {
                echo 'zysk: ' . $row['zysk'] . ' ';
            }
            echo "\n";
        }
    }
}