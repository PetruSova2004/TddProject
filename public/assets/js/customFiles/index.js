async function getCategories() {
    const token = localStorage.getItem('customToken');

    fetch('/api/categoryAll', {
        method: 'GET',
        headers: {
            'guestToken': token,
        }
    })
        .then(response => response.json())
        .then(data => {
            // Вывод каждой категории в шаблоне
            var categoriesContainer = document.getElementById('categories-container');
            data.data.categories.forEach(category => {
                var categoryItem = document.createElement('div');
                categoryItem.className = 'col';

                var productCategoryItem = document.createElement('div');
                productCategoryItem.className = 'product-category-item';

                var thumb = document.createElement('div');
                thumb.className = 'thumb';

                var thumbLink = document.createElement('a');
                thumbLink.href = 'products.blade.php';

                var thumbImage = document.createElement('img');
                thumbImage.src = category.image_path;
                thumbImage.width = 200;
                thumbImage.height = 200;
                thumbImage.alt = 'Image-HasTech';

                var content = document.createElement('div');
                content.className = 'content';

                var title = document.createElement('h3');
                title.className = 'title';

                var titleLink = document.createElement('a');
                titleLink.href = 'products.blade.php';
                titleLink.textContent = category.title;

                // Сборка элементов вместе
                thumbLink.appendChild(thumbImage);
                thumb.appendChild(thumbLink);

                title.appendChild(titleLink);
                content.appendChild(title);

                productCategoryItem.appendChild(thumb);
                productCategoryItem.appendChild(content);

                categoryItem.appendChild(productCategoryItem);

                categoriesContainer.appendChild(categoryItem);
            });
        })
        .catch(error => {
            // Произошла ошибка при выполнении запроса
            console.error('Ошибка при выполнении GET-запроса:', error);
        });
}

getCategories();
