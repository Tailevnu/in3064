<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Login and Registration</title>
    <style>
        /* Tổng thể */
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Khung chính */
        .container {
            display: flex;
            gap: 30px;
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 850px;
            max-width: 95%;
        }

        /* Hai cột login + register */
        .box {
            flex: 1;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 30px 25px;
            transition: 0.3s ease;
        }

        .box:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-3px);
        }

        /* Tiêu đề */
        h2 {
            text-align: center;
            color: #1976d2;
            margin-bottom: 25px;
        }

        /* Nhãn và input */
        label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #1976d2;
            outline: none;
        }

        /* Nút */
        button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #1976d2;
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0d47a1;
        }

        /* Responsive - khi màn hình nhỏ */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                gap: 20px;
                width: 95%;
                padding: 25px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Login box -->
        <div class="box">
            <h2>Login Here</h2>
            <form action="validation.php" method="post">
                <div>
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>

        <!-- Register box -->
        <div class="box">
            <h2>Register Here</h2>
            <form action="registration.php" method="post">
                <div>
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div>
                    <label>Phone Number</label>
                    <input type="text" name="phone" required>
                </div>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</body>
</html>
