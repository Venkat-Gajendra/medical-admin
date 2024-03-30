<?php

class Calendar {

    private int $year;
    private int $month;
    private int $startDayOfWeek;
    private int $numDaysInMonth;
    private \PDO $database;

    public function __construct(?int $year = null, ?int $month = null) {
        $this->year = $year ?? date('Y');
        $this->month = $month ?? date('n');
        $this->startDayOfWeek = date('N', mktime(0, 0, 0, $this->month, 1, $this->year));
        $this->numDaysInMonth = date('t', mktime(0, 0, 0, $this->month, 1, $this->year));
        $this->database = new \PDO('mysql:host=localhost;dbname=testdb;charset=utf8', 'username', 'password');
    }

    public function generateCalendar(): void {
        echo '<h2>' . date('F Y', mktime(0, 0, 0, $this->month, 1, $this->year)) . '</h2>';
        echo '<table>';
        echo '<tr>';
        echo '<th class= "week">Mon</th>';
        echo '<th class= "week">Tue</th>';
        echo '<th class= "week">Wed</th>';
        echo '<th class= "week">Thu</th>';
        echo '<th class= "week">Fri</th>';
        echo '<th class= "week">Sat</th>';
        echo '<th class= "week">Sun</th>';
        echo '</tr>';

        $dayCounter = 0;
        $nextMonthFlag = false;

        echo '<tr>';
        for ($i = 1 - $this->startDayOfWeek; $i <= $this->numDaysInMonth; $i++) {
            if ($dayCounter % 7 == 0 && $dayCounter != 0) {
                echo '</tr><tr>';
            }
            if ($i < 1 || $i > $this->numDaysInMonth) {
                echo '<td></td>';
            } else {
                $class = ($i == date('j') && $this->year == date('Y') && $this->month == date('n')) ? 'current' : '';
                $class .= (in_array(sprintf('%d-%02d-%d', $this->year, $this->month, $i), $this->getDates())) ? ' event' : '';
                echo '<td>';
                echo '<button class="calenderbtn "value="' . $class . '" onclick="showAvailableTimes(\'' . sprintf('%d-%02d-%d', $this->year, $this->month, $i) . '\')">' . $i . '</button>';
                echo '</td>';
            }
            $dayCounter++;
        }

        echo '</tr>';
        echo '</table>';
    }

    public function getPreviousMonthLink(): string {
        $year = ($this->month == 1) ? $this->year - 1 : $this->year;
        $month = ($this->month == 1) ? 12 : $this->month - 1;
        return '?year=' . $year . '&month=' . $month;
    }

    public function getNextMonthLink(): string {
        $year = ($this->month == 12) ? $this->year + 1 : $this->year;
        $month = ($this->month == 12) ? 1 : $this->month + 1;
        return '?year=' . $year . '&month=' . $month;
    }

    private function getDates(): array {
        $sql = "SELECT scheduledate FROM schedule";
        $stmt = $this->database->query($sql);

        if ($stmt === false) {
            throw new \PDOException('Database query failed');
        }

        $dates = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $dates[] = $row['scheduledate'];
        }
        return $dates;
    }
}

$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
$month = isset($_GET['month']) ? intval($_GET['month']) : date('n');

$calendar = new Calendar($year, $month);

echo '<div>';
echo '<a class= "revm" href="' . $calendar->getPreviousMonthLink() . '"><button>Previous Month</button></a>';
echo ' | ';
echo '<a class="nexm" href="' . $calendar->getNextMonthLink() . '"><button>Next Month</button></a>';
echo '</div>';

$calendar->generateCalendar();
