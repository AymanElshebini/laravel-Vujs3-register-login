import {createWebHistory, createRouter} from "vue-router";
import Dashboard from "../pages/Dashboard.vue";
import admin from "../pages/admin.vue";
import login from "../pages/login.vue";
import register from  "../pages/Register.vue";
import Profile from "../pages/Profile.vue";


const routes = [
    {name:'Dashboard',path:'/',component:Dashboard},
    {name:'admin',path:'/admin',component:admin},
    {name:'login',path:'/login',component:login},
    {name:'register',path:'/register',component:register},
    {name:'Profile',path:'/Profile',component:Profile},
     


]





const router = createRouter({
    history: createWebHistory(),
    routes: routes,
    //strict:true
});





export default router;

