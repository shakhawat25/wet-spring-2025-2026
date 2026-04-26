<?php
$nameErr = $emailErr = $websiteErr = $genderErr = "";
$name = $email = $website = $gender = $comment = "";

function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = cleanInput($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    // Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = cleanInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Website (optional)
    $website = cleanInput($_POST["website"] ?? "");
    if (!empty($website) && !filter_var($website, FILTER_VALIDATE_URL)) {
        $websiteErr = "Invalid URL";
    }

    // Comment (optional)
    $comment = cleanInput($_POST["comment"] ?? "");

    // Gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = cleanInput($_POST["gender"]);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        h2 {
            margin-bottom: 5px;
        }

        .form-table {
            border-collapse: collapse;
            width: 600px;
        }

        .form-table td {
            padding: 8px 10px;
            vertical-align: top;
        }

        .form-table td:first-child {
            width: 100px;
            font-weight: bold;
            text-align: right;
            padding-top: 10px;
        }

        .form-table input[type="text"],
        .form-table textarea {
            width: 280px;
            padding: 5px 7px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-table textarea {
            resize: vertical;
        }

        .error {
            color: red;
            font-size: 13px;
            display: block;
            margin-top: 3px;
        }

        .required {
            color: red;
        }

        .form-table input[type="submit"] {
            padding: 7px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
        }

        .form-table input[type="submit"]:hover {
            background-color: #45a049;
        }

        .result-table {
            border-collapse: collapse;
            width: 500px;
            margin-top: 10px;
        }

        .result-table td {
            padding: 7px 12px;
            border: 1px solid #ddd;
        }

        .result-table td:first-child {
            font-weight: bold;
            background-color: #f2f2f2;
            width: 120px;
        }
    </style>
</head>
<body>
    <h2>Student Registration</h2>
    <p><span class="required">* required field</span></p>

    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table class="form-table">
            <tr>
                <td>Name <span class="required">*</span></td>
                <td>
                    <input type="text" name="name" value="<?= $name ?>">
                    <span class="error"><?= $nameErr ?></span>
                </td>
            </tr>
            <tr>
                <td>Email <span class="required">*</span></td>
                <td>
                    <input type="text" name="email" value="<?= $email ?>">
                    <span class="error"><?= $emailErr ?></span>
                </td>
            </tr>
            <tr>
                <td>Website</td>
                <td>
                    <input type="text" name="website" value="<?= $website ?>">
                    <span class="error"><?= $websiteErr ?></span>
                </td>
            </tr>
            <tr>
                <td>Comment</td>
                <td>
                    <textarea name="comment" rows="4"><?= $comment ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Gender <span class="required">*</span></td>
                <td>
                    <input type="radio" name="gender" value="female" <?= ($gender == "female") ? "checked" : "" ?>> Female &nbsp;
                    <input type="radio" name="gender" value="male" <?= ($gender == "male") ? "checked" : "" ?>> Male
                    <span class="error"><?= $genderErr ?></span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Register"></td>
            </tr>
        </table>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" &&
        !$nameErr && !$emailErr && !$websiteErr && !$genderErr): ?>
        <h3>Submitted values</h3>
        <table class="result-table">
            <tr><td>Name</td><td><?= $name ?></td></tr>
            <tr><td>Email</td><td><?= $email ?></td></tr>
            <tr><td>Website</td><td><?= $website ?></td></tr>
            <tr><td>Comment</td><td><?= $comment ?></td></tr>
            <tr><td>Gender</td><td><?= $gender ?></td></tr>
        </table>
    <?php endif; ?>
</body>
</html>
