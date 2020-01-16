import Vue from 'vue'
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);
export default new Vuex.Store({
    state: {
        blogs: [],
        todays_blogs: [],
        errors: [],
        success: [],
        logged_user: {}
    },
    mutations: {
        setBlogs: (state, newdata) => {
            state.blogs = newdata;
        },
        setTodaysBlogs: (state, newdata) => {
            state.todays_blogs = newdata;
        },
        setLoggedUser: (state, newdata) => {
            state.logged_user = newdata;
        },
        setErrors: (state, newdata) => {
            state.errors = newdata;
        },
        setSuccess: (state, newdata) => {
            state.success = newdata;
        }
    },
    actions: {
        getBlogs: ({state, commit}) => {
            return new Promise((resolve, reject) => {
                axios({url: '/api/getblogs', data: '', method: 'GET'})
                    .then(resp => {
                        commit('setBlogs', resp.data);
                    }).catch(err => {
                    console.log("unexpected error " + err);
                    commit('setBlogs', []);
                })
            })

        },
        getTodaysBlogs: ({state, commit}) => {
            return new Promise((resolve, reject) => {
                axios({url: '/api/gettodaysblogs', data: '', method: 'GET'})
                    .then(resp => {
                        console.log(resp)
                        commit('setTodaysBlogs', resp.data);
                    }).catch(err => {
                    console.log("unexpected error " + err);
                    commit('setTodaysBlogs', []);
                    commit('setSuccess',[]);
                })
            })
        },
        putBlog: ({state, commit}, blog) => {
            return new Promise((resolve, reject) => {
                axios({
                    url: '/api/addblog', data: blog, method: 'POST',

                }).then(resp => {
                    console.log(resp);
                    if (resp.data.errors) {
                        commit('setErrors', resp.data.errors);
                        commit('setSuccess',[]);
                       // console.log(resp.data.errors)
                    } else {
                        commit('setBlogs', resp.data.blogs);
                       //console.log(resp.data.success)
                        commit('setSuccess',resp.data.success);
                        commit('setErrors', {});
                    }
                }).catch(err => {
                    console.log("unexpected error " + err);
                    commit('setSuccess',[]);
                })
            })

        },
        deleteBlog: ({state, commit}, blog) => {
            //console.log(blog);
            return new Promise((resolve, reject) => {
                axios({
                    url: '/api/deleteblog', data: blog, method: 'POST',

                }).then(resp => {
                    console.log(resp);
                    if (resp.data.errors) {
                        commit('setErrors', resp.data.errors);
                        //console.log(resp.data.errors)
                        commit('setSuccess',[]);
                    } else {
                        commit('setBlogs', resp.data.blogs);
                        //console.log(resp.data.success)
                        commit('setSuccess',resp.data.success);
                        commit('setErrors', {});
                    }
                }).catch(err => {
                    console.log("unexpected error " + err);

                })
            })

        },
        editBlog: ({state, commit}, blog) => {
            //console.log(blog);
            return new Promise((resolve, reject) => {
                axios({
                    url: '/api/updateblog', data: blog, method: 'POST',

                }).then(resp => {
                  //  console.log(resp);
                    if (resp.data.errors) {
                        commit('setErrors', resp.data.errors);
                        commit('setSuccess',[]);
                       // console.log(resp.data.errors)
                    } else {
                        commit('setBlogs', resp.data.blogs);
                        commit('setSuccess',resp.data.success);
                        // console.log(resp.data.success)
                        commit('setErrors', {});
                    }
                }).catch(err => {
                    console.log("unexpected error " + err);

                })
            })

        }


    }
})
