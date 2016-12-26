<template>
    <div class="row">
        <table class="table table-inverse" style="margin-bottom: 0;">
            <thead>
                <tr>
                    <th>Trade Date</th>
                    <th>Symbol</th>
                    <th>Side</th>
                    <th>Qty</th>
                    <th>State</th>
                    <th>Strike</th>
                    <th>Expiration</th>
                    <th>Amount</th>
                </tr>
            </thead>
        </table>
        <div style="max-height: 800px; overflow: auto;">
            <table class="table table-inverse" style="margin-bottom: 0;">
                <tbody v-for="(itemObjKey, skill) in skills">
                    <tr>
                        <td>{{ skill.close_date }}</td>
                        <td>{{ skill.underlier_symbol }}</td>
                        <td>{{ skill.option_side }}</td>
                        <td>{{ skill.option_quantity }}</td>
                        <td>{{ skill.position_state }}</td>
                        <td>{{ skill.strike_price }}</td>
                        <td>{{ skill.expiration }}</td>
                        <td>{{ skill.amount }}</td>
                    </tr>
                    <tr v-if="skill.profits > 0">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Win/Loss:</td>
                        <td>{{ skill.profits }}</td>
                    </tr>
                    <tr v-if="skill.profits > 0">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <table class="table table-inverse">
            <tbody v-for="(itemObjKey, skill) in skills">
                <tr v-if="(itemObjKey + 1) == skills.length">
                    <td class="col-xs-3"></td>
                    <td class="col-xs-1"></td>
                    <td class="col-xs-1"></td>
                    <td class="col-xs-1"></td>
                    <td class="col-xs-1"></td>
                    <td class="col-xs-1"></td>
                    <td class="col-xs-2">Total:</td>
                    <td class="col-xs-2">{{ runningTotal }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</template>
<style>
    /* remove borders from table */
    .table tbody+tbody {
        border: none;
    }

    .table th, .table td {
        font-family: Courier, Menlo, Monaco, Consolas, "Courier New", monospace;
    }

</style>
<script>
    export default{
        ready() {
            console.log('vue-test Component ready.');

            let outerThis = this;

            Event.$on('symbol-passed', function(selected){
                let myStr =  "/bySymbol/";
                myStr = myStr.concat(selected);
                outerThis.getSymbol(myStr);
            });

            axios.get('/bySymbol/anf').then(response => this.skills = response.data);
        },
        methods: {
            getSymbol: function(url) {
                axios.get(url).then(response => this.skills = response.data);
            }
        },
        data(){
            return{
                skills: {}
            }
        },
        computed: {
            runningTotal: function () {
                return this.skills.reduce(function(prev, elem){
                    return prev + elem.profits;
                },0);
            }
        }
    }
</script>
