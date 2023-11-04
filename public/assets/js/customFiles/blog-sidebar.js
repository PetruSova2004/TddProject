async function popularCategories()
{

    let token = await getCustomToken();
    let apiUrl = '/api/popularCategories';

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
            const categoryList = document.querySelector('.category-list');
            categoryList.innerHTML = '';

            data.data.categories.forEach(category => {
                const listItem = document.createElement('li');
                const link = document.createElement('a');
                link.href = "products?category_id=" + category.id;
                link.textContent = `${category.title} (${category.product_count})`;
                listItem.appendChild(link);
                categoryList.appendChild(listItem);
            });

        })
        .catch(error => {
            console.error('Error:', error);
        });
}


async function tags()
{
    let token = await getCustomToken();
    let apiUrl = '/api/popularTags';

    fetch(apiUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'guestToken': token,
        }
    })
        .then(response => response.json())
        .then(data => {
            const tagsList = document.querySelector('.tags-list');
            tagsList.innerHTML = '';

            data.data.tags.forEach(tag => {
                const listItem = document.createElement('li');
                const link = document.createElement('a');
                link.href = "products?tag=" + tag.title;
                link.textContent = tag.title;
                listItem.appendChild(link);
                tagsList.appendChild(listItem);
            });

        })
        .catch(error => {
            console.error('Error:', error);
        });
}


async function recentBlogs()
{
    let token = await getCustomToken();
    let apiUrl = '/api/recentBlogs';

    fetch(apiUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'guestToken': token,
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const recentBlogsContainer = document.getElementById('recentBlogs');
            data.data.blogs.forEach(blog => {
                const blogElement = document.createElement('div');
                blogElement.className = 'single-blog';

                const blogThumb = document.createElement('div');
                blogThumb.className = 'blog-thumb';
                blogThumb.innerHTML = `<a href=""><img src="" width="65" height="68" alt=""></a>`;
                blogElement.appendChild(blogThumb);

                const blogContent = document.createElement('div');
                blogContent.className = 'blog-content';
                blogContent.innerHTML = `<span class="date"><a href="">${blog.date}</a></span><h6 class="title"><a href="">${blog.title}</a></h6>`;
                blogElement.appendChild(blogContent);

                recentBlogsContainer.querySelector('.sidebar-post').appendChild(blogElement);
            });

        })
        .catch(error => {
            console.error('Error:', error);
        });
}

popularCategories();
tags();
recentBlogs();
