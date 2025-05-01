<?php
defined("BASEPATH") or exit ("No direct script access allowed");

class MigrateController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->input->is_cli_request() or exit ("Execute via command line: php index.php migrate");

        $this->load->library('migration');
    }

    public function index()
    {
        if (ENVIRONMENT == 'development') {

            log_message('debug','Found migrations: '.print_r($this->migration->find_migrations(),true));
            if($this->migration->current() === FALSE){
                log_message('debug','Migration Error: '.error_string());
                show_error($this->migration->error_string());
            }else{
                log_message('debug','Ran Migration');
            }
        }
    }
}

?>