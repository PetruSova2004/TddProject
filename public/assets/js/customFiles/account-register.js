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
                    window.location.href = '/';
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


