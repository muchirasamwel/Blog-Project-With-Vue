<template>
    <div class="container">
        <div class="blog my-4" v-for="blog in blogs" :key="blog.id">
            <div class="bg-secondary p-3 text-center
                        font-weight-bolder text-white">
                <span>Title : {{blog.title}} ( By {{blog.user.name}} ) </span>
                <span class="float-right text-success font-weight-bolder">{{blog.created_at}}</span>
            </div>
            <div class="p-3">{{blog.content}} </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                name:"sam"
            }
        },
        computed: {
            blogs() {
                return this.$store.state.todays_blogs;
            }
        },
        created(){

            this.$store.dispatch('getTodaysBlogs');
        }
    }
</script>
