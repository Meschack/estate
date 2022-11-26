<?php
function validateInput(string $username, int $valueMin, int $valueMax): bool
{
    if (strlen($username) < $valueMin && strlen($username > $valueMax)) {
        return false;
    } else {
        return true;
    }
}
