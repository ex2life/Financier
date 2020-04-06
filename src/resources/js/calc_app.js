/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const calc_app = new Vue({
    el: '#calc_app',
    data: {
        kolvo: 1,
        MonthYear: ''
    },
    methods: {
        kolvoinput({target}) {
            if (parseInt(target.value) >= 1) {
                this.kolvo = parseInt(target.value);
            }
        },
        getMonthYearfromInput() {
            this.MonthYear = this.$refs.MonthYearInput.value;
        }
    },
    computed: {
        listDate() {
            var list = [];
            var month = parseInt(this.MonthYear.substr(0, 2),10);
            var year = parseInt(this.MonthYear.substr(3, 4),10);
            //Начинаем платить со следующего месяца после взятия кредита
            if (month === 12) {
                month = 1;
                year++;
            } else month++;
            for (let i = 0; i < this.kolvo; i++) {
                str_month = (month < 10) ? "0" + month : month.toString();
                str_date = str_month + '.' + year;
                list.push(str_date);
                if (month == 12) {
                    month = 1;
                    year++;
                } else
                    month++;
            }
            return list
        },
    },
    mounted() {
        this.getMonthYearfromInput()
    },
});
