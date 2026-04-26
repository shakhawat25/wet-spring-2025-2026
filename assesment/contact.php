<?php
$fnameErr = $lnameErr = $genderErr = $emailErr = $topicErr = $dateErr = $reasonErr = "";
$fname = $lname = $gender = $email = $company = $topic = $date = "";


function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["firstname"])) {
        $fnameErr = "First name is required";
    } else {
        $fname = cleanInput($_POST["firstname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
            $fnameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["lastname"])) {
        $lnameErr = "Last name is required";
    } else {
        $lname = cleanInput($_POST["lastname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
            $lnameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = cleanInput($_POST["gender"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = cleanInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    $company = cleanInput($_POST["company"] ?? "");

    if (empty($_POST["reason"])) {
        $reasonErr = "At least one reason is required";
    } else {
        foreach ($_POST["reason"] as $r) {
            $reason[] = cleanInput($r);
        }
    }

    if (empty($_POST["topic"])) {
        $topicErr = "Topic is required";
    } else {
        $topic = cleanInput($_POST["topic"]);
    }

    if (empty($_POST["date"])) {
        $dateErr = "Consultation date is required";
    } else {
        $date = cleanInput($_POST["date"]);
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
            width: 700px;
        }

        .form-table td {
            padding: 8px 10px;
            vertical-align: top;
        }

        .form-table td:first-child {
            width: 180px;
            font-weight: bold;
            text-align: right;
            padding-top: 10px;
        }

        .form-table input[type="text"],
        .form-table input[type="email"],
        .form-table input[type="date"],
        .form-table select,
        .form-table textarea {
            width: 300px;
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

        .form-table input[type="submit"],
        .form-table input[type="reset"] {
            padding: 7px 20px;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 8px;
        }

        .form-table input[type="submit"] {
            background-color: #4CAF50;
        }

        .form-table input[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-table input[type="reset"] {
            background-color: #888;
        }

        .form-table input[type="reset"]:hover {
            background-color: #666;
        }

        .result-table {
            border-collapse: collapse;
            width: 600px;
            margin-top: 10px;
        }

        .result-table td {
            padding: 7px 12px;
            border: 1px solid #ddd;
        }

        .result-table td:first-child {
            font-weight: bold;
            background-color: #f2f2f2;
            width: 180px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h2>Contact Me</h2>
    <p>Email: shrifat973@gmail.com</p>
    <p>Phone: +8801867062870 (WhatsApp Also)</p>
    <p><span class="required">* required field</span></p>

    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table class="form-table">
            <tr>
                <td>First Name <span class="required">*</span></td>
                <td>
                    <input type="text" name="firstname" value="<?= $fname ?>">
                    <span class="error"><?= $fnameErr ?></span>
                </td>
            </tr>

            <tr>
                <td>Last Name <span class="required">*</span></td>
                <td>
                    <input type="text" name="lastname" value="<?= $lname ?>">
                    <span class="error"><?= $lnameErr ?></span>
                </td>
            </tr>

            <tr>
                <td>Gender <span class="required">*</span></td>
                <td>
                    <input type="radio" name="gender" value="male" <?= ($gender == "male") ? "checked" : "" ?>> Male
                    <input type="radio" name="gender" value="female" <?= ($gender == "female") ? "checked" : "" ?>> Female
                    <span class="error"><?= $genderErr ?></span>
                </td>
            </tr>

            <tr>
                <td>Email <span class="required">*</span></td>
                <td>
                    <input type="email" name="email" value="<?= $email ?>">
                    <span class="error"><?= $emailErr ?></span>
                </td>
            </tr>

            <tr>
                <td>Company</td>
                <td>
                    <input type="text" name="company" value="<?= $company ?>">
                </td>
            </tr>

                
            

            <tr>
                <td>Topics <span class="required">*</span></td>
                <td>
                    <select name="topic">
                        <option value="">Select Topic</option>
                        <option <?= ($topic == "Web Development") ? "selected" : "" ?>>Web Development</option>
                        <option <?= ($topic == "Mobile Development") ? "selected" : "" ?>>Mobile Development</option>
                        <option <?= ($topic == "AI/ML Development") ? "selected" : "" ?>>AI/ML Development</option>
                    </select>
                    <span class="error"><?= $topicErr ?></span>
                </td>
            </tr>

          

            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Submit">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$fnameErr && !$lnameErr && !$genderErr && !$emailErr && !$reasonErr && !$topicErr && !$dateErr): ?>
        <h3>Submitted Values</h3>
        <table class="result-table">
            <tr><td>First Name</td><td><?= $fname ?></td></tr>
            <tr><td>Last Name</td><td><?= $lname ?></td></tr>
            <tr><td>Gender</td><td><?= $gender ?></td></tr>
            <tr><td>Email</td><td><?= $email ?></td></tr>
            <tr><td>Company</td><td><?= $company ?></td></tr>
            <tr><td>Reason of Contact</td><td><?= implode(", ", $reason) ?></td></tr>
            <tr><td>Topic</td><td><?= $topic ?></td></tr>
            <tr><td>Consultation Date</td><td><?= $date ?></td></tr>
        </table>
    <?php endif; ?>

    <a href="index.html">Back to Home</a>
</body>

</html>