$(document).ready(function () {

    "use strict";

    const scrollNavbar = function () {
        var myHeader = document.getElementById('header');
        window.onscroll = function () { 
            if (document.body.scrollTop >= 50 || document.documentElement.scrollTop >= 50) {
                myHeader.classList.add("shadow-sm");
            } 
            else {
                myHeader.classList.remove("shadow-sm");
            }
        };  
    }
    scrollNavbar();

    const dataTables = function () {
         $('#dataTable').DataTable({
            responsive: true,
            pageLength: 25
        });
    }
    dataTables();
    

    // const pusherConnection = function () {

    //     let pusher = new Pusher('97e23ed5d522856f8f11', {
    //         cluster: 'ap1'
    //     });

    //     let channel = pusher.subscribe('my-channel');
    //     channel.bind('my-event', function (data) {
    //         $.notify({
    //             // options
    //             message: data.message,
    //             url: 'http://localhost/disc-test/admin_payment',
    //         }, {
    //             // settings
    //             type: 'success'
    //         });
    //     });

    // }
    // pusherConnection();




});