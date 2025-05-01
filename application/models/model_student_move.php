<?php

class Model_Student_Move extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * save movement log and update student current info
     * @param $studentId
     * @return bool
     */
    public function create($studentId)
    {
        try {
            $this->db->trans_begin();
            /**
             * update student class section info
             */
            $update_data = array(
                'class_id' => $this->input->post('editClassName'),
                'section_id' => $this->input->post('editSectionName')
            );

            $this->db->where('student_id', $studentId);
            $this->db->update('student', $update_data);

            /**
             * insert move log with the reason
             */
            $insert_data = array(
                'student_id' => $studentId,
                'class_id' => $this->input->post('moveClassName'),
                'section_id' => $this->input->post('moveSectionName'),
                'reason' => $this->input->post('reason'),
                'move_date' => $this->input->post('moveDate')
            );

            $status = $this->db->insert('student_moves', $insert_data);
            $this->db->trans_commit();
            return ($status == true ? true : false);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return false;
        }
    }

    /**
     * fetch student movements log in DESC order
     * @param $studentId
     * @return mixed
     */
    public function fetchStudentMoveData($studentId = null)
    {
        if ($studentId) {
            $sql = "SELECT * FROM student_moves WHERE student_id = ? order by move_date DESC";
            $query = $this->db->query($sql, array($studentId));
            return $query->result_array();
        } else {
            $sql = "SELECT * FROM student_moves order by move_date DESC";
            $query = $this->db->query($sql, array($studentId));
            return $query->result_array();
        }
    }


    /**
     * save movement log and update student current info for multiple students
     * @param $studentId
     * @return bool
     */
    public function createMultiple()
    {
        try {
            $this->db->trans_begin();
            /**
             * update student class section info
             */
            foreach ($this->input->post('students') as $studentId) {
                /**
                 * TODO
                 * check if student's section is not changed
                 */
                $update_data = array(
                    'class_id' => $this->input->post('className'),
                    'section_id' => $this->input->post('sectionName')
                );

                $insert_data = array(
                    'student_id' => $studentId,
                    'class_id' => $this->input->post('className'),
                    'section_id' => $this->input->post('sectionName'),
                    'reason' => $this->input->post('reason'),
                    'move_date' => $this->input->post('moveDate'),
                );
                $status = $this->db->insert('student_moves', $insert_data);
                $this->db->where('student_id', $studentId);
                $this->db->update('student', $update_data);
            }
            $this->db->trans_commit();
            return ($status == true ? true : false);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return false;
        }
    }

    /*
    *-------------------------------------------
    * count total student
    *-------------------------------------------
    */
    public function countTotalStudentMoves()
    {
        $sql = "SELECT * FROM student_moves";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}
