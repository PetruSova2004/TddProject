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
                    fetch('/api/getUser', {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${responseData.data.token}`,
                        }
                    })
                        .then(userResponse => userResponse.json())
                        .then(userData => {
                            window.location.href = '/';
                        })
                        .catch(error => {
                            console.error('Error fetching user data:', error);
                        });
                } else {
                    alert('Your credentials are invalid');
                    window.location.reload();
                }
            })
            .catch(error => {
                alert('Something goes wrong');
                window.location.reload();
            });
    });
});

