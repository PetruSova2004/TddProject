document.addEventListener('DOMContentLoaded', function () {
    const urlForm = document.querySelector('#urlForm');

    urlForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(urlForm);
        const url = urlForm.getAttribute('action');

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'guestToken': localStorage.getItem('customToken'),
            },
            body: formData
        })
            .then(response => response.json())
            .then(responseData => {
                if (responseData.status === true) {
                    // If the status is true, make a new request to the API
                    fetch('/api/getUser', {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${responseData.data.token}`,
                        }
                    })
                        .then(userResponse => userResponse.json())
                        .then(userData => {
                            // Do something with the user data here
                            window.location.href = '/';
                        })
                        .catch(error => {
                            console.error('Error fetching user data:', error);
                        });
                } else {
                    console.error(responseData);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});

