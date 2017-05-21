<?php

// Create the data directory for the sqlite database
if (!file_exists('var/data')) {
    mkdir('var/data', 0777, true);
}