function loadThreads() {
    fetch('../includes/threads.php')
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('threads');
            container.innerHTML = '';
            data.forEach(thread => {
                const div = document.createElement('div');
                div.innerHTML = `<strong>${thread.title}</strong><p>${thread.content}</p><hr>`;
                container.appendChild(div);
            });
        });
}

function postThread(e) {
    e.preventDefault();
    const formData = new FormData(document.getElementById('thread-form'));

    fetch('../includes/threads.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(msg => {
            alert(msg);
            loadThreads();
            document.getElementById('thread-form').reset();
        });
}

window.onload = () => {
    loadThreads();

    // Check if user is logged in via session (simulated by PHP on page load)
    fetch('../includes/threads.php?check_session=1')
        .then(res => res.json())
        .then(data => {
            const section = document.getElementById('user-section');
            if (data.logged_in) {
                section.innerHTML = `
                    <form id="thread-form">
                        <input type="hidden" name="user_id" value="${data.user_id}">
                        <label>Title: <input type="text" name="title" required></label><br>
                        <label>Content:<br><textarea name="content" required></textarea></label><br>
                        <button type="submit">Post Thread</button>
                    </form>
                `;
                document.getElementById('thread-form').addEventListener('submit', postThread);
            } else {
                section.innerHTML = `<p><a href="index.html">Please sign in to post a thread.</a></p>`;
            }
        });
};
