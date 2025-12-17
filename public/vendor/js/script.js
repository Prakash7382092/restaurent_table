 function openModal() {
        document.getElementById('productModal')
            .classList.remove('hidden');
        document.getElementById('productModal')
            .classList.add('flex');
    }

    function closeModal() {
        document.getElementById('productModal')
            .classList.add('hidden');
        document.getElementById('productModal')
            .classList.remove('flex');
    }