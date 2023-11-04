async function fetchData() {

    let token = await getCustomToken();
    let apiUrl = '/api/blogs';

    fetch(apiUrl, {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token,
            'Content-Type': 'application/json',
            'guestToken': token,
        }
    })
        .then(response => response.json())
        .then(data => {
            let blogContainer = document.getElementById('blogContainer');
            data.data.blogs.forEach(blogData => {
                let blogItem = document.createElement('div');
                blogItem.classList.add('col-md-6', 'col-lg-4', 'col-xl-6');
                blogItem.innerHTML = `
        <div class="post-item">
            <div class="thumb">
                <a href="blog-details.blade.php">
                    <img src="${blogData.image_path}" style="width: 350px; height: 250px" alt="Image-HasTech">
                </a>
            </div>
            <div class="content">
                <div class="meta">
                    <ul>
                        <li class="author-info"><span>By:</span> <a href="blog.blade.php">${blogData.author}</a></li>
                        <li class="post-date"><a href="blog.blade.php">${blogData.date}</a></li>
                    </ul>
                </div>
                <h4 class="title"><a href="blog-details.blade.php">${blogData.title}</a></h4>
                <a class="btn-theme btn-sm" href="blog-details.blade.php">Read More</a>
            </div>
        </div>
    `;

                blogContainer.appendChild(blogItem);
            });

        })
        .catch(error => {
            console.error('Error:', error);
        });
}

fetchData()
