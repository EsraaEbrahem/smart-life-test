<?php

class DashboardController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->isNotLoggedIn();

        $this->load->model('model_student');
        $this->load->model('model_teacher');
        $this->load->model('model_classes');
        $this->load->model('model_marksheet');
        $this->load->model('model_accounting');

        // loading the form validation library
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = ucfirst('dashboard'); // Capitalize the first letter

        $data['countTotalStudent'] = $this->model_student->countTotalStudent();
        $data['countTotalTeacher'] = $this->model_teacher->countTotalTeacher();
        $data['countTotalClasses'] = $this->model_classes->countTotalClass();
        $data['countTotalMarksheet'] = $this->model_marksheet->countTotalMarksheet();

        $data['totalIncome'] = $this->model_accounting->totalIncome();
        $data['totalExpenses'] = $this->model_accounting->totalExpenses();
        $data['totalBudget'] = $this->model_accounting->totalBudget();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * to filter dashboard budget based on date filter
     * @return void
     */
    public function incomeFilter()
    {
        $from = $this->input->post('fromDate');
        $to = $this->input->post('toDate');
        if($from > $to)
            echo json_encode(array('success'=>false));
        else{
            $data['success'] = true;
            $data['totalIncome'] = $this->model_accounting->totalIncome($from,$to);
            $data['totalExpenses'] = $this->model_accounting->totalExpenses($from,$to);
            $data['totalBudget'] = $this->model_accounting->totalBudget($from,$to);

            echo json_encode($data);
        }
    }

}