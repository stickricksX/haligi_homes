<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Accessible To-Do List</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    *,
    *::before,
    *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
      color: rgb(0, 0, 0);
    }

    body {
      height: 100vh;
      background-repeat: no-repeat;
      background-size: cover;
      background-color: #dda2a1;
    }

    .heading {
      background-color: #ffcccb;
    }

    .heading h1 {
      color: black;
    }

    .logout {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 20px;
        }

        .logout a {
            text-decoration: none;
            color: #333;
        }
        
        .logout a:hover {
            color: #d9534f;
        }

    nav {
      box-shadow: 0 3px 3px 0 #f5b7b1;
    }

    nav ul {
      list-style: none;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px 0;
    }

    nav ul li {
      margin-right: 50px;
    }

    nav ul li a {
      text-decoration: none;
      color: black;
      font-size: 20px;
      font-weight: 500;
    }

    .container {
      background-color:  #f5b7b1;
      margin: 30px 200px;
      padding: 30px;
      border-radius: 8px;
      line-height: 2;

    }

    form input {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid;
    }

    form .btn {
      width: 100%;
      margin-top: 10px;
      padding: 10px;
      background-color: #d9534f;
      color: black;
      font-size: 16px;
      font-weight: bold;
      border-radius: 5px;
      border: none;
    }

    #taskList li {
      background-color: rgb(230, 201, 206);
      border-radius: 5px;
      margin-top: 10px;
      padding: 10px;
    }
    </style>
</head>
<body>
  <div class="heading">
    <h1 style="padding: 20px; text-align: center;">Submit a Post</h1>
    <div class="logout">
                <a href="logout.php" title="Logout" onclick="return confirm('Are you sure you want to log out?')">
                    <i class='bx bx-log-out'></i>
                </a>
        </div>
  </div>

  <nav>
    <ul>
      <li><a href="#taskInput">Home</a></li>
      <li><a href="#instructions">Instructions</a></li>
      <li><a href="#mytask">My Tasks</a></li>
    </ul>
  </nav>

  <form class="container" id="mytask">
    <h3>My Tasks</h3>
    <label for="titleInput">Post Title</label><br>
    <input type="text" id="titleInput"><br>

    <label for="contentInput">Post Content</label><br>
    <input type="text" id="contentInput"><br>

    <button class="btn" onclick="Submit(event)">Submit</button>

    <ul id="taskList"></ul>
  </form>

  <script>
    const badWords = ["badword", "shit", "stupid", "tangina", "fuck"];

    function containsBadWords(text) {
      const cleaned = text.toLowerCase().replace(/\s+/g, "");
      return badWords.some(word => cleaned.includes(word));
    }

    function filterText(text) {
      const words = text.split(/\s+/);
      return words.map(word => {
        const cleaned = word.toLowerCase().replace(/\s+/g, "");
        return badWords.some(bad => cleaned.includes(bad))
          ? "*".repeat(word.length)
          : word;
      }).join(" ");
    }

    function Submit(event) {
      event.preventDefault();

      const titleInput = document.getElementById("titleInput");
      const contentInput = document.getElementById("contentInput");

      const titleText = titleInput.value.trim();
      const contentText = contentInput.value.trim();

      if (!titleText || !contentText) {
        alert("Please fill in both Title and Content.");
        return;
      }

      if (containsBadWords(titleText) || containsBadWords(contentText)) {
        alert("Your post contains inappropriate words. These will be filtered.");
      }

      const filteredTitle = filterText(titleText);
      const filteredContent = filterText(contentText);

      const li = document.createElement("li");
      li.innerHTML = `<strong>${filteredTitle}</strong><br>${filteredContent}`;

      document.getElementById("taskList").appendChild(li);

      titleInput.value = "";
      contentInput.value = "";
    }
  </script>
</body>
</html>
