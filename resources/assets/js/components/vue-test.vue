<template>
    <div>
        <div>skills</div>
        <ul>
            <li v-for="skill in skills">{{ skill }}</li>
        </ul>
    </div>
</template>
<script>
    export default{
        ready() {
            console.log('vue-test Component ready.');

            axios.get('/api/vue-test').then(response => this.skills = response.data);

        },
        data(){
            return{
                skills: []
            }
        }
    }
</script>
