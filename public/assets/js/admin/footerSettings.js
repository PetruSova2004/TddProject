async function getTokenFromCookie() {
    const customToken = localStorage.getItem('customToken');

    var cookieName = 'Token';
    var apiUrl = '/api/getCookie/' + cookieName;

    try {
        var response = await fetch(apiUrl, {
            method: 'GET',
            headers: {
                'guestToken': customToken,
            }
        });
        var data = await response.json();
        var cookieValue = data.data.cookie;

        if (cookieValue) {
            return cookieValue;
        } else {
            console.log('getTokenFromCookieFalse');
            return false;
        }
    } catch (error) {
        if (error.message === '400') {
            console.log("An error occurred:", error);
        }
        throw error;
    }
}

async function fetchUserDataAndReplaceName() {
    const apiUrl = '/api/checkAdmin';
    const authToken = await getTokenFromCookie();

    fetch(apiUrl, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${authToken}`,
        }
    })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                window.location.href = '/';
            }
        })
        .then(data => {
            if (data.status === false) {
                window.location.href = '/';
            }
        })
        .catch(error => {
            console.error('Ошибка при получении данных:', error);
        });
}
fetchUserDataAndReplaceName();
