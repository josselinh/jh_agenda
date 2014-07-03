<?php
class JhAgenda
{
    /**
     * Labels for each month.
     * Do not forget to add one empty at begining.
     * @var array $months_labels
     */
    protected $months_labels = array('', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

    /**
     * Labels for each day.
     * Do not forget to add one empty at begining.
     * @var array $days_labels
     */
    protected $days_labels = array('', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

    /**
     * Label for week.
     * @var string $weeks_label
     */
    protected $weeks_label = 'Weeks';

    /**
     * Current year.
     * @var int $current_year
     */
    protected $current_year = null;

    /**
     * Current month.
     * @var int $current_month
     */
    protected $current_month = null;

    /**
     * Current day.
     * @var int $current_day
     */
    protected $current_day = null;

    /**
     * This array contains all months.
     * @var array $months_per_year
     */
    protected $months_per_year = array();

    /**
     * This array contains all days of a month.
     * @var array $days_per_month
     */
    protected $days_per_month = array();

    /**
     * This is the default contructor
     */
    public function __construct()
    {
        $this->setCurrentYear();
        $this->setCurrentMonth();
        $this->setCurrentDay();
    }

    // SETTERS \\

    /**
     * Setter of $current_year.
     * @param int $year
     * @return JhAgenda
     */
    public function setCurrentYear($year = null)
    {
        $this->current_year = (is_null($year) ? date('Y') : (int) $year);

        return $this;
    }

    /**
     * Setter of $current_month.
     * @param int $month
     * @return JhAgenda
     */
    public function setCurrentMonth($month = null)
    {
        $this->current_month = (is_null($month) ? date('n') : (int) $month);

        return $this;
    }

    /**
     * Setter of $current_day
     * @param int $day
     * @return JhAgenda
     */
    public function setCurrentDay($day = null)
    {
        $this->current_day = (is_null($day) ? date('j') : (int) $day);

        return $this;
    }

    // GETTER \\

    /**
     * Getter of $month_per_year.
     * @return array
     */
    public function getMonthsPerYear()
    {
        return $this->months_per_year;
    }

    /**
     * Getter of $day_per_month.
     * @return array
     */
    public function getDaysPerMonth()
    {
        return $this->days_per_month;
    }

    /**
     * Get the previous year of the current year
     * @return string
     */
    public function getPreviousYear()
    {
        return date('Y', strtotime('-1 year', mktime(0, 0, 0, $this->current_month, 1, $this->current_year)));
    }

    /**
     * Get the next year of the current year
     * @return string
     */
    public function getNextYear()
    {
        return date('Y', strtotime('+1 year', mktime(0, 0, 0, $this->current_month, 1, $this->current_year)));
    }

    /**
     * Get the previous month of the current month
     * @return string
     */
    public function getPreviousMonth()
    {
        return date('n', strtotime('-1 month', mktime(0, 0, 0, $this->current_month, 1, $this->current_year)));
    }

    /**
     * Get the next month of the current month
     * @return string
     */
    public function getNextMonth()
    {
        return date('n', strtotime('+1 month', mktime(0, 0, 0, $this->current_month, 1, $this->current_year)));
    }

    // HELPERS FOR DAYS \\

    /**
     * Return true if the timestamp equals today
     * @param timestamp $timestamp
     * @return boolean
     */
    public function isToday($timestamp) {
        return ($timestamp == mktime(0, 0, 0, date('m'), date('d'), date('Y')));
    }

    /**
     * Return true if timestamp day is monday
     * @param timestamp $timestamp
     * @return boolean
     */
    public function isMonday($timestamp)
    {
        return (date('w', $timestamp) == 1);
    }

    /**
     * Return true if timestamp day is tuesday
     * @param timestamp $timestamp
     * @return boolean
     */
    public function isTuesday($timestamp)
    {
        return (date('w', $timestamp) == 2);
    }

    /**
     * Return true if timestamp day is wednesday
     * @param timestamp $timestamp
     * @return boolean
     */
    public function isWednesday($timestamp)
    {
        return (date('w', $timestamp) == 3);
    }

    /**
     * Return true if timestamp day is thursday
     * @param timestamp $timestamp
     * @return boolean
     */
    public function isThursday($timestamp)
    {
        return (date('w', $timestamp) == 4);
    }

    /**
     * Return true if timestamp day is friday
     * @param timestamp $timestamp
     * @return boolean
     */
    public function isFriday($timestamp)
    {
        return (date('w', $timestamp) == 5);
    }

    /**
     * Return true if timestamp day is saturday
     * @param timestamp $timestamp
     * @return boolean
     */
    public function isSaturday($timestamp)
    {
        return (date('w', $timestamp) == 6);
    }

    /**
     * Return true if timestamp day is sunday
     * @param timestamp $timestamp
     * @return boolean
     */
    public function isSunday($timestamp)
    {
        return (date('w', $timestamp) == 0);
    }

    // BUILD \\

    /**
     * Build an array with all months in the current year.
     * A month is a timestamp of its first day.
     * @return JhAgenda
     */
    public function buildMonthsPerYear()
    {
        // Reset
        $this->months_per_year = array();

        // Loop on $this->months_labels
        foreach ($this->months_labels as $num_month => $label) {
            if ($num_month == 0) continue 1;
            $this->months_per_year[] = mktime(0, 0, 0, $num_month, 1, $this->current_year);
        }

        return $this;
    }

    /**
     * Build an array with all days in the current month.
     * A day is a timestamp.
     * @return JhAgenda
     */
    public function buildDaysPerMonth()
    {
        // Reset
        $this->days_per_month = array();

        // Setting the first and last day of the month
        $timestamp_first_day_of_month = mktime(0, 0, 0, $this->current_month, 1, $this->current_year);
        $timestamp_last_day_of_month = mktime(0, 0, 0, $this->current_month, date('t', $timestamp_first_day_of_month), $this->current_year);

        // Loop on $timestamps
        for ($timestamp = $timestamp_first_day_of_month; $timestamp <= $timestamp_last_day_of_month; $timestamp = strtotime('+1 day', $timestamp)) {
            $this->days_per_month[] = $timestamp;
        }

        return $this;
    }

    // PREPARE \\

    /**
     * Prepare $months_per_year to make easier to use.
     * @return JhAgenda
     */
    public function prepareMonthsPerYear()
    {
        // Reset and copy
        $months_per_year = $this->months_per_year;
        $this->months_per_year = array();

        // Preparing the final array
        foreach ($months_per_year as $timestamp) {
            $year = date('Y', $timestamp);
            $num_month = date('n', $timestamp);

            // Setting year, month, build days, prepare, and get
            $this->months_per_year[$num_month] = $this->setCurrentYear($year)->setCurrentMonth($num_month)->buildDaysPerMonth()->prepareDaysPerMonth()->getDaysPerMonth();
        }

        return $this;
    }

    /**
     * Prepare $days_per_month to make easier to use.
     * @return JhAgenda
     */
    public function prepareDaysPerMonth()
    {
        // Reset and copy
        $days_per_month = $this->days_per_month;
        $this->days_per_month = array();
        $index = 0;

        // Head
        foreach ($this->days_labels as $num_day => $label) {
            if ($num_day == 0) continue 1;
            $this->days_per_month['head'][] = $num_day;
        }

        // Get the day number of the first day
        $timestamp = $days_per_month[0];
        $first_day_number = date('w', $timestamp);
        $first_day_number = ($first_day_number == 0 ? 7 : $first_day_number);

        // Add possible days of previous month
        for ($added_day = $first_day_number; $added_day > 1; $added_day --) {
            $this->days_per_month['body'][$index][] = strtotime('-' . ($added_day - 1) . ' days', $timestamp);
        }

        // Add days of month
        foreach ($days_per_month as $timestamp) {
            $this->days_per_month['body'][$index][] = $timestamp;

            if (date('w', $timestamp) == 0) {
                $index += 1;
            }
        }

        // Add possible days of next month
        $added_day_number = 7 - count($this->days_per_month['body'][$index]);
        for ($added_day = 1; $added_day <= $added_day_number; $added_day ++) {
            $this->days_per_month['body'][$index][] = strtotime('+' . $added_day . ' days', $timestamp);
        }

        return $this;
    }

    // DISPLAY \\

    /**
     * Default display
     */
    public function displayMonthsPerYear()
    {
        echo '<table class="all-months">';
            echo '<tr>';
            foreach ($this->months_per_year as $num_month => $days_per_month) {
                echo '<td>';
                    $this->current_month = $num_month;
                    $this->days_per_month = $days_per_month;
                    $this->displayDaysPerMonth();
                echo '</td>';
    
                if ($num_month % 2  == 0) {
                    echo '</tr><tr>';
                }
            }
            echo '</tr>';
        echo '</table>';

        echo '<a href="?' . http_build_query(array('year' => $this->getPreviousYear())) . '">Previous Year</a>';
        echo ' - ';
        echo '<a href="?' . http_build_query(array('year' => $this->getNextYear())) . '">Next Year</a>';
    }

    /**
     * Default display
     */
    public function displayDaysPerMonth()
    {
        echo '<table class="one-month">';
            echo '<caption>' . $this->months_labels[$this->current_month] . ' - ' . $this->current_year . '</caption>';

            echo '<thead>';
                echo '<tr>';
                    echo '<th class="border">' . $this->weeks_label . '</th>';
                    foreach ($this->days_per_month['head'] as $num_day) {
                        echo '<th class="border">' . $this->days_labels[$num_day] . '</th>';
                    }
                echo '</tr>';
            echo '</thead>';

            echo '<tbody>';
                foreach ($this->days_per_month['body'] as $week => $timestamps) {
                    echo '<tr>';
                        echo '<td class="border weeks">' . date('W', $timestamps[0]) . '</td>';
                        foreach ($timestamps as $timestamp) {
                            $class = array();
                            $class[] = 'border';

                            if ($this->current_month == date('m') and $this->isToday($timestamp)) {
                                $class[] = 'today';
                            }

                            if ($this->isSaturday($timestamp) or $this->isSunday($timestamp)) {
                                $class[] = 'week-end';
                            }

                            if (date('n', $timestamp) != $this->current_month) {
                                $class[] = 'other-month';
                            }

                            echo '<td class="' . implode(' ', $class) . '">' . date('j', $timestamp) . '</td>';
                        }
                    echo '</tr>';
                }
            echo '</tbody>';
        echo '</table>';
    }
}
?>