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
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }

        #calendar {
            margin-top: 20px;
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
                events: @json($userEvents) // Use Blade syntax to pass user events data
            });
            calendar.render();
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>All Users</h1>

        <!-- Table structure for displaying user data -->
        <div class="table">
            <div class="table-header">
                <div class="header__item"><a class="filter__link" href="#">Phone Number</a></div>
                <div class="header__item"><a class="filter__link filter__link--number" href="#">Visit Count</a></div>
                <div class="header__item"><a class="filter__link filter__link--number" href="#">Last Visit Date</a></div>
            </div>
            <div class="table-content">
                @foreach ($users as $user)
                    <div class="table-row">
                        <div class="table-data">{{ $user->phone_number }}</div>
                        <div class="table-data">{{ $user->visit_count }}</div>
                        <div class="table-data">{{ $user->last_visit_date }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Calendar displaying all users' last visit dates -->
        <div id="calendar"></div>

        <!-- Back button -->
        <a href="{{ route('admin.dashboard') }}" class="btn-back">Back to Dashboard</a>
    </div>
</body>
</html>
