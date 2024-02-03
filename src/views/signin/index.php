<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src=".././tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://auditorsdesk.com/static/js/vue3.global.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="/assets/bootstrap5/bootstrap.min.css">
    <!-- <script src="/assets/bootstrap5/bootstrap.bundle.min.js"></script> -->
    <link href="https://fonts.googleapis.com/css2?family=Fasthand&family=Roboto:wght@100;400;900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>Auditorsdesk- LogIn</title>
    <link rel="stylesheet" href="./css/login.css">
    <script src="<?= BASE_URL . VIEW_PATH ?>signin/component/login.js"></script>
    <!-- <script src="<?= BASE_URL . VIEW_PATH ?>signin/component/forgetpassword.js"></script>
    <script src="<?= BASE_URL . VIEW_PATH ?>signin/component/newpassword.js"></script>
    <script src="<?= BASE_URL . VIEW_PATH ?>signin/component/request.js"></script>
    <script src="<?= BASE_URL . VIEW_PATH ?>signin/component/invite.js"></script>
    <script src="<?= BASE_URL . VIEW_PATH ?>signin/component/loginfooter.js"></script>
    <script src="<?= BASE_URL . VIEW_PATH ?>signin/component/contactus.js"></script>
    <script src="<?= BASE_URL . VIEW_PATH ?>signin/component/faq.js"></script> -->
    <script src="https://auditorsdesk.com/static/js/axios.min.js"></script>
</head>

<body>
    <div id="login-container" class=" mx-auto" style="max-width:2085px">
        <login></login>
        <!-- <forgetpassword></forgetpassword> -->
    </div>
    <script>
        const loginpage = Vue.createApp({
                data() {
                    return {}
                },
                methods: {},
            }).component('login', login)
            // .component('forgetpassword', forgetpassword)
            // .component('newpassword', newpassword)
            // .component('request', request)
            // .component('invite', invite)
            // .component('loginfooter', loginfooter)
            // .component('contactus', contactus)
            // .component('faq', faq)
            .mount('#login-container');
    </script>


</body>

</html>