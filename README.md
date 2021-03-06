jh_agenda
=========

<h2>How to install ? How to use ?</h2>
        <div>
            <pre>
            &lt;?php
            require_once ('jh_agenda.class.php');
            $jh_agenda = new JhAgenda();
            ?&gt;
            </pre>
            
            <p>That's it !</p>
        </div>
        
        <h2>How to build a full calendar for the current year ?</h2>
        <div>
            <pre>
            $jh_agenda-&gt;setCurrentYear(isset($_GET['year']) ? $_GET['year'] : null);
            $jh_agenda-&gt;setCurrentMonth(isset($_GET['month']) ? $_GET['month'] : null);
            $jh_agenda-&gt;buildMonthsPerYear()-&gt;prepareMonthsPerYear()-&gt;displayMonthsPerYear();
            </pre>
        </div>
        
        <h2>How to build a specific month ?</h2>
        <div>
            <pre>
            $jh_agenda = new JhAgenda();
            $jh_agenda-&gt;setCurrentYear(2012);
            $jh_agenda-&gt;setCurrentMonth(6);
            $jh_agenda-&gt;buildDaysPerMonth();
            $jh_agenda-&gt;prepareDaysPerMonth();
            $jh_agenda-&gt;displayDaysPerMonth();
            </pre>
            
            <p>or if you chain it</p>
            
            <pre>
            $jh_agenda = new JhAgenda();
            $jh_agenda-&gt;setCurrentYear(2012)-&gt;setCurrentMonth(6);
            $jh_agenda-&gt;buildDaysPerMonth()-&gt;prepareDaysPerMonth()-&gt;displayDaysPerMonth();
            </pre>
            
            <p>Function setCurrentYear and setCurrentMonth are optional</p>
        </div>
        
        <h2>Why so many functions ?</h2>
        <div>
            <p>If you just want day's timestamp of the month, you can do:</p>
            
            <pre>
            $jh_agenda = new JhAgenda();
            $timestamps = $jh_agenda-&gt;buildDaysPerMonth()-&gt;getDaysPerMonth();
            </pre>
            
            <p>Output:</p>
            
            <pre>
            Array
            (
                [0] =&gt; 1338501600
                [1] =&gt; 1338588000
                [2] =&gt; 1338674400
                ...
                [27] =&gt; 1340834400
                [28] =&gt; 1340920800
                [29] =&gt; 1341007200
            )
            </pre>
            
            <p>If you want a formatted array to make easier its display, use:</p>
            
            <pre>
            $jh_agenda = new JhAgenda();
            $timestamps = $jh_agenda-&gt;buildDaysPerMonth()-&gt;prepareDaysPerMonth()-&gt;getDaysPerMonth();
            </pre>
            
            <p>Output:</p>
            
            <pre>
            Array
            (
                [head] =&gt; Array
                    (
                        [0] =&gt; 1
                        [1] =&gt; 2
                        [2] =&gt; 3
                        [3] =&gt; 4
                        [4] =&gt; 5
                        [5] =&gt; 6
                        [6] =&gt; 7
                    )

                [body] =&gt; Array
                    (
                        [0] =&gt; Array
                            (
                                [0] =&gt; 1338156000
                                [1] =&gt; 1338242400
                                [2] =&gt; 1338328800
                                [3] =&gt; 1338415200
                                [4] =&gt; 1338501600
                                [5] =&gt; 1338588000
                                [6] =&gt; 1338674400
                            )

                        [1] =&gt; Array
                            (
                                [0] =&gt; 1338760800
                                [1] =&gt; 1338847200
                                [2] =&gt; 1338933600
                                [3] =&gt; 1339020000
                                [4] =&gt; 1339106400
                                [5] =&gt; 1339192800
                                [6] =&gt; 1339279200
                            )

                        [2] =&gt; Array
                            (
                                [0] =&gt; 1339365600
                                [1] =&gt; 1339452000
                                [2] =&gt; 1339538400
                                [3] =&gt; 1339624800
                                [4] =&gt; 1339711200
                                [5] =&gt; 1339797600
                                [6] =&gt; 1339884000
                            )

                        [3] =&gt; Array
                            (
                                [0] =&gt; 1339970400
                                [1] =&gt; 1340056800
                                [2] =&gt; 1340143200
                                [3] =&gt; 1340229600
                                [4] =&gt; 1340316000
                                [5] =&gt; 1340402400
                                [6] =&gt; 1340488800
                            )

                        [4] =&gt; Array
                            (
                                [0] =&gt; 1340575200
                                [1] =&gt; 1340661600
                                [2] =&gt; 1340748000
                                [3] =&gt; 1340834400
                                [4] =&gt; 1340920800
                                [5] =&gt; 1341007200
                                [6] =&gt; 1341093600
                            )

                    )

            )
            </pre>
            
            <p>[head] contains the seven days in a week. 1 is monday, ... 7 is sunday</p>
            
            <p>[body] contains timestamp's days by number of week in the month. 4 weeks, 4 sub-arrays. 5 weeks, 5 sub-arrays</p>
        </div>
        
        <h2>How do I translate in another language ?</h2>
        <div>
            <p>In "jh_agenda.class.php" file, just change $months_labels, $days_labels and $weeks_label.</p>
        </div>
        
        <h2>The default view is not for me</h2>
        <div>
            <p>If the default view is not appropriate for you, you have two solutions :</p>
            <ul>
            <li>Edit displayDaysPerMonth() function directly</li>
            <li>Create an extended class of JhAgenda and overload or create your function</li>
            </ul>
        </div>
