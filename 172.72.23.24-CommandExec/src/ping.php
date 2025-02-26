<?php
            if (isset($_POST['target']) && !empty($_POST['target'])) {
                $target = $_POST['target'];

                $command = "ping -c 4 " . $target;
                
                echo '<div class="result-area">';
                echo "<h5>检测结果：</h5>";
                echo "<pre>";
                $output = [];
                exec($command, $output);
                foreach($output as $line) {
                    echo htmlspecialchars($line) . "\n";
                }
                echo "</pre>";
                echo '</div>';
            }
            ?>