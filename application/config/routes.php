<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/**
 * Users routes
 */
$route['users'] = 'UsersController/index';
$route['users/fetchUsersData'] = 'UsersController/fetchUsersData';
$route['users/fetchUserData/(:any)'] = 'UsersController/fetchUserData/$1';
$route['users/view/(:any)'] = 'UsersController/view/$1';
$route['users/createForm'] = 'UsersController/createForm';
$route['users/create'] = 'UsersController/create';
$route['users/updateForm/(:any)'] = 'UsersController/updateForm/$1';
$route['users/update/(:any)'] = 'UsersController/update/$1';
$route['users/remove/(:any)'] = 'UsersController/remove/$1';


/**
 * Roles routes
 */
$route['roles'] = 'RoleController/index';
$route['roles/fetchRolesData'] = 'RoleController/fetchRolesData';
$route['roles/fetchRolesData/(:any)'] = 'RoleController/fetchRolesData/$1';
$route['roles/view/(:any)'] = 'RoleController/view/$1';
$route['roles/createForm'] = 'RoleController/createForm';
$route['roles/create'] = 'RoleController/create';
$route['roles/updateForm/(:any)'] = 'RoleController/updateForm/$1';
$route['roles/update/(:any)'] = 'RoleController/update/$1';
$route['roles/remove/(:any)'] = 'RoleController/remove/$1';

/**
 * Classes routes
 */
$route['classes'] = 'ClassesController/index';
$route['classes/fetchClassesData'] = 'ClassesController/fetchClassesData';
$route['classes/fetchClassData/(:any)'] = 'ClassesController/fetchClassData/$1';
$route['classes/create'] = 'ClassesController/create';
$route['classes/update/(:any)'] = 'ClassesController/update/$1';
$route['classes/remove/(:any)'] = 'ClassesController/remove/$1';

/**
 * Section routes
 */
$route['section'] = 'SectionController/index';
$route['section/fetchSectionTable/(:any)'] = 'SectionController/fetchSectionTable/$1';
$route['section/fetchSectionByClassSection/(:any)/(:any)'] = 'SectionController/fetchSectionByClassSection/$1/$2';
$route['section/create/(:any)'] = 'SectionController/create/$1';
$route['section/update/(:any)/(:any)'] = 'SectionController/update/$1/$2';
$route['section/remove/(:any)'] = 'SectionController/remove/$1';
$route['section/fetchUpdateSectionTable/(:any)'] = 'SectionController/fetchUpdateSectionTable/$1';

/**
 * Subject routes
 */
$route['subject'] = 'SubjectController/index';
$route['subject/fetchSubjectTable/(:any)'] = 'SubjectController/fetchSubjectTable/$1';
$route['subject/fetchSubjectByClassSection/(:any)/(:any)'] = 'SubjectController/fetchSubjectByClassSection/$1/$2';
$route['subject/create/(:any)'] = 'SubjectController/create/$1';
$route['subject/update/(:any)/(:any)'] = 'SubjectController/update/$1/$2';
$route['subject/remove/(:any)'] = 'SubjectController/remove/$1';
$route['subject/fetchUpdateSubjectTable/(:any)'] = 'SubjectController/fetchUpdateSubjectTable/$1';

/**
 * Student routes
 */
$route['student'] = 'StudentController/index';
$route['student/form'] = 'StudentController/studentForm';
$route['student/bulk'] = 'StudentController/studentBulk';
$route['student/getAppendBulkStudentRow/(:any)'] = 'StudentController/getAppendBulkStudentRow/$1';
$route['fetchClassSection/(:any)'] = 'StudentController/fetchClassSection/$1';
$route['student/fetchClassSection/(:any)'] = 'StudentController/fetchClassSection/$1';
$route['student/getClassSectionTab/(:any)'] = 'StudentController/getClassSectionTab/$1';
$route['student/fetchStudentData/(:any)'] = 'StudentController/fetchStudentData/$1';
$route['student/fetchStudentByClass/(:any)'] = 'StudentController/fetchStudentByClass/$1';
$route['student/fetchStudentByClassAndSection/(:any)/(:any)'] = 'StudentController/fetchStudentByClassAndSection/$1/$2';
$route['student/create'] = 'StudentController/create';
$route['student/createBulk'] = 'StudentController/createBulk';
$route['student/updateInfo/(:any)'] = 'StudentController/updateInfo/$1';
$route['student/updatePhoto/(:any)'] = 'StudentController/updatePhoto/$1';
$route['student/remove/(:any)'] = 'StudentController/remove/$1';
$route['student/applyMove/(:any)'] = 'StudentController/applyMove/$1';
$route['student/getStudentMoves/(:any)'] = 'StudentController/getStudentMoves/$1';
$route['student/moveBulkForm/(:any)/(:any)'] = 'StudentController/moveStudentsForm/$1/$2';
$route['student/moveBulk'] = 'StudentController/applyBulkMove';

/**
 * Reports routes
 */
$route['attendance'] = 'AttendanceController/index';
$route['attendance/report'] = 'AttendanceController/report';
$route['attendance/take'] = 'AttendanceController/takeAttendanceForm';
$route['attendance/fetchAttendaceType/(:any)'] = 'AttendanceController/fetchAttendaceType/$1';
$route['attendance/fetchClassSection/(:any)'] = 'AttendanceController/fetchClassSection/$1';
$route['attendance/getAttendanceTable/(:any)/(:any)/(:any)/(:any)'] = 'AttendanceController/getAttendanceTable/$1/$2/$3/$4';

/**
 * mark sheets routes
 */
$route['marks'] = 'MarksheetController/marks';
$route['marksheet'] = 'MarksheetController/marksheet';
$route['marksheet/fetchMarksheetTable/(:any)'] = 'MarksheetController/fetchMarksheetTable/$1';
$route['marksheet/fetchUpdateMarksheetTable/(:any)'] = 'MarksheetController/fetchUpdateMarksheetTable/$1';
$route['marksheet/fetchMarksheetDataByMarksheetId/(:any)'] = 'MarksheetController/fetchMarksheetDataByMarksheetId/$1';
$route['marksheet/createStudentMarks'] = 'MarksheetController/createStudentMarks';
$route['marksheet/fetchStudentMarksheet'] = 'MarksheetController/fetchStudentMarksheet';
$route['marksheet/fetchStudentByClass/(:any)'] = 'MarksheetController/fetchStudentByClass/$1';
$route['marksheet/fetchStudentByClassAndSection/(:any)/(:any)'] = 'MarksheetController/fetchStudentByClassAndSection/$1/$2';
$route['marksheet/fetchMarksheetDataByClass/(:any)'] = 'MarksheetController/fetchMarksheetDataByClass/$1';
$route['marksheet/create/(:any)'] = 'MarksheetController/create/$1';
$route['marksheet/remove/(:any)'] = 'MarksheetController/remove/$1';
$route['marksheet/update/(:any)/(:any)'] = 'MarksheetController/create/$1/$2';
$route['marksheet/studentMarksheetData/(:any)/(:any)/(:any)'] = 'MarksheetController/studentMarksheetData/$1/$2/$3';
$route['marksheet/viewStudentMarksheet/(:any)/(:any)/(:any)'] = 'MarksheetController/viewStudentMarksheet/$1/$2/$3';


/**
 * teacher routes
 */
$route['teacher'] = 'TeacherController/index';
$route['teacher/create'] = 'TeacherController/create';
$route['teacher/fetchTeacherData'] = 'TeacherController/fetchTeacherData';
$route['teacher/fetchTeacherData/(:any)'] = 'TeacherController/fetchTeacherData/$1';
$route['teacher/updateInfo/(:any)'] = 'TeacherController/updateInfo/$1';
$route['teacher/updatePhoto/(:any)'] = 'TeacherController/updatePhoto/$1';
$route['teacher/remove/(:any)'] = 'TeacherController/remove/$1';

/**
 * accounting routes
 */
$route['payments'] = 'PaymentController/payments';
$route['paymentForm'] = 'PaymentController/paymentForm';
$route['accountingFetchType/(:any)'] = 'PaymentController/fetchType/$1';
$route['accounting/fetchClassSection/(:any)'] = 'PaymentController/fetchClassSection/$1';
$route['fetchStudent/(:any)/(:any)/(:any)'] = 'PaymentController/fetchStudent/$1/$2/$3';
$route['accounting/fetchStudent/(:any)/(:any)/(:any)'] = 'PaymentController/fetchStudent/$1/$2/$3';
$route['fetchEditStudent/(:any)/(:any)/(:any)'] = 'PaymentController/fetchEditStudent/$1/$2/$3';
$route['createIndividual'] = 'PaymentController/createIndividual';
$route['createBulk'] = 'PaymentController/createBulk';
$route['fetchPaymentData'] = 'PaymentController/fetchPaymentData';
$route['fetchManageStudentPayData'] = 'PaymentController/fetchManageStudentPayData';
$route['fetchUpdatePaymentForm/(:any)'] = 'PaymentController/fetchUpdatePaymentForm/$1';
$route['fetchSectionClassForBulkStudent/(:any)'] = 'PaymentController/fetchSectionClassForBulkStudent/$1';
$route['fetchPaymentById/(:any)'] = 'PaymentController/fetchPaymentById/$1';
$route['fetchStudentForPaymentUpdate/(:any)/(:any)'] = 'PaymentController/fetchStudentForPaymentUpdate/$1/$2';
$route['fetchManagePaymentTable'] = 'PaymentController/fetchManagePaymentTable';
$route['fetchManageStudentPayTable'] = 'PaymentController/fetchManageStudentPayTable';
$route['updatePayment/(:any)/(:any)'] = 'PaymentController/updatePayment/$1/$2';
$route['removePayment/(:any)/(:any)'] = 'PaymentController/removePayment/$1';
$route['fetchStudentPaymentInfo/(:any)'] = 'PaymentController/fetchStudentPaymentInfo/$1';
$route['updateStudentPay/(:any)'] = 'PaymentController/updateStudentPay/$1';
$route['removeStudentPay/(:any)'] = 'PaymentController/removeStudentPay/$1';
/**
 * expenses routes
 */
$route['expenses'] = 'ExpensesController/index';
$route['accounting/createExpenses'] = 'ExpensesController/createExpenses';
$route['accounting/fetchExpensesData'] = 'ExpensesController/fetchExpensesData';
$route['accounting/fetchExpensesDataForUpdate/(:any)'] = 'ExpensesController/fetchExpensesDataForUpdate/$1';
$route['accounting/updateExpenses/(:any)'] = 'ExpensesController/updateExpenses/$1';
$route['accounting/removeExpenses/(:any)'] = 'ExpensesController/removeExpenses/$1';

/**
 * main routes
 */
$route['login'] = 'AuthController/index';
$route['setting'] = 'AuthController/setting';
$route['users/changePassword'] = 'UsersController/changePassword';
$route['users/updateProfile'] = 'UsersController/updateProfile';
$route['post-login'] = 'AuthController/login';
$route['logout'] = 'AuthController/logout';
$route['dashboard'] = 'DashboardController/index';
$route['dashboard/incomeFilter'] = 'DashboardController/incomeFilter';
$route['calendarCalcs'] = 'AttendanceController/attendancesCalc';
$route['default_controller'] = 'DashboardController/index';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
