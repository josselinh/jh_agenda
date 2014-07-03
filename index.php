<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JhAgenda - Demo</title>
        <style type="text/css">
            body {
                font-size: small;
                font-weight: bold;
            }
        
            .all-months {
                border-collapse: separate;
                border-spacing: 10px;
            }
            
            .all-months td {
                vertical-align: top;
            }
            
            .border {
                border: 1px solid #AED0EA;
                background: #D7EBF9;
                color: #2779AA;
            }
            
            th.border {
                background: #2779AA;
                color: white;
            }
            
            .one-month {
                text-align: center;
            }
                
            .one-month .border {
                width: 70px;
            }
            
            .today {
                border: 1px solid #F9DD34;
                background: #FFEF8F;
                color: #363636;
            }
            
            .week-end {
                background-color: #D9FFF9;
            }
            
            .other-month {
                background: white;
            }
            
            .weeks {
                background: #2779AA;
                color: white;
            }
        </style>
    </head>

    <body>
        <?php
        require_once ('jh_agenda.class.php');
        
        function pr($value = array(), $name = '$undefined')
        {
            echo '<table border="1">'
            . '<tr><th>' . $name . '</th></tr>'
            . '<tr><td><pre>' . print_r($value, true) . '</pre></td></tr>'
            . '</table>';
        }
        
        $jh_agenda = new JhAgenda();
        $jh_agenda->setCurrentYear(isset($_GET['year']) ? $_GET['year'] : null)->setCurrentMonth(isset($_GET['month']) ? $_GET['month'] : null);
        $jh_agenda->buildMonthsPerYear()->prepareMonthsPerYear()->displayMonthsPerYear();
        ?>
    </body>
</html>