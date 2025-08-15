<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Task_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

    // Show pending tasks
    public function index() {
        $data['tasks'] = $this->Task_model->get_pending_tasks();
        $data['counts'] = $this->Task_model->get_task_counts();
        $this->load->view('task_list', $data);
    }
    
    public function add() {
        if ($this->input->post()) {
            // Get POST data
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $due_date_input = $this->input->post('due_date'); // e.g., 2025-08-15T12:49
            $priority = $this->input->post('priority');

            // Convert to MySQL DATETIME format
            $due_date = str_replace('T', ' ', $due_date_input) . ':00';

            // Prevent past date
            if (strtotime($due_date) < time()) {
                $this->session->set_flashdata('error', 'Due date cannot be in the past.');
                redirect(base_url('index.php/tasks/add'));
            }

            // Insert task
            $task_data = [
                'title' => $title,
                'description' => $description,
                'due_date' => $due_date,
                'priority' => $priority,
                'status' => 'pending'
            ];

            $this->Task_model->insert_task($task_data);

            // Redirect to task list
            redirect(base_url('index.php/tasks'));
        } else {
            $this->load->view('add_task');
        }
    }



    // Mark task as completed
    public function complete($id) {
        $this->db->where('id', $id);
        $this->db->update('tasks', ['status' => 'completed']);
        redirect(base_url('index.php/tasks'));
    }
}
