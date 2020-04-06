


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
