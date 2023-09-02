async function index() {
    // Получение параметров из URL
    const urlParams = new URLSearchParams(window.location.search);
    const paymentId = urlParams.get('paymentId');
    const payerId = urlParams.get('PayerID');
    const order = urlParams.get('order');
    const token = await getTokenFromCookie();

// Параметры, которые вы хотите передать
    const data = {
        paymentId: paymentId,
        PayerID: payerId,
        order: order,
    };

// URL вашего API
    const apiUrl = '/api/successPayment';

// Выполнение POST-запроса к API
    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token,
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            // Обработка данных от API
            if (data.status === true) {
                alert('zbs');
            }
        })
        .catch(error => {
            // Обработка ошибок
            console.error('Error:', error);
        });
}
index();




