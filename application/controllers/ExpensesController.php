<?php

class ExpensesController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->isNotLoggedIn();

        // accounting
        $this->load->model('model_accounting');

        // loading the form validation library
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Expenses'; // Capitalize the first letter
        $this->load->view('templates/header', $data);
        $this->load->view('accounting/expenses', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * add expense
     * @return void
     */
    public function createExpenses()
    {
        $validator = array('success' => false, 'messages' => array());

        $expname = $this->input->post('subExpensesName');
        if (!empty($expname)) {
            foreach ($expname as $key => $value) {
                $this->form_validation->set_rules('subExpensesName[' . $key . ']', 'Expenses Name', 'required');
            }
        }

        $expamount = $this->input->post('subExpensesAmount');
        if (!empty($expamount)) {
            foreach ($expamount as $key => $value) {
                $this->form_validation->set_rules('subExpensesAmount[' . $key . ']', 'Total Amount', 'required');
            }
        }

        $validate_data = array(
            array(
                'field' => 'expensesDate',
                'label' => 'Expenses Date',
                'rules' => 'required'
            ),
            array(
                'field' => 'expensesName',
                'label' => 'Expenses Name',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($validate_data);
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run() === true) {
            $create = $this->model_accounting->createExpenses();
            if ($create === true) {
                $validator['success'] = true;
                $validator['messages'] = "Successfully added";
            } else {
                $validator['success'] = false;
                $validator['messages'] = "Error while inserting the information into the database";
            }
        } else {
            $validator['success'] = false;
            foreach ($_POST as $key => $value) {
                if ($key == 'subExpensesName') {
                    foreach ($value as $number => $data) {
                        $validator['messages']['subExpensesName' . $number] = form_error('subExpensesName[' . $number . ']');
                    } // /.foreach
                } // /.if
                else if ($key == 'subExpensesAmount') {
                    foreach ($value as $number => $data) {
                        $validator['messages']['subExpensesAmount' . $number] = form_error('subExpensesAmount[' . $number . ']');
                    } // /.foreach
                } else {
                    $validator['messages'][$key] = form_error($key);
                } // /.
            } // /.foreach
        } // /else

        echo json_encode($validator);
    }

    /**
     *    *---------------------------------------------------------------
     * fetches the expenses data from the `expenses_name` and
     * `expenses` table function
     *---------------------------------------------------------------
     */
    public function fetchExpensesData()
    {
        $expensesData = $this->model_accounting->fetchExpensesNameData();


        $result = array('data' => array());
        foreach ($expensesData as $key => $value) {

            $totalExpensesItem = $this->model_accounting->countTotalExpensesItem($value['id']);

            $button = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Action <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a href="#" data-toggle="modal" data-target="#edit-expenses-modal" onclick="updateExpenses(' . $value['id'] . ')">Edit</a></li>
			    <li><a href="#" data-toggle="modal" data-target="#removeExpensesModal" onclick="removeExpenses(' . $value['id'] . ')">Remove</a></li>    
			  </ul>
			</div>';

            $result['data'][$key] = array(
                $value['name'],
                $value['date'],
                $totalExpensesItem,
                $value['total_amount'],
                $button
            );
        }

        echo json_encode($result);
    }

    /**---------------------------------------------------------------
     * fetches the expenses data from the database function
     *---------------------------------------------------------------
     */
    public function fetchExpensesDataForUpdate($id = null)
    {
        if ($id) {

            $expenseNameData = $this->model_accounting->fetchExpensesNameData($id);
            $expensesItemData = $this->model_accounting->fetchExpensesItemData($id);

            $table = '<div class="form-group">
          <label for="editExpensesDate" class="col-sm-3 control-label">Expenses Date:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="editExpensesDate" name="editExpensesDate" placeholder="Expenses Date" value="' . $expenseNameData['date'] . '" />
          </div>
        </div>
        <div class="form-group">
          <label for="editExpensesName" class="col-sm-3 control-label">Expenses Name:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="editExpensesName" name="editExpensesName" placeholder="Expenses Name" value="' . $expenseNameData['name'] . '" />
          </div>
        </div>
        <div class="form-group">
          <label for="editTotalAmount" class="col-sm-3 control-label">Total Amount:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="editTotalAmount" name="editTotalAmount" placeholder="Total Amount"  value="' . $expenseNameData['total_amount'] . '"/>
            <input type="hidden" class="form-control" id="editTotalAmountValue" name="editTotalAmountValue" value="' . $expenseNameData['total_amount'] . '" />
          </div>
        </div>
        <table class="table table-bordered" id="editSubExpensesTable">
        <thead>
          <tr>
            <th>Name</th>
            <th>Amount</th>
            <th style="width:10%;">Action</th>
          </tr>
        </thead>
        <tbody>';
            $x = 1;
            foreach ($expensesItemData as $key => $value) {
                $table .= '<tr id="row' . $x . '">
		            <td class="form-group">
		            <input type="text" class="form-control" name="editSubExpensesName[' . $x . ']" id="editSubExpensesName' . $x . '" placeholder="Expenses Name" value="' . $value['expenses_name'] . '"/>
		            </td>
		            <td class="form-group">
		            <input type="text" class="form-control" name="editSubExpensesAmount[' . $x . ']" id="editSubExpensesAmount' . $x . '" onkeyup="editCalculateTotalAmount()" placeholder="Expenses Amount" value="' . $value['expenses_amount'] . '" />
		            </td>
		            <td>
		            <button type="button" class="btn btn-default" onclick="removeEditExpensesRow(' . $x . ')"><i class="glyphicon glyphicon-remove"></i></button>
		            </td>
		          </tr>';
                $x++;
            } // /.foreach
            $table .= '</tbody>
	    </table>';

            echo $table;
        }
    }

    /**
    *---------------------------------------------------------------
    * update the expenses function
    *---------------------------------------------------------------
    */
    public function updateExpenses($id = null)
    {
        if ($id) {

            $validator = array('success' => false, 'messages' => array());

            $expname = $this->input->post('editSubExpensesName');
            if (!empty($expname)) {
                foreach ($expname as $key => $value) {
                    $this->form_validation->set_rules('editSubExpensesName[' . $key . ']', 'Expenses Name', 'required');
                }
            }

            $expamount = $this->input->post('editSubExpensesAmount');
            if (!empty($expamount)) {
                foreach ($expamount as $key => $value) {
                    $this->form_validation->set_rules('editSubExpensesAmount[' . $key . ']', 'Total Amount', 'required');
                }
            }

            $validate_data = array(
                array(
                    'field' => 'editExpensesDate',
                    'label' => 'Expenses Date',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'editExpensesName',
                    'label' => 'Expenses Name',
                    'rules' => 'required'
                )
            );

            $this->form_validation->set_rules($validate_data);
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() === true) {
                $create = $this->model_accounting->updateExpenses($id);
                if ($create === true) {
                    $validator['success'] = true;
                    $validator['messages'] = "Successfully added";
                } else {
                    $validator['success'] = false;
                    $validator['messages'] = "Error while inserting the information into the database";
                }
            } else {
                $validator['success'] = false;
                foreach ($_POST as $key => $value) {
                    if ($key == 'editSubExpensesName') {
                        foreach ($value as $number => $data) {
                            $validator['messages']['editSubExpensesName' . $number] = form_error('editSubExpensesName[' . $number . ']');
                        } // /.foreach
                    } // /.if
                    else if ($key == 'editSubExpensesAmount') {
                        foreach ($value as $number => $data) {
                            $validator['messages']['editSubExpensesAmount' . $number] = form_error('editSubExpensesAmount[' . $number . ']');
                        } // /.foreach
                    } else {
                        $validator['messages'][$key] = form_error($key);
                    } // /.
                } // /.foreach
            } // /else

            echo json_encode($validator);
        }
    }


    /**
    *---------------------------------------------------------------
    * remove the expenses info from the database
    *---------------------------------------------------------------
    */
    public function removeExpenses($id = null)
    {
        if ($id) {
            $validator = array('success' => false, 'messages' => array());

            $remove = $this->model_accounting->removeExpenses($id);
            if ($remove === true) {
                $validator['success'] = true;
                $validator['messages'] = 'Successfully Removed';
            } else {
                $validator['success'] = false;
                $validator['messages'] = 'Error while removing';
            }

            echo json_encode($validator);
        }
    }


    /**
    *------------------------------------------------------------------
    * fetch the income data for datatables
    *------------------------------------------------------------------
    */
    public function fetchIncomeData($id = null)
    {
        $fetchData = $this->model_accounting->fetchIncomeData();
        $result = array('data' => array());
        $x = 1;
        foreach ($fetchData as $key => $value) {
            $fetchPaymentNameData = $this->model_accounting->fetchPaymentData($value['payment_name_id']);

            $button = '<button class="btn btn-primary" data-toggle="modal" data-target="#viewIncomeModal" onclick="viewIncome(' . $value['payment_id'] . ')">View</button>';

            $result['data'][$key] = array(
                $x,
                $fetchPaymentNameData['name'],
                $fetchPaymentNameData['total_amount'],
                $value['paid_amount'],
                $button
            );

            $x++;
        }
        echo json_encode($result);
    }

    /**
    *------------------------------------------------------------------
    * view the payment information function
    * `payment_id` is from `payment` table
    * not from `payment_name` table
    *------------------------------------------------------------------
    */
    public function viewIncomeDetail($paymentId = null)
    {
        if ($paymentId) {
            $paymentData = $this->model_accounting->fetchStudentPayData($paymentId);
            $paymentNameData = $this->model_accounting->fetchPaymentData($paymentData['payment_name_id']);
            $classData = $this->model_classes->fetchClassData($paymentData['class_id']);
            $sectionData = $this->model_section->fetchSectionByClassSection($paymentData['class_id'], $paymentData['section_id']);
            $studentData = $this->model_student->fetchStudentData($paymentData['student_id']);

            $data = '<table class="table table-bordered table-responsive table-striped">
			<tbody>
				<tr>
					<th>Payment Name : </th>
					<td>' . $paymentNameData['name'] . '</td>
				</tr>
				<tr>
					<th>Total Amount : </th>
					<td>' . $paymentNameData['total_amount'] . '</td>
				</tr>
				<tr>
					<th>Paid Amount : </th>
					<td>' . $paymentData['paid_amount'] . '</td>
				</tr>
				<tr>
					<th>Payment Date : </th>
					<td>' . $paymentData['payment_date'] . '</td>
				</tr>
				<tr>
					<th>Class : </th>
					<td>' . $classData['class_name'] . '</td>
				</tr>
				<tr>
					<th>Section Date : </th>
					<td>' . $sectionData['section_name'] . '</td>
				</tr>
				<tr>
					<th>Student Name : </th>
					<td>' . $studentData['fname'] . ' ' . $studentData['lname'] . '</td>
				</tr>
			</tbody>
			</table>';
            echo $data;
        }
    }


}