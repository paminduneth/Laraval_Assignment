<!DOCTYPE html>
<html>
<head>
    <title>ToDos</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #e3f2fd 0%, #90caf9 100%);
            margin: 0;
            padding: 0;
        }
        .todos-container {
            max-width: 700px;
            margin: 48px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(25,118,210,0.10), 0 1.5px 4px rgba(0,0,0,0.04);
            padding: 40px 28px 32px 28px;
        }
        .todos-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            margin-bottom: 12px;
            background: #e3f2fd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
        }
        .todos-icon img {
            width: 32px;
            height: 32px;
        }
        h1 {
            color: #1976d2;
            margin-bottom: 24px;
            text-align: center;
            font-size: 1.7rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
            background: #fafbfc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(25,118,210,0.04);
        }
        th, td {
            padding: 14px 10px;
            text-align: left;
        }
        th {
            background: #f0f4f8;
            color: #333;
            font-weight: 600;
        }
        tr:nth-child(even) {
            background: #f9fbfc;
        }
        tr:hover {
            background: #e3f2fd;
        }
        @media (max-width: 600px) {
            .todos-container {
                padding: 18px 2vw 12px 2vw;
                max-width: 99vw;
            }
            h1 {
                font-size: 1.1rem;
            }
            th, td {
                padding: 10px 4px;
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <div class="todos-container">
        <div class="todos-icon">
            <img src="https://cdn-icons-png.flaticon.com/512/992/992700.png" alt="ToDos Icon">
        </div>
        <h1>ToDos</h1>
        <table border="0">
            <tr>
                <th>Task</th>
            </tr>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>