<!DOCTYPE html>
<html>
<head>
    <title>App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<form id="task-add">
		{{ csrf_field() }}
		<label>Task Description</label><br />
		<textarea name="body" required></textarea><br />
		<input type="number" name="user_id" placeholder="user_id"  required/><br />
		<button type="submit">Add Task</button>
	</form>
    <ul id="tasks">
    	@foreach($tasks as $task)
    		<li id="{{ $task->id }}">
    			<a href="/task/{{ $task->id }}">{{ $task->body }}</a>
    			<button data-id="{{ $task->id }}" style="background: green;color: white" class="task-delete">Done</button>
    		</li>
    	@endforeach
    </ul>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
    	
    $('#task-add').submit(function(e) {
        e.preventDefault();

        var body = $("textarea[name='body']").val(),
            user_id = $("input[name='user_id']").val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/add-task',
            data: {
                body: body,
                user_id: user_id
            },
            success: function(res) {
                console.log(res),
                $("#tasks").last().append("<li id='" + res.id + "'>" + "<a href='/task/" + res.id + "'>" + res.body + "</a>" + "<button data-id=" + res.id + " style='background: green;color: white' class='task-delete'>Done</button>" + "</li>");
            }
        });

    });

    $('.task-delete').click(function() {

    	$('#' + $(this).data('id')).hide();

    	$.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    		type: 'POST',
    		url: '/delete-task/' + $(this).data('id')
    	});

    });

    </script>

</body>
</html>