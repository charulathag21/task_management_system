<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Get all pending tasks
    public function get_pending_tasks() {
        $this->db->where('status', 'pending');
        return $this->db->get('tasks')->result_array();
    }

    // Insert new task
    public function insert_task($data) {
        return $this->db->insert('tasks', $data);
    }

    // Get counts
    public function get_task_counts() {
        $total = $this->db->count_all('tasks');

        $this->db->where('status', 'completed');
        $completed = $this->db->count_all_results('tasks');

        $pending = $total - $completed;

        return [
            'total' => $total,
            'completed' => $completed,
            'pending' => $pending
        ];
    }
}
