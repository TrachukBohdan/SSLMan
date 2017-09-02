var app = new Vue({
    el: '#app',
    data: {
        message: ''
    },
    methods: {
        sendMessage: function (e) {
            $.post('api/publish-message', {
                message: this.message
            });
            e.preventDefault();
        }
    }
});