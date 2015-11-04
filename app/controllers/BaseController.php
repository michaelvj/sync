<?php

class BaseController extends Controller {

    public function __construct()
    {
        // Check the csrf-token on POST requests.
        $this->beforeFilter('csrf', array('on' => 'post'));
	}
}