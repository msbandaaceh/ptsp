$(document).ready(function () {
    // Initialize with immediate fetch and then every 60 seconds
    fetchQueues();
    setInterval(fetchQueues, 60000);
});

// Secure HTML escaping function
function escapeHtml(unsafe) {
    return unsafe
        ? unsafe.toString()
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;")
        : '';
}

// Generic function to create room HTML content
function createRoomContent(queues) {
    if (Array.isArray(queues)) {
        return queues.map(queue => escapeHtml(queue.nomor)).join('');
    }

    const escapedNomor = escapeHtml(queues.nomor);
    const escapedPerkara = escapeHtml(queues.no_perkara);

    switch (queues.klas) {
        case '1':
            if (!queues.nomor) {
                return `
                    <div class="text-center">
                        <h3 class="m-0"><span class="badge badge-light">SIDANG SEKARANG</span></h3>
                        <br>
                        <h2 class="btn btn-primary btn-lg waves-effect waves-light">NOMOR PERKARA</h2>
                        <br>
                        <h2>${escapedPerkara}</h2>
                    </div>`;
            }
            return `
                <div class="text-center">
                    <h3 class="m-0"><span class="badge badge-light">SIDANG SEKARANG</span></h3>
                    <br>
                    <h2 class="btn btn-primary btn-lg waves-effect waves-light">NOMOR ANTRIAN</h2>
                    <br>
                    <h2>${escapedNomor}</h2>
                    <br>
                    <h3>
                        <span class="badge badge-light">Nomor Perkara</span>
                        <span class="badge badge-light">${escapedPerkara}</span>
                    </h3>
                </div>`;

        case '2':
            return `
                <h3 class="text-center m-0">
                    <img src="assets/img/logo/logo-ms-bna.webp" height="120" alt="logo" onerror="this.style.display='none'">
                    <br>${escapedNomor}
                </h3>`;

        default:
            return escapedNomor;
    }
}

// Generic AJAX fetch function
function fetchRoomData(roomId, elementId) {
    return $.ajax({
        url: `ruang_sidang${roomId}`,
        method: 'GET',
        dataType: 'json', // Ensure proper JSON parsing
        cache: false, // Prevent caching
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    }).then(function (data) {
        const $element = $(`#${elementId}`).empty();
        try {
            $element.append(createRoomContent(data));
        } catch (e) {
            console.error(`Error processing room ${roomId} data:`, e);
            $element.append('<div class="error">Error loading data</div>');
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.error(`Error fetching room ${roomId} data:`, textStatus, errorThrown);
        $(`#${elementId}`).html('<div class="error">Failed to load data</div>');
    });
}

// Main fetch function
function fetchQueues() {
    // Fetch all rooms data in parallel
    Promise.all([
        fetchRoomData(1, 'sidang1'),
        fetchRoomData(2, 'sidang2'),
        fetchRoomData(3, 'sidang3')
    ]).catch(error => {
        console.error('Error in one or more room requests:', error);
    });
}