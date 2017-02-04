<?php

namespace App\Actions;

include '../../bootstrap.php';

/**
 * Create contact action.
 */
class CreateContact
{
    /**
     * Handles the action action.
     */
    public function handle()
    {
        include '../views/create-contact.php';
    }
}

$createContact = new CreateContact();
$createContact->handle();
