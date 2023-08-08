document.addEventListener('DOMContentLoaded', function () {
    const urlForm = document.querySelector('#urlForm');

    urlForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(urlForm);
        const url = urlForm.getAttribute('action');
        console.log(formData);

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
            .then(response => response.json())
            .then(responseData => {
                if (responseData.status === true) {
                    // Redirect to a different page
                    window.location.href = '/';
                } else {
                    console.error('Oops, something goes wrong');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});
