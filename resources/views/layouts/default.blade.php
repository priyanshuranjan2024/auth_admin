<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title","DEMO")</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
    .table-auto th, .table-auto td {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
        border: 1px solid #dddddd;
        white-space: nowrap; /* Prevent text from wrapping */
    }

    .table-auto th {
        background-color: #f2f2f2;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px; /* Space between buttons */
    }

    .action-buttons button {
        padding: 5px 10px;
        white-space: nowrap; /* Prevent button text from wrapping */
    }
</style>

</head>
<body class="bg-gray-100">
  @yield("content")


</body>
</html>