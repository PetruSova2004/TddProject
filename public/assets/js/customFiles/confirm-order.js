async function getConfirmStatus() {
    const token = await getTokenFromCookie();
    const urlParams = new URLSearchParams(window.location.search);
    const order = urlParams.get('order');

    fetch('/api/confirmOrder/' + order, {
        method: 'PATCH',
        headers: {
            'Authorization': 'Bearer ' + token,
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const title = document.getElementById('title');

            if (data.status === true) {
                title.textContent = "Order has been successfully approved";
            } else {
                title.textContent = "Something goes wrong";
            }
        })
        .catch(error => {
            // Произошла ошибка при выполнении запроса
            console.error('Ошибка при выполнении GET-запроса:', error);
        });
}
getConfirmStatus();
