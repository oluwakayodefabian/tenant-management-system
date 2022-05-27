<?php


if (!function_exists('successMessage')) {
    /**
     * @return all success messages
     */
    function successMessage()
    {
        $session = \Config\Services::session();
        if (!is_null($session->getFlashdata('success'))) {
            return $session->getFlashdata('success');
        }
    }
}

if (!function_exists('errorMessage')) {
    /**
     * @return all error messages
     */
    function errorMessage()
    {
        $session = \Config\Services::session();
        if ($session->getFlashdata('error')) {
            return $session->getFlashdata('error');
        }
    }
}
