<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Discussion Threads</title>
    <script>
        function loadThreads() {
            fetch('../includes/view_threads.php')
                .then(res => res.text())
                .then(html => {
                    document.getElementById('threads').innerHTML = html;
                });
        }

        function submitThread(e) {
            e.preventDefault();
            const formData = new FormData(document.getElementById('thread-form'));

            fetch('../includes/create_thread.php', {
                method: 'POST',
                body: formData
            }).then(res => res.text())
              .then(msg => {
                  alert(msg);
                  loadThreads();
                  document.getElementById('thread-form').reset();
              });
        }

        window.onload = loadThreads;
    </script>
</head>
<body>
    <h1>Discussion Threads</h1>

    <?php if (!isset($_SESSION['user_id'])): ?>
        <p><a href="index.html">Please sign in to post a thread.</a></p>
    <?php else: ?>
        <form id="thread-form" onsubmit="submitThread(event)">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <label>Title: <input type="text" name="title" required></label><br>
            <label>Content:<br><textarea name="content" required></textarea></label><br>
            <button type="submit">Post Thread</button>
        </form>
    <?php endif; ?>

    <h2>All Threads:</h2>
    <div id="threads"></div>
</body>
</html>
