<template>
    <!--<div class="inner cover">-->
        <table class="table table-inverse" style="margin-bottom: 0;">
            <thead>
                <tr>
                    <th>Close Date</th>
                    <th>Symbol</th>
                    <th>Side</th>
                    <th>State</th>
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
                        <td>{{ skill.position_state }}</td>
                        <td>{{ skill.expiration }}</td>
                        <td>{{ skill.amount }}</td>
                    </tr>
                    <tr v-if="skill.profits > 0">
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
                    </tr>
                </tbody>
            </table>
        </div>
        <table class="table table-inverse">
            <tbody v-for="(itemObjKey, skill) in skills">
                <tr v-if="(itemObjKey + 1) == skills.length">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total:</td>
                    <td>{{ runningTotal }}</td>
                </tr>
            </tbody>
        </table>
    <!--</div>-->
</template>
<style>
    .table tbody+tbody {
        border: none;
    }
</style>
<script>
    export default{
        ready() {
            console.log('vue-test Component ready.');

            axios.get('/bySymbol/anf').then(response => this.skills = response.data);

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
