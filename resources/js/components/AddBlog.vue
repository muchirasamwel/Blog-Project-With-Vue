<template>
    <div>
        <h1 class="text-center">Manage Your Blog</h1>
        <div class="d-flex justify-content-center">
            <ul>
                <li class="text-danger" v-for="err in errors">{{err}}</li>
                <li class="text-success" v-for="succ in success">{{succ}}</li>
            </ul>
        </div>
        <div class="d-flex justify-content-center">
            <form @submit.prevent="addBlog" class="w-50 formB" v-if="!isupdate">
                <h3>ADD New Blog</h3>
                <div class="form-group">
                    <label>Blog Title</label>
                    <input type="text" name="title" class="form-control" v-model="blog.title">
                </div>
                <div class="form-group">
                    <label>Blog content</label>
                    <textarea name="content" class="form-control" cols="30" rows="10" v-model="blog.content"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="user_id" class="form-control" readonly v-model="logged_user.id">
                </div>
                <div>
                    <button type="reset" class="btn btn-outline-secondary">clear</button>
                    <button type="submit" class="btn btn-primary mx-1">Add Blog</button>
                </div>
            </form>
            <form @submit.prevent="updateBlog" class="w-50 formA" v-else>
                <h3>Update selected Blog</h3>
                <input type="hidden" name="user_id" class="form-control" readonly v-model="logged_user.id">
                <div class="form-group">
                    <label>Blog Title</label>
                    <input type="text" name="title" class="form-control" v-model="updateblog.title">
                </div>
                <div class="form-group">
                    <label>Blog content</label>
                    <textarea name="content" class="form-control" cols="30" rows="10" v-model="updateblog.content"></textarea>
                </div>
                <div>
                    <a class="btn btn-outline-secondary" @click="isupdate=false">Add New Blog</a>
                    <button type="submit" class="btn btn-primary mx-1">Edit Blog</button>
                </div>
            </form>
        </div>
        <div class="d-flex justify-content-center py-2">
            <table class="table w-75 mytable">
                <thead class="table-dark">
                <td>Blog Title</td>
                <td>Blog Content</td>
                <td>Blog Publisher</td>
                <td>Action</td>
                </thead>
                <tbody>
                <tr v-for="blog in blogs" :key="blog.id">
                    <td>{{blog.title}}</td>
                    <td>{{blog.content}}</td>
                    <td>{{blog.user.name}}</td>
                    <td>
                        <a  class="btn btn-outline-primary"
                            v-if="logged_user.id==blog.user.id" @click="edit(blog)">
                            update</a>
                        <a  class="btn btn-outline-danger"
                           v-if="logged_user.id==blog.user.id" @click="deleteBlog(blog)">
                            Delete</a>
                    </td>
                </tr>
                </tbody>

            </table>
        </div>
    </div>
</template>
<style lang="scss">
    .mytable{
        tr{
            &:hover{
                background-color: yellow;
            }
        }
    }
</style>
<script>
    export default {
        props:{
            logged_user:Object,
        },
        data(){
          return{
              blog:{},
              updateblog:{},
              isupdate:false
          }
        },
        mounted() {
        },
        computed:{
            blogs() {

                return this.$store.state.blogs;
            },
            errors()
            {
                return this.$store.state.errors;
            },
            success()
            {
                return this.$store.state.success;
            }
        },
        created() {
           // this.$store.dispatch('getLoggedUser');

            this.$store.dispatch('getBlogs');
        },
        methods:{
            addBlog(){
                this.blog.user_id=this.logged_user.id;
                const blog = Object.assign({}, this.blog);
               // console.log(blog);
                this.$store.dispatch('putBlog',blog);
            },
            deleteBlog(data){
                const blog = Object.assign({}, data);
                this.$store.dispatch('deleteBlog',blog)
            },
            mapData(data_in)
            {
                const data = Object.assign({}, data_in);
                console.log(data.title);
                this.blog.title=data.title;
                this.blog.content=data.content;
                this.blog.user_id=data.user_id;
            },
            edit(data_in){
                this.isupdate=false;
                this.isupdate=true;
                const data = Object.assign({}, data_in);
                console.log(data.title);
                this.updateblog.id=data.id;
                this.updateblog.title=data.title;
                this.updateblog.content=data.content;
            },
            updateBlog(){
                const blog = Object.assign({}, this.updateblog);
                this.$store.dispatch('editBlog',blog)
            }
        }
    }
</script>
