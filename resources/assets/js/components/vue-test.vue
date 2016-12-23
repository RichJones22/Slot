<template>
    <div>
        <div>skills</div>
        <ul>
            <li v-for="skill in skills">{{ skill.close_date }}</li>
        </ul>
    </div>
</template>
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
        }
    }
</script>
