<!DOCTYPE html>
<html>
<head>
    <title>Task Assignment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f6f6f6;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
            background-color: #007bff;
            color: #ffffff;
            border-radius: 5px 5px 0 0;
        }
        .email-body {
            padding: 20px;
        }
        .email-footer {
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #ddd;
            background-color: #f8f9fa;
            border-radius: 0 0 5px 5px;
        }
        .email-footer p {
            font-size: 12px;
            color: #888;
        }
        .task-detail {
            margin-bottom: 10px;
        }
        .task-detail strong {
            color: #333;
        }
        .task-detail span {
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h2>You have been assigned a Task</h2>
        </div>
        <div class="email-body">
            <div class="task-detail">
                <strong>Due Date:</strong> <span>{{ $data['date'] }}</span>
            </div>
            <div class="task-detail">
                <strong>Topic:</strong> <span>{{ $data['topic'] }}</span>
            </div>
            <div class="task-detail">
                <strong>Assigned By:</strong> <span>{{ $data['assigned_by'] }}</span>
            </div>
            <div class="task-detail">
                <strong>Under Project:</strong> <span>{{ $data['project'] }}</span>
            </div>
        </div>
        <div class="email-footer">
            <p>Thank you for your attention.</p>
        </div>
    </div>
</body>
</html>
