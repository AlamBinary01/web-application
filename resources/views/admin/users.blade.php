<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>

    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- FullCalendar CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <!-- Custom Styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table-header, .table-row {
            display: flex;
            width: 100%;
        }

        .header__item, .table-data {
            flex: 1;
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .header__item {
            background-color: #f0f0f0;
            cursor: pointer;
        }

        .header__item a {
            text-decoration: none;
            color: #333;
        }

        .header__item a:hover {
            text-decoration: underline;
        }

        .btn-back {
            display: inline-block;
            padding: 8px 16px;
            text-align: center;
            background-color: #000;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 14px; /* Adjust font size */
            border: 1px solid #000; /* Border color same as background */
        }

        .btn-back:hover {
            background-color: #333;
        }

        #calendar {
            margin-top: 20px;
        }

        .table-content {
            margin-top: 20px;
        }

        .btn-container {
            text-align: right; /* Aligns the button to the right */
        }
    </style>

    <!-- jQuery for Sorting -->
    <script>
        $(document).ready(function() {
            $('.filter__link').click(function(e) {
                e.preventDefault();
                var $header = $(this).closest('.header__item');
                var index = $header.index();
                var $rows = $('.table-content .table-row');
                var ascending = $header.hasClass('asc');
                
                $rows.sort(function(a, b) {
                    var A = $(a).children('.table-data').eq(index).text().toUpperCase();
                    var B = $(b).children('.table-data').eq(index).text().toUpperCase();
                    
                    if (A < B) return ascending ? -1 : 1;
                    if (A > B) return ascending ? 1 : -1;
                    return 0;
                });
                
                $.each($rows, function(index, row) {
                    $('.table-content').append(row);
                });

                $header.toggleClass('asc desc');
                $('.header__item').not($header).removeClass('asc desc');
            });

            // Initialize FullCalendar
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($userEvents) // Pass user events data to FullCalendar
            });
            calendar.render();
        });
    </script>
</head>
<body>
    <div class="btn-container">
        <a href="{{ route('admin.dashboard') }}" class="btn-back">Back to Dashboard</a>
    </div>
    <div class="container">
        <h1>All Users</h1>

        <!-- Table structure for displaying user data -->
        @include('partials.user-table', ['users' => $users])

        <!-- Calendar displaying all users' last visit dates -->
        <div id="calendar"></div>

        <!-- Back button -->
        
    </div>
</body>
</html>
