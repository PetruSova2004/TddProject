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
