<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>USER LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- GOOGLE FONTS LINK -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- BOXICONS CDN -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }

        body {
            background:url(bg-imagee.jpg) no-repeat center center/cover;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 15px;
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 12px 40px 12px 40px;
            border: 1px solid gold;
            border-radius: 5px;
        }

        .input-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        .input-group .toggle-password {
            right: 10px;
            left: auto;
            cursor: pointer;
        }

        .btn {
            width: 100%;
            background: gold;
            font-family: 'Montserrat', sans-serif;
            color: #1a1a1a;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
        }

        .btn:hover {
            background: #e6c200;
        }

        .form-footer {
            text-align: center;
            margin-top: 15px;
        }

        .form-footer a {
            color:  gold;
            text-decoration: none;
        }

        .form-footer a:hover {
            color:  #e6c200;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Login</h2>
    <form action="user-login_process.php" method="POST">
        <div class="input-group">
            <i class='bx bxs-user'></i>
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-group">
            <i class='bx bxs-lock-alt'></i>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <i class='bx bx-hide toggle-password' onclick="togglePassword()"></i>
        </div>
        <button type="submit" class="btn">Login</button>

        <div class="form-footer">
            <p>Don't have an account? <a href="user-register.php">Register</a></p>
        </div>
    </form>
</div>

<script>
function togglePassword() {
    var pwd = document.getElementById('password');
    pwd.type = (pwd.type === 'password') ? 'text' : 'password';
}
</script>

</body>
</html>
