# Task Manager - CodeIgniter 3

A simple **Task Management System** built with **PHP 7** and **CodeIgniter 3**, allowing users to add tasks, view pending and completed tasks, mark tasks as completed, and filter/sort tasks. Modern Bootstrap 5 design included for responsive UI.

---

## **Features**

* Add tasks with **title, description, due date & time, and priority**
* View a list of tasks (pending by default)
* Highlight tasks due within the next 24 hours
* Prevent adding tasks with a past due date
* Display task counts: **Total, Completed, Pending**
* Mark tasks as completed
* Modern responsive **Bootstrap 5 UI**

---

## **Requirements**

* PHP 7+
* MySQL / MariaDB
* CodeIgniter 3
* Web server (XAMPP, WAMP, or similar)
* Composer (optional for dependencies)

---

## **Setup Instructions**

1. **Clone the repository**

```bash
git clone https://github.com/charulathag21/task_management_system.git
```

2. **Create the database**

* Open **phpMyAdmin** → create a database called `task_manager`
* Import the SQL file: `database/task_manager.sql` (included in the repo)

3. **Configure database connection**

* Open `application/config/database.php`
* Update your database credentials:

```php
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '', // or your DB password
    'database' => 'task_manager',
    'dbdriver' => 'mysqli',
    ...
);
```

4. **Set the base URL**

* Open `application/config/config.php`
* Update `$config['base_url']`:

```php
$config['base_url'] = 'http://localhost/task_manager/bcit-ci-CodeIgniter-bcb17eb/';
```

5. **Run the project**

* Start **Apache** and **MySQL** in XAMPP/WAMP
* Open browser:

```
http://localhost/task_manager/bcit-ci-CodeIgniter-bcb17eb/index.php/tasks
```

---

## **Folder Structure**

```
task_manager_ci3/
│
├─ application/
│   ├─ controllers/      # Tasks.php controller
│   ├─ models/           # Task_model.php
│   ├─ views/            # task_list.php, add_task.php
│
├─ system/               # CodeIgniter system folder
├─ index.php
├─ database/             # SQL dump (task_manager.sql)
```

---

## **Notes**

* The project uses **datetime-local input** for due date & time; the controller converts it to MySQL DATETIME.
* Tasks due within 24 hours are highlighted in the list.
* Counts for Total, Completed, and Pending tasks are displayed at the top.
* Designed with **Bootstrap 5** for a modern look.

---

## **License**

This project is free to use for learning and portfolio purposes.

---
