$(document).ready(function () {

    const dataTables = function () {
        // $('#data-table').DataTable({
        //     "order": [
        //         [1, "desc"]
        //     ]
        // });
        $('#dataTable').DataTable();
    }
    dataTables();

    const pusherConnection = function () {

        let pusher = new Pusher('97e23ed5d522856f8f11', {
            cluster: 'ap1'
        });

        let channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function (data) {
            $.notify({
                // options
                message: data.message,
                url: 'http://localhost/disc-test/admin_payment',
            }, {
                // settings
                type: 'success'
            });
        });

    }
    pusherConnection();




});