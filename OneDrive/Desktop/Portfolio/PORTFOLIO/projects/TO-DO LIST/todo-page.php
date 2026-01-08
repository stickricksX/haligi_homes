<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>To-Do List</title>
  <!-- BOXICONS CSS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #c8a2c9;
      padding: 20px;
    }

    header {
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #8b008b;
      color: white;
      padding: 40px 50px;
      position: relative;
      border-radius: 10px;
      margin-bottom: 20px;
    }

    .back-btn {
      position: absolute;
      left: 20px;
      top: 20px;
      font-size: 1rem;
      display: flex;
      align-items: center;
      background-color: white;
      color: #8b008b;
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s, color 0.3s;
    }

    .back-btn i {
      font-size: 1.5rem;
      margin-right: 5px;
    }

    .back-btn:hover {
     background-color: #af69ed;
     color: white;
    }

    header h1 {
      font-size: 3rem;
      text-align: center;
    }

    nav {
      background-color: #8b008b;
      padding: 12px 0px;
      display: flex;
      justify-content: center;
      gap: 30px;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-size: 1.1rem;
      transition: color 0.3s;
      cursor: pointer;
    }

    nav a:hover {
      color: #af69ed;
    }

    .tab {
      display: none;
      margin-top: 20px;
    }

    .active {
      display: block;
    }

    .instructions {
      max-width: 700px;
      margin: 0 auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .instructions h2 {
      margin-bottom: 15px;
      color: #8b008b;
    }

    .instructions ol {
      line-height: 1.8;
      padding-left: 20px;
    }

    .todo-container {
      max-width: 500px;
      margin: 0 auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .todo-container input {
      width: 75%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .todo-container button {
      padding: 10px 15px;
      border: none;
      background-color: #af69ed;
      color: white;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .todo-container button:hover {
      background-color: #8b008b;
    }

    ul {
      list-style: none;
      margin-top: 20px;
    }

    ul li {
      padding: 10px;
      background: #f0e6e6;
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-radius: 5px;
    }

    ul li button {
      background: crimson;
      border: none;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
    }

    @media (max-width: 600px) {
      nav {
        flex-direction: column;
        align-items: center;
        gap: 15px;
      }

      header h1 {
        font-size: 2.2rem;
      }

      .todo-container input,
      .todo-container button {
        width: 100%;
        margin-bottom: 10px;
      }

      .todo-container {
        padding: 15px;
      }
    }
  </style>
</head>
<body>

  <header>
    <button class="back-btn" onclick="goBack()"><i class='bx bx-chevron-left'></i>Back to Main Page</button>
    <h1>My To-Do List</h1>
  </header>

  <nav>
    <a onclick="showTab('homeTab')">Home</a>
    <a onclick="showTab('instructionsTab')">Instructions</a>
    <a onclick="showTab('tasksTab')">My Tasks</a>
  </nav>

  <div id="homeTab" class="tab active">
    <div class="instructions">
      <h2>Welcome!</h2>
      <p>This is my simple to-do list application with instructions and task management. Use the tabs above to navigate.</p>
    </div>
  </div>

  <div id="instructionsTab" class="tab">
    <div class="instructions">
      <h2>Instructions</h2>
      <ol>
        <li>Click the “My Tasks” tab to view your task list.</li>
        <li>Enter a task in the input box and click “Add Task”.</li>
        <li>Each task can be removed using the “Delete” button.</li>
        <li>Your tasks will be automatically saved in your browser (local storage).</li>
        <li>When you revisit this page, your tasks will still be available.</li>
      </ol>
    </div>
  </div>

  <div id="tasksTab" class="tab">
    <div class="todo-container">
      <input type="text" id="taskInput" placeholder="Enter your task">
      <button onclick="addTask()">Add Task</button>
      <ul id="taskList"></ul>
    </div>
  </div>

  <script>
    function showTab(tabId) {
      const tabs = document.querySelectorAll('.tab');
      tabs.forEach(tab => tab.classList.remove('active'));
      document.getElementById(tabId).classList.add('active');
    }

    // Load tasks on page load
    document.addEventListener('DOMContentLoaded', loadTasks);

    function addTask() {
      const taskInput = document.getElementById('taskInput');
      const taskText = taskInput.value.trim();

      if (taskText === '') {
        alert('Please enter a task!');
        return;
      }

      createTaskElement(taskText);
      saveTask(taskText);
      taskInput.value = '';
    }

    function createTaskElement(taskText) {
      const li = document.createElement('li');
      li.textContent = taskText;

      const deleteBtn = document.createElement('button');
      deleteBtn.textContent = 'Delete';
      deleteBtn.onclick = function () {
        li.remove();
        deleteTask(taskText);
      }

      li.appendChild(deleteBtn);
      document.getElementById('taskList').appendChild(li);
    }

    function saveTask(taskText) {
      let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
      tasks.push(taskText);
      localStorage.setItem('tasks', JSON.stringify(tasks));
    }

    function deleteTask(taskText) {
      let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
      tasks = tasks.filter(task => task !== taskText);
      localStorage.setItem('tasks', JSON.stringify(tasks));
    }

    function loadTasks() {
      let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
      tasks.forEach(task => {
        createTaskElement(task);
      });
    }
  </script>

</body>
</html>
