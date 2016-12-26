<template>
    <div>
        <select v-model="selected" @change="passSymbol( selected )" class="form-control col-xs-12 select-bg">
            <option v-for="option in options" v-bind:value="option.value">
                {{ option.text }}
            </option>
        </select>
    </div>
</template>
<style>

    /* set the background color of the drop down box*/
    .select-bg {
        background-color: #cdcdcd;
    }
    .select-bg:focus, .select-bg[type]:focus {
        background-color: #cdcdcd;
    }

</style>
<script>
    export default{
        ready() {
            console.log('select-symbol Component ready.');
        },
        data(){
            return{
                selected: 'ANF',
                options: [
                    { text: 'ANF', value: 'ANF' },
                    { text: 'F', value: 'F' },
                    { text: 'FIT', value: 'FIT' },
                    { text: 'FTR', value: 'FTR' },
                    { text: 'GES', value: 'GES' },
                    { text: 'GPRO', value: 'GPRO' },
                    { text: 'MU', value: 'MU' },
                    { text: 'NE', value: 'NE' },
                    { text: 'PBI', value: 'PBI' },
                    { text: 'SHLD', value: 'SHLD' },
                    { text: 'VIX', value: 'VIX' },
                    { text: 'RIG', value: 'RIG' }
                ]
            }
        },
        methods: {
            passSymbol: function() {
                Event.$emit('symbol-passed', this.selected)
            }
        }
    }
</script>
